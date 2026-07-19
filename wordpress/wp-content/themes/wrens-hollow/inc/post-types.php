<?php
/**
 * Custom post types backing the site's owner-editable lists: Events, Reviews,
 * and Books. Registered here in code so the types exist even if the Custom Post
 * Type UI plugin is deactivated — CPT UI is installed only so the owner can see
 * and confirm these lists in the dashboard; this file is the source of truth.
 *
 * Each type is show_ui but not publicly queryable: the front end pulls them via
 * WP_Query in the page templates, so they don't need their own public single
 * URLs (and can't collide with existing page slugs).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function wrens_hollow_register_post_types() {
	register_post_type(
		'wh_event',
		array(
			'labels'       => array(
				'name'          => 'Events',
				'singular_name' => 'Event',
				'menu_name'     => 'Events',
				'add_new_item'  => 'Add New Event',
				'edit_item'     => 'Edit Event',
				'new_item'      => 'New Event',
				'all_items'     => 'All Events',
			),
			'public'       => false,
			'show_ui'      => true,
			'show_in_menu' => true,
			'show_in_rest' => true,
			'menu_icon'    => 'dashicons-calendar-alt',
			'menu_position'=> 21,
			'supports'     => array( 'title' ),
		)
	);

	register_post_type(
		'wh_review',
		array(
			'labels'       => array(
				'name'          => 'Reviews',
				'singular_name' => 'Review',
				'menu_name'     => 'Reviews',
				'add_new_item'  => 'Add New Review',
				'edit_item'     => 'Edit Review',
				'new_item'      => 'New Review',
				'all_items'     => 'All Reviews',
			),
			'public'       => false,
			'show_ui'      => true,
			'show_in_menu' => true,
			'show_in_rest' => true,
			'menu_icon'    => 'dashicons-format-quote',
			'menu_position'=> 22,
			'supports'     => array( 'title' ),
		)
	);

	register_post_type(
		'wh_book',
		array(
			'labels'       => array(
				'name'          => 'Books',
				'singular_name' => 'Book',
				'menu_name'     => 'Books',
				'add_new_item'  => 'Add New Book',
				'edit_item'     => 'Edit Book',
				'new_item'      => 'New Book',
				'all_items'     => 'All Books',
			),
			'public'       => false,
			'show_ui'      => true,
			'show_in_menu' => true,
			'show_in_rest' => true,
			'menu_icon'    => 'dashicons-book',
			'menu_position'=> 23,
			'supports'     => array( 'title', 'thumbnail' ),
		)
	);
}
add_action( 'init', 'wrens_hollow_register_post_types' );
