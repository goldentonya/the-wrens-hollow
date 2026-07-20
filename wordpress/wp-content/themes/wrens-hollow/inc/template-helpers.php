<?php
/**
 * Rendering helpers that let templates pull owner-editable content from ACF /
 * custom post types while keeping every hardcoded value as a fallback — so the
 * live site never goes blank before the owner has entered anything, and the
 * design is unaffected whether or not ACF is active.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * URL of the site logo mark: the custom_logo set in Appearance > Customize >
 * Site Identity, else the theme's own logo file. Used for both the header
 * (.nav__logo) and footer (.footer-mark) images, which keep their exact markup
 * and CSS classes — only the image source is dynamic.
 */
function wh_logo_url() {
	$logo_id = get_theme_mod( 'custom_logo' );
	if ( $logo_id ) {
		$src = wp_get_attachment_image_url( $logo_id, 'full' );
		if ( $src ) {
			return $src;
		}
	}
	return get_template_directory_uri() . '/images/photos/ali-wren-logo-mark.png';
}

/**
 * The registered default_value for a field, looked up by its field key. Lets a
 * template use a field's default as the fallback without duplicating the copy
 * (ACF returns null for unsaved fields, so a fallback is still needed for the
 * front end before the page is first saved).
 */
function wh_default( $field_key ) {
	if ( function_exists( 'acf_get_field' ) ) {
		$f = acf_get_field( $field_key );
		if ( is_array( $f ) && isset( $f['default_value'] ) ) {
			return $f['default_value'];
		}
	}
	return '';
}

/**
 * Raw field value, or the fallback when ACF is inactive or the field is empty.
 */
function wh_field( $name, $fallback = '', $post_id = false ) {
	if ( function_exists( 'get_field' ) ) {
		$val = get_field( $name, $post_id );
		if ( '' !== $val && null !== $val && false !== $val ) {
			return $val;
		}
	}
	return $fallback;
}

/**
 * Echo a plain-text field (escaped), or its fallback. For headings, labels, etc.
 */
function wh_the( $name, $fallback = '', $post_id = false ) {
	echo esc_html( wh_field( $name, $fallback, $post_id ) );
}

/**
 * Echo a rich-text (WYSIWYG) field, or its fallback. Editor output is already
 * sanitized by WordPress on save, so it is printed as trusted HTML.
 */
function wh_wysiwyg( $name, $fallback = '', $post_id = false ) {
	echo wh_field( $name, $fallback, $post_id ); // phpcs:ignore WordPress.Security.EscapeOutput -- WYSIWYG/editor HTML.
}

/**
 * Echo an <img> from an ACF image field, falling back to a theme asset path
 * (relative to the theme root) when the field is empty or ACF is inactive.
 */
function wh_img( $name, $theme_fallback = '', $alt = '', $attrs = '', $post_id = false ) {
	$src = '';
	if ( function_exists( 'get_field' ) ) {
		$img = get_field( $name, $post_id );
		if ( is_array( $img ) ) {
			$src = isset( $img['url'] ) ? $img['url'] : '';
			if ( '' === $alt && ! empty( $img['alt'] ) ) {
				$alt = $img['alt'];
			}
		} elseif ( is_numeric( $img ) ) {
			$src = wp_get_attachment_image_url( $img, 'full' );
		} elseif ( is_string( $img ) && '' !== $img ) {
			$src = $img;
		}
	}
	if ( ! $src && $theme_fallback ) {
		$src = get_template_directory_uri() . '/' . ltrim( $theme_fallback, '/' );
	}
	if ( ! $src ) {
		return;
	}
	echo '<img src="' . esc_url( $src ) . '" alt="' . esc_attr( $alt ) . '"' . ( $attrs ? ' ' . $attrs : '' ) . '>'; // phpcs:ignore WordPress.Security.EscapeOutput -- $attrs is template-authored.
}

/**
 * Ordered Event posts. $which = 'upcoming' | 'past'.
 * Upcoming: is_upcoming on, soonest first. Past: is_upcoming off, newest first.
 *
 * Filtering/sorting is done in PHP (not a meta_query) so an event that is
 * missing its date or flag still shows up rather than silently vanishing — a
 * dateless event just sorts to the end of its group.
 */
function wh_events( $which = 'past' ) {
	$is_upcoming = ( 'upcoming' === $which );

	$posts = get_posts(
		array(
			'post_type'      => 'wh_event',
			'posts_per_page' => -1,
			'post_status'    => 'publish',
		)
	);

	$posts = array_values(
		array_filter(
			$posts,
			function ( $p ) use ( $is_upcoming ) {
				$flag = (string) get_post_meta( $p->ID, 'is_upcoming', true );
				$on   = ( '1' === $flag );
				return $is_upcoming ? $on : ! $on;
			}
		)
	);

	usort(
		$posts,
		function ( $a, $b ) use ( $is_upcoming ) {
			$da = (string) get_post_meta( $a->ID, 'event_date', true );
			$db = (string) get_post_meta( $b->ID, 'event_date', true );
			if ( '' === $da && '' === $db ) {
				return 0;
			}
			if ( '' === $da ) {
				return 1; // dateless sorts last
			}
			if ( '' === $db ) {
				return -1;
			}
			return $is_upcoming ? strcmp( $da, $db ) : strcmp( $db, $da );
		}
	);

	return $posts;
}

/**
 * Human-readable label for a book series slug.
 */
function wh_series_label( $slug ) {
	$map = array(
		'whiskey-tango-foxtrot' => 'Whiskey Tango Foxtrot',
		'veiled-prophecy'       => 'The Veiled Prophecy',
	);
	return isset( $map[ $slug ] ) ? $map[ $slug ] : '';
}

/**
 * Published Book posts, optionally filtered to one series, ordered by book
 * number. Sorted in PHP so a book missing its number still appears (sorts last).
 */
function wh_books( $series = null ) {
	$posts = get_posts(
		array(
			'post_type'      => 'wh_book',
			'posts_per_page' => -1,
			'post_status'    => 'publish',
		)
	);
	if ( $series ) {
		$posts = array_filter(
			$posts,
			function ( $p ) use ( $series ) {
				return $series === get_post_meta( $p->ID, 'series', true );
			}
		);
	}
	usort(
		$posts,
		function ( $a, $b ) {
			return (int) get_post_meta( $a->ID, 'book_number', true ) <=> (int) get_post_meta( $b->ID, 'book_number', true );
		}
	);
	return array_values( $posts );
}

/**
 * Single Book post by its page key (slug), or null.
 */
function wh_book( $key ) {
	$posts = get_posts(
		array(
			'post_type'      => 'wh_book',
			'posts_per_page' => 1,
			'post_status'    => 'publish',
			'meta_key'       => 'book_key',
			'meta_value'     => $key,
		)
	);
	return $posts ? $posts[0] : null;
}

/**
 * Cover image URL for a book: the Featured Image ("Book cover" box), else the
 * theme cover asset at /images/covers/{book_key}.jpg.
 */
function wh_book_cover( $book ) {
	if ( has_post_thumbnail( $book ) ) {
		$url = get_the_post_thumbnail_url( $book, 'full' );
		if ( $url ) {
			return $url;
		}
	}
	$key = get_post_meta( $book->ID, 'book_key', true );
	return get_template_directory_uri() . '/images/covers/' . $key . '.jpg';
}

/**
 * Render one series-page "Reading order" card, matching the existing
 * .book-showcase / .book-showcase--featured markup. Pulled live from the Books
 * menu (same tag/blurb as the Books-page card) so adding, removing, or
 * reordering a book in that series shows up here automatically — buttons
 * switch between "Start reading free / Buy book" and "Notify me / Learn more"
 * based on the book's "Released?" field.
 */
function wh_render_reading_order_card( $book, $featured = false ) {
	$key      = get_post_meta( $book->ID, 'book_key', true );
	$tag      = wh_field( 'grid_tag', '', $book->ID );
	$blurb    = wh_field( 'grid_blurb', '', $book->ID );
	$cover    = wh_book_cover( $book );
	$title    = get_the_title( $book );
	$page_url = home_url( '/' . $key . '/' );
	// Read the raw postmeta (not wh_field()) so an explicit "off" (stored as
	// '0') isn't mistaken for "never set" — true_false fields store '0'/'1' as
	// strings, and wh_field() treats a false-ish value as empty.
	$released_meta = get_post_meta( $book->ID, 'is_released', true );
	$released      = ( '' === $released_meta ) ? true : ( '1' === $released_meta );

	$sku        = wh_field( 'product_sku', '', $book->ID );
	$product_id = ( $sku && function_exists( 'wc_get_product_id_by_sku' ) ) ? wc_get_product_id_by_sku( $sku ) : 0;
	$buy_url    = $product_id
		? get_permalink( $product_id )
		: ( function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) . '#' . $key : home_url( '/shop/#' . $key ) );

	$class = 'card book-showcase' . ( $featured ? ' book-showcase--featured' : '' );
	?>
	<div class="<?php echo esc_attr( $class ); ?>">
	  <div class="ph-box"><img src="<?php echo esc_url( $cover ); ?>" alt="<?php echo esc_attr( $title ); ?> book cover" style="width:100%;height:100%;object-fit:cover;object-position:top;border-radius:6px;"></div>
	  <div class="book-showcase__body">
	    <?php if ( $tag ) : ?>
	      <p class="book-card__tag"><?php echo esc_html( $tag ); ?></p>
	    <?php endif; ?>
	    <h3><?php echo esc_html( $title ); ?></h3>
	    <?php if ( $blurb ) : ?>
	      <p class="txt"><?php echo esc_html( $blurb ); ?></p>
	    <?php endif; ?>
	    <?php if ( $released ) : ?>
	      <a class="btn btn--sm" href="<?php echo esc_url( $page_url ); ?>">Start reading free →</a>
	      <a class="btn btn--outline btn--sm" href="<?php echo esc_url( $buy_url ); ?>" style="margin-left:8px;">Buy book →</a>
	    <?php else : ?>
	      <button class="btn btn--sm" type="button" data-notify="<?php echo esc_attr( $title ); ?>">Notify me on release</button>
	      <a class="btn btn--outline btn--sm" href="<?php echo esc_url( $page_url ); ?>" style="margin-left:8px;">Learn more →</a>
	    <?php endif; ?>
	  </div>
	</div>
	<?php
}

/**
 * Render one Books-page library card, matching the existing .book-showcase markup.
 */
function wh_render_book_showcase( $book ) {
	$key   = get_post_meta( $book->ID, 'book_key', true );
	$tag   = wh_field( 'grid_tag', '', $book->ID );
	$blurb = wh_field( 'grid_blurb', '', $book->ID );
	$cover = wh_book_cover( $book );
	$url   = home_url( '/' . $key . '/' );
	?>
	<div class="card book-showcase">
	  <div class="ph-box"><img src="<?php echo esc_url( $cover ); ?>" alt="<?php echo esc_attr( get_the_title( $book ) ); ?> book cover" style="width:100%;height:100%;object-fit:cover;border-radius:6px;"></div>
	  <div class="book-showcase__body">
	    <?php if ( $tag ) : ?>
	      <p class="book-card__tag"><?php echo esc_html( $tag ); ?></p>
	    <?php endif; ?>
	    <h3><?php echo esc_html( get_the_title( $book ) ); ?></h3>
	    <?php if ( $blurb ) : ?>
	      <p class="txt"><?php echo esc_html( $blurb ); ?></p>
	    <?php endif; ?>
	    <a class="btn" href="<?php echo esc_url( $url ); ?>">View this book →</a>
	  </div>
	</div>
	<?php
}

/**
 * Published Project posts (On the Horizon), in menu order (the "Order" box).
 */
function wh_projects() {
	return get_posts(
		array(
			'post_type'      => 'wh_project',
			'posts_per_page' => -1,
			'post_status'    => 'publish',
			'orderby'        => array(
				'menu_order' => 'ASC',
				'date'       => 'ASC',
			),
		)
	);
}

/**
 * Render one On-the-Horizon roadmap item, matching the existing .roadmap__item
 * markup. Status controls the node style and label.
 */
function wh_render_project( $post ) {
	$id       = $post->ID;
	$status   = wh_field( 'project_status', 'in-progress', $id );
	$subtitle = wh_field( 'project_subtitle', '', $id );
	$body     = wh_field( 'project_body', '', $id );
	$label    = wh_field( 'project_link_label', '', $id );
	$url      = wh_field( 'project_link_url', '', $id );

	$map = array(
		'now-available' => array( 'node' => '', 'label' => 'Now available', 'muted' => false ),
		'in-progress'   => array( 'node' => ' roadmap__node--outline', 'label' => 'In progress', 'muted' => false ),
		'planning'      => array( 'node' => ' roadmap__node--muted', 'label' => 'Planning', 'muted' => true ),
	);
	$s = isset( $map[ $status ] ) ? $map[ $status ] : $map['in-progress'];
	?>
	<div class="roadmap__item">
	  <div class="roadmap__node<?php echo esc_attr( $s['node'] ); ?>"></div>
	  <div class="roadmap__line"></div>
	  <div class="roadmap__content">
	    <p class="roadmap__status"<?php echo $s['muted'] ? ' style="color:var(--text-muted);"' : ''; ?>><?php echo esc_html( $s['label'] ); ?></p>
	    <h3><?php echo esc_html( get_the_title( $post ) ); ?></h3>
	    <?php if ( $subtitle ) : ?>
	      <p class="book-card__tag" style="color:var(--text-muted);"><?php echo esc_html( $subtitle ); ?></p>
	    <?php endif; ?>
	    <div class="wh-rte"><?php echo $body; // phpcs:ignore WordPress.Security.EscapeOutput -- WYSIWYG. ?></div>
	    <?php if ( $label && $url ) : ?>
	      <a class="btn btn--outline btn--sm" href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $label ); ?></a>
	    <?php endif; ?>
	  </div>
	</div>
	<?php
}

/**
 * Published Team members (wh_character), in menu order (the "Order" box).
 */
function wh_characters() {
	return get_posts(
		array(
			'post_type'      => 'wh_character',
			'posts_per_page' => -1,
			'post_status'    => 'publish',
			'orderby'        => array(
				'menu_order' => 'ASC',
				'date'       => 'ASC',
			),
		)
	);
}

/**
 * Render one .team-card for a team member (badge = featured image, name = title).
 */
function wh_render_character( $post ) {
	$desc = wh_field( 'character_desc', '', $post->ID );
	?>
	<div class="team-card">
	  <?php if ( has_post_thumbnail( $post->ID ) ) : ?>
	    <div class="team-card__badge"><img src="<?php echo esc_url( get_the_post_thumbnail_url( $post->ID, 'full' ) ); ?>" alt="<?php echo esc_attr( get_the_title( $post ) ); ?> emblem"></div>
	  <?php endif; ?>
	  <h3><?php echo esc_html( get_the_title( $post ) ); ?></h3>
	  <?php if ( $desc ) : ?>
	    <p class="txt"><?php echo esc_html( $desc ); ?></p>
	  <?php endif; ?>
	</div>
	<?php
}

/**
 * Published Milestone posts (About page journey timeline), in menu order.
 */
function wh_milestones() {
	return get_posts(
		array(
			'post_type'      => 'wh_milestone',
			'posts_per_page' => -1,
			'post_status'    => 'publish',
			'orderby'        => array(
				'menu_order' => 'ASC',
				'date'       => 'ASC',
			),
		)
	);
}

/**
 * Render one journey-timeline entry, matching the existing .timeline__item
 * markup — which alternates the spacer/card on either side of the node
 * depending on whether it's an even or odd position in the list.
 */
function wh_render_milestone( $post, $index ) {
	$date = wh_field( 'milestone_date', '', $post->ID );
	$body = wh_field( 'milestone_body', '', $post->ID );
	$card = '<div class="timeline__card"><p class="timeline__date">' . esc_html( $date ) . '</p><div class="timeline__content wh-rte">' . $body . '</div></div>'; // phpcs:ignore WordPress.Security.EscapeOutput -- WYSIWYG.
	?>
	<div class="timeline__item">
	  <?php if ( 0 === $index % 2 ) : ?>
	    <div class="timeline__spacer"></div>
	    <div class="timeline__node"></div>
	    <?php echo $card; // phpcs:ignore WordPress.Security.EscapeOutput -- built above. ?>
	  <?php else : ?>
	    <?php echo $card; // phpcs:ignore WordPress.Security.EscapeOutput -- built above. ?>
	    <div class="timeline__node"></div>
	    <div class="timeline__spacer"></div>
	  <?php endif; ?>
	</div>
	<?php
}

/**
 * Published Fact posts (About page "a few things about me"), in menu order.
 * The fact's text is the post title; fact_icon is the emoji.
 */
function wh_facts() {
	return get_posts(
		array(
			'post_type'      => 'wh_fact',
			'posts_per_page' => -1,
			'post_status'    => 'publish',
			'orderby'        => array(
				'menu_order' => 'ASC',
				'date'       => 'ASC',
			),
		)
	);
}

function wh_render_fact( $post ) {
	$icon = wh_field( 'fact_icon', '', $post->ID );
	?>
	<div><span class="ico"><?php echo esc_html( $icon ); ?></span><?php echo esc_html( get_the_title( $post ) ); ?></div>
	<?php
}

/**
 * Projects flagged to show on the home page ("Currently writing").
 */
function wh_projects_home() {
	return array_values(
		array_filter(
			wh_projects(),
			function ( $p ) {
				return '1' === (string) get_post_meta( $p->ID, 'project_on_home', true );
			}
		)
	);
}

/**
 * Render one home-page "Currently writing" card (.horizon-card) for a project.
 */
function wh_render_home_project_card( $post ) {
	$id       = $post->ID;
	$status   = wh_field( 'project_status', 'in-progress', $id );
	$subtitle = wh_field( 'project_subtitle', '', $id );
	$blurb    = wh_field( 'project_home_blurb', '', $id );
	$progress = (int) wh_field( 'project_progress', 0, $id );
	$plabel   = wh_field( 'project_progress_label', '', $id );
	$labels   = array(
		'now-available' => 'Now available',
		'in-progress'   => 'In progress',
		'planning'      => 'Planning',
	);
	$slabel   = isset( $labels[ $status ] ) ? $labels[ $status ] : 'In progress';
	?>
	<a class="card horizon-card" href="<?php echo esc_url( home_url( '/on-the-horizon/' ) ); ?>">
	  <p class="roadmap__status"><?php echo esc_html( $slabel ); ?></p>
	  <h3><?php echo esc_html( get_the_title( $post ) ); ?></h3>
	  <?php if ( $subtitle ) : ?>
	    <p class="book-card__tag" style="color:var(--text-muted);"><?php echo esc_html( $subtitle ); ?></p>
	  <?php endif; ?>
	  <?php if ( $blurb ) : ?>
	    <p class="txt"><?php echo esc_html( $blurb ); ?></p>
	  <?php endif; ?>
	  <div class="horizon-card__progress">
	    <div class="progress-track"><div class="progress-fill" style="width:<?php echo esc_attr( $progress ); ?>%"></div></div>
	    <?php if ( $plabel ) : ?>
	      <span class="horizon-card__progress-label"><?php echo esc_html( $plabel ); ?></span>
	    <?php endif; ?>
	  </div>
	  <span class="series-spotlight__link">See what else is coming <span aria-hidden="true">→</span></span>
	</a>
	<?php
}

/**
 * All published Review posts, in stable carousel order (menu order, then oldest).
 */
function wh_all_reviews() {
	return get_posts(
		array(
			'post_type'      => 'wh_review',
			'posts_per_page' => -1,
			'post_status'    => 'publish',
			'orderby'        => array(
				'menu_order' => 'ASC',
				'date'       => 'ASC',
			),
		)
	);
}

/**
 * Homepage reviews: those whose placement is "homepage" (treating a missing
 * placement with no book/series assignment as homepage, for safety).
 */
function wh_reviews() {
	return array_values(
		array_filter(
			wh_all_reviews(),
			function ( $p ) {
				$placement = get_post_meta( $p->ID, 'review_placement', true );
				if ( '' === $placement ) {
					return ! get_post_meta( $p->ID, 'review_book', true ) && ! get_post_meta( $p->ID, 'review_series', true );
				}
				return 'homepage' === $placement;
			}
		)
	);
}

/**
 * Reviews assigned to a given book (by book post ID).
 */
function wh_reviews_for_book( $book_id ) {
	if ( ! $book_id ) {
		return array();
	}
	return array_values(
		array_filter(
			wh_all_reviews(),
			function ( $p ) use ( $book_id ) {
				return (int) $book_id === (int) get_post_meta( $p->ID, 'review_book', true );
			}
		)
	);
}

/**
 * Reviews assigned to a given series (by series slug).
 */
function wh_reviews_for_series( $series ) {
	if ( ! $series ) {
		return array();
	}
	return array_values(
		array_filter(
			wh_all_reviews(),
			function ( $p ) use ( $series ) {
				return $series === get_post_meta( $p->ID, 'review_series', true );
			}
		)
	);
}

/**
 * Render one review card, matching the existing .review-card markup. The quote
 * is the post title; the source is the review_source field; stars come from the
 * review_rating field (defaults to 5).
 */
function wh_render_review_card( $post ) {
	$source = wh_field( 'review_source', '', $post->ID );
	$rating = (int) wh_field( 'review_rating', 5, $post->ID );
	if ( $rating < 1 || $rating > 5 ) {
		$rating = 5;
	}
	$stars = str_repeat( '★', $rating ) . str_repeat( '☆', 5 - $rating );
	?>
	<div class="card review-card">
	  <p class="stars"><?php echo esc_html( $stars ); ?></p>
	  <p class="txt">"<?php echo esc_html( get_the_title( $post ) ); ?>"</p>
	  <?php if ( $source ) : ?>
	    <p class="source">— <?php echo esc_html( $source ); ?></p>
	  <?php endif; ?>
	</div>
	<?php
}

/**
 * Render a reviews marquee (two duplicate sets for the CSS loop) from a given
 * array of review posts. Shared by the homepage and the two series pages.
 */
function wh_render_reviews_carousel( $reviews ) {
	if ( ! $reviews ) {
		return;
	}
	?>
	<div class="reviews-carousel">
	  <div class="reviews-carousel__track">
	    <div class="reviews-carousel__set">
	      <?php foreach ( $reviews as $wh_review ) { wh_render_review_card( $wh_review ); } ?>
	    </div>
	    <div class="reviews-carousel__set" aria-hidden="true">
	      <?php foreach ( $reviews as $wh_review ) { wh_render_review_card( $wh_review ); } ?>
	    </div>
	  </div>
	</div>
	<?php
}

/**
 * Render a single event card (shared by the Events page and the home teaser),
 * matching the existing .event-card markup exactly.
 */
function wh_render_event_card( $post ) {
	$id      = $post->ID;
	$date    = wh_field( 'event_date', '', $id );
	$dt      = $date ? DateTime::createFromFormat( 'Ymd', $date ) : false;
	$day     = $dt ? $dt->format( 'j' ) : '';
	$mon     = $dt ? strtoupper( $dt->format( 'M' ) ) : '';
	$details = wh_field( 'event_details', '', $id );
	$url     = wh_field( 'event_url', '', $id );
	?>
	<div class="card event-card">
	  <div class="event-date">
	    <div class="event-date__day"><?php echo esc_html( $day ); ?></div>
	    <div class="event-date__mon"><?php echo esc_html( $mon ); ?></div>
	  </div>
	  <div>
	    <h3><?php echo esc_html( get_the_title( $post ) ); ?></h3>
	    <?php if ( $details ) : ?>
	      <p class="txt"><?php echo esc_html( $details ); ?></p>
	    <?php endif; ?>
	    <?php if ( $url ) : ?>
	      <a class="btn btn--outline btn--sm" href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener">Event details</a>
	    <?php endif; ?>
	  </div>
	</div>
	<?php
}
