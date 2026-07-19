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
 * Cover image URL for a book: the ACF cover_image field, else the theme cover
 * asset at /images/covers/{book_key}.jpg.
 */
function wh_book_cover( $book ) {
	if ( function_exists( 'get_field' ) ) {
		$img = get_field( 'cover_image', $book->ID );
		if ( is_array( $img ) && ! empty( $img['url'] ) ) {
			return $img['url'];
		}
		if ( is_numeric( $img ) ) {
			return wp_get_attachment_image_url( $img, 'full' );
		}
		if ( is_string( $img ) && '' !== $img ) {
			return $img;
		}
	}
	$key = get_post_meta( $book->ID, 'book_key', true );
	return get_template_directory_uri() . '/images/covers/' . $key . '.jpg';
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
 * Published Review posts, in menu order then oldest-first (stable carousel order).
 * Reviews assigned to a specific book (review_book) are excluded — those show on
 * that book's page instead, via wh_reviews_for_book().
 */
function wh_reviews() {
	$posts = get_posts(
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
	return array_values(
		array_filter(
			$posts,
			function ( $p ) {
				return ! get_post_meta( $p->ID, 'review_book', true );
			}
		)
	);
}

/**
 * Published Review posts assigned to a given book (by book post ID).
 */
function wh_reviews_for_book( $book_id ) {
	if ( ! $book_id ) {
		return array();
	}
	return get_posts(
		array(
			'post_type'      => 'wh_review',
			'posts_per_page' => -1,
			'post_status'    => 'publish',
			'orderby'        => array(
				'menu_order' => 'ASC',
				'date'       => 'ASC',
			),
			'meta_key'       => 'review_book',
			'meta_value'     => $book_id,
		)
	);
}

/**
 * Render one review card, matching the existing .review-card markup. The quote
 * is the post title; the source is the review_source field.
 */
function wh_render_review_card( $post ) {
	$source = wh_field( 'review_source', '', $post->ID );
	?>
	<div class="card review-card">
	  <p class="stars">★★★★★</p>
	  <p class="txt">"<?php echo esc_html( get_the_title( $post ) ); ?>"</p>
	  <?php if ( $source ) : ?>
	    <p class="source">— <?php echo esc_html( $source ); ?></p>
	  <?php endif; ?>
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
