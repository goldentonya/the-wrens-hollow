<?php
/**
 * Pre-launch SEO layer: meta description and JSON-LD structured data — the
 * primitives no plugin in the current production stack provides (no
 * Yoast/Rank Math/AIOSEO is installed). Two things are deliberately NOT done
 * here to avoid duplicating what's already covered:
 *
 * - Open Graph / Twitter Card tags: Jetpack (active in production) already
 *   emits these. Adding our own would print a second, conflicting set.
 * - <link rel="canonical"> for singular posts/pages: WordPress core already
 *   prints this via rel_canonical() (wp-includes/general-template.php), for
 *   every is_singular() request. We only add it where core doesn't — the
 *   WooCommerce Shop archive.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Per-page-template meta description copy, ported from the original static
 * site's <meta name="description"> tags (site/*.html), which never made it
 * into the WordPress build. Keyed by page template file
 * (get_page_template_slug()). Note: the source copy for Veilbound said "Book 1"
 * (a leftover error from the static site); corrected to "Book 2" here.
 */
function wh_seo_description_map() {
	return array(
		'front-page.php'                 => "Fierce love. Brilliant women. Stories with heart. Start reading Veilfall free, then explore Ali Wren's romance and fantasy series.",
		'page-about.php'                 => 'Meet Ali Wren, indie author from Minnesota writing romance and fantasy full of emotion, danger, and unforgettable connections.',
		'page-books.php'                 => "Every book by Ali Wren — the Whiskey Tango Foxtrot and The Veiled Prophecy series. Read the description, then head to each book's page to dive in.",
		'page-on-the-horizon.php'        => "Upcoming books and projects from Ali Wren — what she's currently writing, and what's coming next.",
		'page-events-appearances.php'    => 'Signings, book fairs, and author events — where to find Ali Wren next.',
		'page-the-veiled-prophecy.php'   => 'A world of secrets, prophecy, and dangerous love. Start free with Veilfall, then follow the Kingdom of Sylvaeris saga.',
		'page-whiskey-tango-foxtrot.php' => 'Fierce, funny, unforgettable contemporary romance. Read the first chapters of Whiskey & Secrets and Whiskey & Lies free.',
		'page-veilfall.php'              => 'She thought she was human. The fae realm knows better. Get the free first chapters of Veilfall, delivered to your inbox.',
		'page-veilbound.php'             => 'The next chapter in the Kingdom of Sylvaeris saga. Veilbound, Book 2 in The Veiled Prophecy series by Ali Wren — coming soon.',
		'page-whiskey-and-secrets.php'   => 'Some secrets are worth the hangover. Whiskey & Secrets, Book 1 in the Whiskey Tango Foxtrot series by Ali Wren — signed paperback available now.',
		'page-whiskey-and-lies.php'      => 'Every relationship has a few secrets. Hers might be unforgivable. Whiskey & Lies, Book 2 in the Whiskey Tango Foxtrot series by Ali Wren.',
	);
}

/**
 * The meta description for the current request, or '' if none applies.
 */
function wh_current_meta_description() {
	if ( is_front_page() ) {
		$map = wh_seo_description_map();
		return $map['front-page.php'];
	}

	if ( function_exists( 'is_shop' ) && is_shop() ) {
		return 'Signed paperbacks straight from Ali Wren — shop every available title from The Veiled Prophecy and Whiskey Tango Foxtrot.';
	}

	if ( function_exists( 'is_product' ) && is_product() ) {
		global $product;
		if ( $product instanceof WC_Product ) {
			$short = $product->get_short_description();
			if ( $short ) {
				return wp_strip_all_tags( $short );
			}
		}
		return '';
	}

	if ( is_page() ) {
		$template = get_page_template_slug();
		$map      = wh_seo_description_map();
		if ( $template && isset( $map[ $template ] ) ) {
			return $map[ $template ];
		}
	}

	return '';
}

/**
 * Canonical URL for requests core's rel_canonical() doesn't cover (anything
 * that isn't is_singular() — here, just the Shop archive).
 */
function wh_shop_canonical_url() {
	if ( function_exists( 'wc_get_page_id' ) ) {
		$permalink = get_permalink( wc_get_page_id( 'shop' ) );
		if ( $permalink ) {
			return $permalink;
		}
	}
	global $wp;
	return home_url( add_query_arg( array(), $wp->request ) );
}

/**
 * Emits <meta name="description"> (all templates) and <link rel="canonical">
 * only where WordPress core doesn't already (see file header).
 */
function wh_output_meta_tags() {
	$description = wh_current_meta_description();
	if ( $description ) {
		echo '<meta name="description" content="' . esc_attr( $description ) . '">' . "\n";
	}
	if ( ! is_singular() && function_exists( 'is_shop' ) && is_shop() ) {
		echo '<link rel="canonical" href="' . esc_url( wh_shop_canonical_url() ) . '">' . "\n";
	}
}
add_action( 'wp_head', 'wh_output_meta_tags', 1 );

/**
 * Site-wide JSON-LD: WebSite + Person (Ali Wren), so search engines associate
 * the whole site with the author (Google Knowledge Graph, author search
 * results). Printed on every front-end page — cheap and standard practice.
 */
function wh_output_person_schema() {
	if ( is_admin() ) {
		return;
	}
	$same_as = array_values(
		array_filter(
			array(
				function_exists( 'wh_social' ) ? wh_social( 'facebook' ) : '',
				function_exists( 'wh_social' ) ? wh_social( 'instagram' ) : '',
				function_exists( 'wh_social' ) ? wh_social( 'tiktok' ) : '',
				function_exists( 'wh_social' ) ? wh_social( 'goodreads' ) : '',
				function_exists( 'wh_social' ) ? wh_social( 'amazon' ) : '',
			)
		)
	);
	$data = array(
		'@context' => 'https://schema.org',
		'@graph'   => array(
			array(
				'@type'     => 'WebSite',
				'@id'       => home_url( '/#website' ),
				'url'       => home_url( '/' ),
				// 'raw' context, not the default 'display' one — get_bloginfo()
				// entity-encodes for HTML by default (e.g. "Wren&#039;s"), which
				// JSON doesn't need and would otherwise leak into the string.
				'name'      => get_bloginfo( 'name', 'raw' ) ? get_bloginfo( 'name', 'raw' ) : "The Wren's Hollow",
				'publisher' => array( '@id' => home_url( '/#person' ) ),
			),
			array(
				'@type'  => 'Person',
				'@id'    => home_url( '/#person' ),
				'name'   => 'Ali Wren',
				'url'    => home_url( '/about/' ),
				'sameAs' => $same_as,
			),
		),
	);
	echo '<script type="application/ld+json">' . wp_json_encode( $data ) . '</script>' . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput -- JSON, not HTML.
}
add_action( 'wp_head', 'wh_output_person_schema', 2 );

/**
 * Book schema on each of the four individual book pages, reusing the same
 * wh_book() data those templates already render with.
 */
function wh_output_book_schema() {
	if ( ! is_page() || ! function_exists( 'wh_book' ) ) {
		return;
	}
	$book_templates = array(
		'page-veilfall.php'            => 'veilfall',
		'page-veilbound.php'           => 'veilbound',
		'page-whiskey-and-secrets.php' => 'whiskey-and-secrets',
		'page-whiskey-and-lies.php'    => 'whiskey-and-lies',
	);
	$template = get_page_template_slug();
	if ( ! isset( $book_templates[ $template ] ) ) {
		return;
	}
	$book = wh_book( $book_templates[ $template ] );
	if ( ! $book ) {
		return;
	}
	$data = array(
		'@context' => 'https://schema.org',
		'@type'    => 'Book',
		'name'     => get_the_title( $book ),
		'author'   => array(
			'@type' => 'Person',
			'name'  => 'Ali Wren',
		),
		'url'      => get_permalink(),
		'image'    => wh_book_cover( $book ),
	);
	$description = wh_field( 'about_body', '', $book->ID );
	if ( $description ) {
		$data['description'] = wp_strip_all_tags( $description );
	}
	echo '<script type="application/ld+json">' . wp_json_encode( $data ) . '</script>' . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput -- JSON, not HTML.
}
add_action( 'wp_head', 'wh_output_book_schema', 2 );
