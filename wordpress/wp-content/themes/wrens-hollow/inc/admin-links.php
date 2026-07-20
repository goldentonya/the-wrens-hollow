<?php
/**
 * "Content shown on this page" meta box — added to the Page editor sidebar.
 *
 * Every page's own text (headings, hero copy, etc.) already appears as labeled
 * fields right on that page's edit screen via ACF (see inc/acf-page-fields.php,
 * position: acf_after_title), so the standard admin-bar "Edit Page" link already
 * lands somewhere the owner can edit that content directly — no extra step
 * needed there.
 *
 * What ISN'T on the page screen is the *list* content — Events, Reviews, Books,
 * Writing (projects), Team — which lives in its own dashboard menu, the same
 * way blog posts or shop products do. This box gives one-click shortcuts from
 * the page to whichever of those menus feed that page, so "click Edit on the
 * page" always leads somewhere useful. Book pages are the special case: their
 * real content lives on the matching Book post, so their box links straight to
 * "Edit this book" instead of implying the page text itself is the source.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Template file => list of [label, admin edit.php query] shown for that
 * template's pages. Keyed by the page template filename (get_page_template_slug()).
 */
function wrens_hollow_page_content_links_map() {
	return array(
		'page-about.php'                    => array(
			array( 'label' => 'Manage journey timeline →', 'post_type' => 'wh_milestone' ),
			array( 'label' => 'Manage facts list →', 'post_type' => 'wh_fact' ),
		),
		'front-page.php'                    => array(
			array( 'label' => 'Manage reviews (homepage carousel) →', 'post_type' => 'wh_review' ),
			array( 'label' => 'Manage "Currently writing" projects →', 'post_type' => 'wh_project' ),
			array( 'label' => 'Manage events (teaser) →', 'post_type' => 'wh_event' ),
		),
		'page-books.php'                    => array(
			array( 'label' => 'Manage books →', 'post_type' => 'wh_book' ),
		),
		'page-events-appearances.php'       => array(
			array( 'label' => 'Manage events →', 'post_type' => 'wh_event' ),
		),
		'page-on-the-horizon.php'           => array(
			array( 'label' => 'Manage projects →', 'post_type' => 'wh_project' ),
		),
		'page-the-veiled-prophecy.php'      => array(
			array( 'label' => 'Manage reviews (this series) →', 'post_type' => 'wh_review' ),
			array( 'label' => 'Manage books →', 'post_type' => 'wh_book' ),
		),
		'page-whiskey-tango-foxtrot.php'    => array(
			array( 'label' => 'Manage reviews (this series) →', 'post_type' => 'wh_review' ),
			array( 'label' => 'Manage books →', 'post_type' => 'wh_book' ),
			array( 'label' => 'Manage the team roster →', 'post_type' => 'wh_character' ),
		),
	);
}

/**
 * Template file => the Book "page key" it displays, for the four book pages
 * whose content lives on a Book post rather than the page itself. Matches the
 * book_key values set in inc/acf-fields.php / seeded in wp-cli/seed-content.php.
 */
function wrens_hollow_page_book_key_map() {
	return array(
		'page-veilfall.php'             => 'veilfall',
		'page-veilbound.php'            => 'veilbound',
		'page-whiskey-and-secrets.php'  => 'whiskey-and-secrets',
		'page-whiskey-and-lies.php'     => 'whiskey-and-lies',
	);
}

function wrens_hollow_register_admin_links_metabox() {
	add_meta_box(
		'wh_page_content_links',
		'Content shown on this page',
		'wrens_hollow_render_admin_links_metabox',
		'page',
		'side',
		'high'
	);
}
add_action( 'add_meta_boxes', 'wrens_hollow_register_admin_links_metabox' );

function wrens_hollow_render_admin_links_metabox( $post ) {
	$template = get_page_template_slug( $post );

	$book_map = wrens_hollow_page_book_key_map();
	if ( isset( $book_map[ $template ] ) && function_exists( 'wh_book' ) ) {
		$book = wh_book( $book_map[ $template ] );
		echo '<p style="margin-top:0;">This page\'s title, hero text, and "About the book" come from a <strong>Book</strong> entry, not this page — edit them there:</p>';
		if ( $book ) {
			printf(
				'<p><a class="button button-primary" href="%s">Edit this book →</a></p>',
				esc_url( get_edit_post_link( $book->ID, '' ) )
			);
		} else {
			echo '<p><em>No matching Book entry found yet — check the Books menu.</em></p>';
			printf(
				'<p><a class="button" href="%s">Go to Books →</a></p>',
				esc_url( admin_url( 'edit.php?post_type=wh_book' ) )
			);
		}
		printf(
			'<p><a class="button" href="%s">Manage reviews (this book) →</a></p>',
			esc_url( admin_url( 'edit.php?post_type=wh_review' ) )
		);
		return;
	}

	$map   = wrens_hollow_page_content_links_map();
	$links = isset( $map[ $template ] ) ? $map[ $template ] : array();

	if ( ! $links ) {
		echo '<p style="margin-top:0;">' .
			esc_html__( 'This page has no separately-managed lists — everything on it is edited right here on this screen.', 'wrens-hollow' ) .
			'</p>';
		return;
	}

	echo '<p style="margin-top:0;">The text above is edited right here. These sections pull from their own menus:</p>';
	foreach ( $links as $link ) {
		printf(
			'<p style="margin-bottom:8px;"><a class="button" href="%s">%s</a></p>',
			esc_url( admin_url( 'edit.php?post_type=' . $link['post_type'] ) ),
			esc_html( $link['label'] )
		);
	}
}
