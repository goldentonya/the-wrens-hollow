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

	// --- Review fields (attached to the wh_review post type) ---
	// The quote itself is the post Title (relabeled in post-types.php); this
	// group adds only the attribution source.
	acf_add_local_field_group(
		array(
			'key'      => 'group_wh_review',
			'title'    => 'Review',
			'fields'   => array(
				array(
					'key'           => 'field_wh_review_rating',
					'label'         => 'Star rating',
					'name'          => 'review_rating',
					'type'          => 'select',
					'instructions'  => 'How many stars this review shows.',
					'choices'       => array(
						'5' => '★★★★★  (5 stars)',
						'4' => '★★★★☆  (4 stars)',
						'3' => '★★★☆☆  (3 stars)',
						'2' => '★★☆☆☆  (2 stars)',
						'1' => '★☆☆☆☆  (1 star)',
					),
					'default_value' => '5',
					'return_format' => 'value',
					'allow_null'    => 0,
				),
				array(
					'key'          => 'field_wh_review_source',
					'label'        => 'Source',
					'name'         => 'review_source',
					'type'         => 'text',
					'instructions' => 'Where the review came from, e.g. "Goodreads", "Amazon", "@reads.with.casey, TikTok". Shown after the em dash.',
					'required'     => 0,
				),
				array(
					'key'           => 'field_wh_review_placement',
					'label'         => 'Where should this review appear?',
					'name'          => 'review_placement',
					'type'          => 'radio',
					'instructions'  => 'Pick where on the site this review is shown.',
					'choices'       => array(
						'homepage' => 'Homepage carousel',
						'book'      => "A specific book's page",
						'series'    => 'A series page',
					),
					'default_value' => 'homepage',
					'layout'        => 'vertical',
					'return_format' => 'value',
					'required'      => 1,
				),
				array(
					'key'               => 'field_wh_review_book',
					'label'             => 'Which book?',
					'name'              => 'review_book',
					'type'              => 'post_object',
					'instructions'      => 'The book whose page this review appears on.',
					'post_type'         => array( 'wh_book' ),
					'return_format'     => 'id',
					'allow_null'        => 1,
					'ui'                => 1,
					'conditional_logic' => array(
						array(
							array(
								'field'    => 'field_wh_review_placement',
								'operator' => '==',
								'value'    => 'book',
							),
						),
					),
				),
				array(
					'key'               => 'field_wh_review_series',
					'label'             => 'Which series?',
					'name'              => 'review_series',
					'type'              => 'select',
					'instructions'      => 'The series page this review appears on.',
					'choices'           => array(
						'whiskey-tango-foxtrot' => 'Whiskey Tango Foxtrot',
						'veiled-prophecy'       => 'The Veiled Prophecy',
					),
					'allow_null'        => 1,
					'return_format'     => 'value',
					'conditional_logic' => array(
						array(
							array(
								'field'    => 'field_wh_review_placement',
								'operator' => '==',
								'value'    => 'series',
							),
						),
					),
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'wh_review',
					),
				),
			),
			'menu_order'     => 0,
			'position'       => 'normal',
			'style'          => 'default',
			'active'         => true,
			'show_in_rest'   => 1,
			'hide_on_screen' => array( 'the_content' ),
		)
	);

	// --- Book fields (attached to the wh_book post type) ---
	// The post Title is the book title. These fields drive the Books library
	// grid and the core editable copy on each book's detail page. Bespoke
	// detail-page sections (buy buttons, opt-in forms, etc.) stay in templates.
	acf_add_local_field_group(
		array(
			'key'      => 'group_wh_book',
			'title'    => 'Book details',
			'fields'   => array(

				// ---- Tab: Basics ----
				array(
					'key'       => 'field_wh_book_tab_basics',
					'label'     => 'Basics',
					'type'      => 'tab',
					'placement' => 'top',
				),
				array(
					'key'          => 'field_wh_book_key',
					'label'        => 'Page key (slug)',
					'name'         => 'book_key',
					'type'         => 'text',
					'instructions' => 'The slug of this book\'s page, e.g. "veilfall". This links the book to its page and its cover. For a brand-new book, set this to match the new page\'s URL slug.',
					'required'     => 1,
				),
				array(
					'key'           => 'field_wh_book_series',
					'label'         => 'Series',
					'name'          => 'series',
					'type'          => 'select',
					'instructions'  => 'Which series this book belongs to (groups it on the Books page).',
					'choices'       => array(
						'whiskey-tango-foxtrot' => 'Whiskey Tango Foxtrot',
						'veiled-prophecy'       => 'The Veiled Prophecy',
					),
					'allow_null'    => 1,
					'return_format' => 'value',
				),
				array(
					'key'           => 'field_wh_book_number',
					'label'         => 'Book number in series',
					'name'          => 'book_number',
					'type'          => 'number',
					'instructions'  => 'Order within the series (1, 2, 3…).',
					'default_value' => 1,
				),

				// ---- Tab: Books-page card ----
				array(
					'key'       => 'field_wh_book_tab_card',
					'label'     => 'Books-page card',
					'type'      => 'tab',
					'placement' => 'top',
				),
				array(
					'key'     => 'field_wh_book_msg_card',
					'label'   => '',
					'name'    => '',
					'type'    => 'message',
					'message' => 'These fields appear on the main **Books** library page — the small card for this book. (The cover image comes from the “Book cover” box on the right.)',
				),
				array(
					'key'          => 'field_wh_book_grid_tag',
					'label'        => 'Card tag',
					'name'         => 'grid_tag',
					'type'         => 'text',
					'instructions' => 'Small label on the Books-page card, e.g. "Book 1 · Available now" or "Book 2 · Coming soon".',
				),
				array(
					'key'          => 'field_wh_book_grid_blurb',
					'label'        => 'Card blurb',
					'name'         => 'grid_blurb',
					'type'         => 'textarea',
					'instructions' => 'Short description shown on the Books-page card.',
					'rows'         => 3,
				),

				// ---- Tab: This book's own page ----
				array(
					'key'       => 'field_wh_book_tab_page',
					'label'     => "This book's own page",
					'type'      => 'tab',
					'placement' => 'top',
				),
				array(
					'key'     => 'field_wh_book_msg_page',
					'label'   => '',
					'name'    => '',
					'type'    => 'message',
					'message' => 'These fields appear on this book’s **own page** (e.g. /veilfall/). The title comes from the “Title” box at the top; the cover comes from the “Book cover” box on the right.',
				),
				array(
					'key'          => 'field_wh_book_hero_tag',
					'label'        => 'Hero tag',
					'name'         => 'hero_tag',
					'type'         => 'text',
					'instructions' => 'Small label at the top of the hero, e.g. "Book 1 · Available now".',
				),
				array(
					'key'          => 'field_wh_book_hero_lede',
					'label'        => 'Header tagline',
					'name'         => 'hero_lede',
					'type'         => 'text',
					'instructions' => 'One-line tagline under the title in the dark header, e.g. "Some secrets are worth the hangover.".',
				),
				array(
					'key'          => 'field_wh_book_hero_blurb',
					'label'        => 'Hero paragraph',
					'name'         => 'hero_blurb',
					'type'         => 'textarea',
					'instructions' => 'The paragraph beside the cover in the pink hero section.',
					'rows'         => 4,
				),
				array(
					'key'          => 'field_wh_book_about_body',
					'label'        => 'About the book',
					'name'         => 'about_body',
					'type'         => 'wysiwyg',
					'instructions' => 'The full "About the book" description. You can use bold, italics, and links here.',
					'media_upload' => 0,
					'tabs'         => 'all',
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'wh_book',
					),
				),
			),
			'menu_order'     => 0,
			'position'       => 'normal',
			'style'          => 'default',
			'active'         => true,
			'show_in_rest'   => 1,
			'hide_on_screen' => array( 'the_content' ),
		)
	);

	// --- Project fields (attached to the wh_project post type / On the Horizon) ---
	acf_add_local_field_group(
		array(
			'key'      => 'group_wh_project',
			'title'    => 'Project details',
			'fields'   => array(
				array(
					'key'           => 'field_wh_project_status',
					'label'         => 'Status',
					'name'          => 'project_status',
					'type'          => 'select',
					'instructions'  => 'Controls the marker and label on the timeline.',
					'choices'       => array(
						'now-available' => 'Now available',
						'in-progress'   => 'In progress',
						'planning'      => 'Planning',
					),
					'default_value' => 'in-progress',
					'return_format' => 'value',
					'allow_null'    => 0,
				),
				array(
					'key'          => 'field_wh_project_subtitle',
					'label'        => 'Subtitle line',
					'name'         => 'project_subtitle',
					'type'         => 'text',
					'instructions' => 'The small grey line under the title, e.g. "Book 2 · The Veiled Prophecy · Fae Fantasy Romance".',
				),
				array(
					'key'          => 'field_wh_project_body',
					'label'        => 'Description',
					'name'         => 'project_body',
					'type'         => 'wysiwyg',
					'media_upload' => 0,
					'tabs'         => 'all',
				),
				array(
					'key'          => 'field_wh_project_link_label',
					'label'        => 'Button label (optional)',
					'name'         => 'project_link_label',
					'type'         => 'text',
					'instructions' => 'Leave the label and link empty for no button.',
				),
				array(
					'key'          => 'field_wh_project_link_url',
					'label'        => 'Button link (optional)',
					'name'         => 'project_link_url',
					'type'         => 'url',
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'wh_project',
					),
				),
			),
			'menu_order'     => 0,
			'position'       => 'normal',
			'style'          => 'default',
			'active'         => true,
			'show_in_rest'   => 1,
			'hide_on_screen' => array( 'the_content' ),
		)
	);
}
add_action( 'acf/init', 'wrens_hollow_register_acf_fields' );
