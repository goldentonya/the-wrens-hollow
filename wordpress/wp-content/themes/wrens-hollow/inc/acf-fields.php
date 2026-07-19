<?php
/**
 * ACF field definitions, registered in code (not click-configured in the DB) so
 * they version-control with the theme and deploy automatically. Hooked on
 * 'acf/init', which only fires when Advanced Custom Fields is active — so this
 * file is a harmless no-op if the plugin is ever deactivated.
 *
 * Fields are added incrementally: this pass covers the Events custom post type.
 * Reviews, Books, and per-page copy groups are added in later steps.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function wrens_hollow_register_acf_fields() {

	// --- Event fields (attached to the wh_event post type) ---
	acf_add_local_field_group(
		array(
			'key'      => 'group_wh_event',
			'title'    => 'Event details',
			'fields'   => array(
				array(
					'key'           => 'field_wh_event_date',
					'label'         => 'Date',
					'name'          => 'event_date',
					'type'          => 'date_picker',
					'instructions'  => 'The event date. Controls the date badge and the order events appear in.',
					'required'      => 0,
					'display_format'=> 'F j, Y',
					'return_format' => 'Ymd',
					'first_day'     => 0,
				),
				array(
					'key'          => 'field_wh_event_details',
					'label'        => 'Details line',
					'name'         => 'event_details',
					'type'         => 'text',
					'instructions' => 'Location and time, e.g. "📍 Dana\'s Bookstore, Isanti, MN · 11am–2pm".',
					'required'     => 0,
				),
				array(
					'key'          => 'field_wh_event_url',
					'label'        => 'Event link (optional)',
					'name'         => 'event_url',
					'type'         => 'url',
					'instructions' => 'Optional link to a Facebook event or details page. Leave blank for no button.',
					'required'     => 0,
				),
				array(
					'key'           => 'field_wh_event_is_upcoming',
					'label'         => 'Show under "Upcoming"?',
					'name'          => 'is_upcoming',
					'type'          => 'true_false',
					'instructions'  => 'On = listed under Upcoming. Off = listed under Past events.',
					'ui'            => 1,
					'default_value' => 0,
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'wh_event',
					),
				),
			),
			'menu_order'            => 0,
			'position'              => 'normal',
			'style'                 => 'default',
			'active'                => true,
			'show_in_rest'          => 1,
			'hide_on_screen'        => array( 'the_content' ),
		)
	);
}
add_action( 'acf/init', 'wrens_hollow_register_acf_fields' );
