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
		'wh_character',
		array(
			'labels'       => array(
				'name'                  => 'Team',
				'singular_name'         => 'Team member',
				'menu_name'             => 'Team',
				'add_new_item'          => 'Add New Team Member',
				'edit_item'             => 'Edit Team Member',
				'new_item'              => 'New Team Member',
				'all_items'             => 'All Team Members',
				'featured_image'        => 'Badge image',
				'set_featured_image'    => 'Set badge image',
				'remove_featured_image' => 'Remove badge image',
				'use_featured_image'    => 'Use as badge image',
			),
			'public'       => false,
			'show_ui'      => true,
			'show_in_menu' => true,
			'show_in_rest' => true,
			'menu_icon'    => 'dashicons-groups',
			'menu_position'=> 25,
			'supports'     => array( 'title', 'thumbnail', 'page-attributes' ),
		)
	);

	register_post_type(
		'wh_project',
		array(
			'labels'       => array(
				'name'          => 'Writing',
				'singular_name' => 'Project',
				'menu_name'     => 'Writing',
				'add_new_item'  => 'Add New Project',
				'edit_item'     => 'Edit Project',
				'new_item'      => 'New Project',
				'all_items'     => 'All Projects (On the Horizon)',
			),
			'public'       => false,
			'show_ui'      => true,
			'show_in_menu' => true,
			'show_in_rest' => true,
			'menu_icon'    => 'dashicons-edit',
			'menu_position'=> 24,
			'supports'     => array( 'title', 'page-attributes' ),
		)
	);

	register_post_type(
		'wh_milestone',
		array(
			'labels'       => array(
				'name'          => 'Journey',
				'singular_name' => 'Milestone',
				'menu_name'     => 'Journey',
				'add_new_item'  => 'Add New Milestone',
				'edit_item'     => 'Edit Milestone',
				'new_item'      => 'New Milestone',
				'all_items'     => 'All Milestones (About page timeline)',
			),
			'public'       => false,
			'show_ui'      => true,
			'show_in_menu' => true,
			'show_in_rest' => true,
			'menu_icon'    => 'dashicons-clock',
			'menu_position'=> 26,
			'supports'     => array( 'title', 'page-attributes' ),
		)
	);

	register_post_type(
		'wh_fact',
		array(
			'labels'       => array(
				'name'          => 'Facts',
				'singular_name' => 'Fact',
				'menu_name'     => 'Facts',
				'add_new_item'  => 'Add New Fact',
				'edit_item'     => 'Edit Fact',
				'new_item'      => 'New Fact',
				'all_items'     => 'All Facts (About page)',
			),
			'public'       => false,
			'show_ui'      => true,
			'show_in_menu' => true,
			'show_in_rest' => true,
			'menu_icon'    => 'dashicons-info',
			'menu_position'=> 27,
			'supports'     => array( 'title', 'page-attributes' ),
		)
	);

	register_post_type(
		'wh_book',
		array(
			'labels'       => array(
				'name'                  => 'Books',
				'singular_name'         => 'Book',
				'menu_name'             => 'Books',
				'add_new_item'          => 'Add New Book',
				'edit_item'             => 'Edit Book',
				'new_item'              => 'New Book',
				'all_items'             => 'All Books',
				'featured_image'        => 'Book cover',
				'set_featured_image'    => 'Set book cover',
				'remove_featured_image' => 'Remove book cover',
				'use_featured_image'    => 'Use as book cover',
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

/**
 * Relabel the Title box on the Review editor so it's clear the title is the
 * quote itself (Reviews carry no body — just quote + source).
 */
function wrens_hollow_enter_title_here( $text, $post ) {
	if ( isset( $post->post_type ) && 'wh_review' === $post->post_type ) {
		return 'Review quote — what the reader said';
	}
	if ( isset( $post->post_type ) && 'wh_character' === $post->post_type ) {
		return 'Name & callsign — e.g. Wade "Wraith" Blakely';
	}
	if ( isset( $post->post_type ) && 'wh_milestone' === $post->post_type ) {
		return 'Short label (for your reference only, not shown on the site)';
	}
	if ( isset( $post->post_type ) && 'wh_fact' === $post->post_type ) {
		return 'Fact text — e.g. "Based in Minnesota"';
	}
	return $text;
}
add_filter( 'enter_title_here', 'wrens_hollow_enter_title_here', 10, 2 );
