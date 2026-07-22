<?php
/**
 * ACF field groups for per-page editable copy (headings, taglines, section
 * text). Each group is bound to a page template. Fields carry the current copy
 * as their default_value, so the editor is pre-filled and the front end shows
 * that text with no seeding required; templates also pass the same text as a
 * fallback to wh_the()/wh_wysiwyg() as belt-and-suspenders.
 *
 * Registered on 'acf/init' (a no-op when ACF is inactive).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function wrens_hollow_register_page_fields() {

	// ===== Events & Appearances page =====
	acf_add_local_field_group(
		array(
			'key'      => 'group_wh_page_events',
			'title'    => 'Page copy — Events',
			'fields'   => array(
				array(
					'key'           => 'field_wh_ev_eyebrow',
					'label'         => 'Eyebrow',
					'name'          => 'ev_eyebrow',
					'type'          => 'text',
					'default_value' => 'Events & appearances',
				),
				array(
					'key'           => 'field_wh_ev_title',
					'label'         => 'Heading',
					'name'          => 'ev_title',
					'type'          => 'text',
					'default_value' => 'Come say hi',
				),
				array(
					'key'           => 'field_wh_ev_lede',
					'label'         => 'Intro line',
					'name'          => 'ev_lede',
					'type'          => 'textarea',
					'rows'          => 2,
					'default_value' => 'Signings, book fairs & author events — where to find me next.',
				),
				array(
					'key'     => 'field_wh_ev_msg_news',
					'type'    => 'message',
					'message' => 'The "Join the Hollow" band near the bottom of the page.',
				),
				array(
					'key'           => 'field_wh_ev_news_eyebrow',
					'label'         => 'Newsletter band — eyebrow',
					'name'          => 'news_eyebrow',
					'type'          => 'text',
					'default_value' => 'Join the Hollow',
				),
				array(
					'key'           => 'field_wh_ev_news_heading',
					'label'         => 'Newsletter band — heading',
					'name'          => 'news_heading',
					'type'          => 'text',
					'default_value' => 'Never miss an event or release',
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'page-events-appearances.php',
					),
				),
			),
			'menu_order'     => 0,
			'position'       => 'acf_after_title',
			'style'          => 'default',
			'active'         => true,
			'hide_on_screen' => array( 'the_content' ),
		)
	);

	// ===== Home page =====
	acf_add_local_field_group(
		array(
			'key'      => 'group_wh_page_home',
			'title'    => 'Page copy — Home',
			'fields'   => array(
				array(
					'key'       => 'field_wh_home_tab_hero',
					'label'     => 'Hero',
					'type'      => 'tab',
					'placement' => 'top',
				),
				array(
					'key'           => 'field_wh_home_hero_image',
					'label'         => 'Cover photo',
					'name'          => 'home_hero_image',
					'type'          => 'image',
					'instructions'  => 'The large banner photo at the top of the homepage.',
					'return_format' => 'array',
					'preview_size'  => 'medium',
				),
				array(
					'key'           => 'field_wh_home_hero_eyebrow',
					'label'         => 'Hero eyebrow',
					'name'          => 'home_hero_eyebrow',
					'type'          => 'text',
					'default_value' => 'The Veiled Prophecy · Book 1',
				),
				array(
					'key'           => 'field_wh_home_hero_title',
					'label'         => 'Hero heading',
					'name'          => 'home_hero_title',
					'type'          => 'text',
					'default_value' => "She doesn't know who to trust.",
				),
				array(
					'key'           => 'field_wh_home_hero_button',
					'label'         => 'Hero button label',
					'name'          => 'home_hero_button',
					'type'          => 'text',
					'default_value' => 'Start Reading Free →',
				),
				array(
					'key'           => 'field_wh_home_hero_trust',
					'label'         => 'Trust line',
					'name'          => 'home_hero_trust',
					'type'          => 'text',
					'default_value' => '★★★★★ · 200+ reviews · free forever',
				),
				array(
					'key'       => 'field_wh_home_tab_books',
					'label'     => 'Explore the books',
					'type'      => 'tab',
					'placement' => 'top',
				),
				array(
					'key'           => 'field_wh_home_books_eyebrow',
					'label'         => 'Eyebrow',
					'name'          => 'home_books_eyebrow',
					'type'          => 'text',
					'default_value' => 'Explore the books',
				),
				array(
					'key'           => 'field_wh_home_books_heading',
					'label'         => 'Heading',
					'name'          => 'home_books_heading',
					'type'          => 'text',
					'default_value' => 'Two worlds, one storyteller',
				),
				array(
					'key'           => 'field_wh_home_books_lede',
					'label'         => 'Intro line',
					'name'          => 'home_books_lede',
					'type'          => 'text',
					'default_value' => 'Fierce contemporary romance. Dark fae fantasy. Pick your escape.',
				),
				array(
					'key'     => 'field_wh_home_msg_spot',
					'type'    => 'message',
					'message' => 'The two large cards below the intro line above. Each links to a series page.',
				),
				array(
					'key'           => 'field_wh_home_spot1_cover',
					'label'         => 'Spotlight 1 — cover image',
					'name'          => 'home_spot1_cover',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'medium',
				),
				array(
					'key'           => 'field_wh_home_spot1_tag',
					'label'         => 'Spotlight 1 — tag',
					'name'          => 'home_spot1_tag',
					'type'          => 'text',
					'default_value' => 'Fantasy · Kingdom of Sylvaeris',
				),
				array(
					'key'           => 'field_wh_home_spot1_title',
					'label'         => 'Spotlight 1 — title',
					'name'          => 'home_spot1_title',
					'type'          => 'text',
					'default_value' => 'The Veiled Prophecy',
				),
				array(
					'key'           => 'field_wh_home_spot1_blurb',
					'label'         => 'Spotlight 1 — blurb',
					'name'          => 'home_spot1_blurb',
					'type'          => 'textarea',
					'rows'          => 3,
					'default_value' => 'She thought she was human. The fae realm knows better. Start Veralyn\'s story with Veilfall, free forever.',
				),
				array(
					'key'           => 'field_wh_home_spot1_url',
					'label'         => 'Spotlight 1 — link',
					'name'          => 'home_spot1_url',
					'type'          => 'text',
					'default_value' => '/the-veiled-prophecy/',
				),
				array(
					'key'           => 'field_wh_home_spot2_cover',
					'label'         => 'Spotlight 2 — cover image',
					'name'          => 'home_spot2_cover',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'medium',
				),
				array(
					'key'           => 'field_wh_home_spot2_tag',
					'label'         => 'Spotlight 2 — tag',
					'name'          => 'home_spot2_tag',
					'type'          => 'text',
					'default_value' => 'Contemporary romance',
				),
				array(
					'key'           => 'field_wh_home_spot2_title',
					'label'         => 'Spotlight 2 — title',
					'name'          => 'home_spot2_title',
					'type'          => 'text',
					'default_value' => 'Whiskey Tango Foxtrot',
				),
				array(
					'key'           => 'field_wh_home_spot2_blurb',
					'label'         => 'Spotlight 2 — blurb',
					'name'          => 'home_spot2_blurb',
					'type'          => 'textarea',
					'rows'          => 3,
					'default_value' => "Whiskey &amp; Secrets · Whiskey &amp; Lies. Sharp banter, real heartbreak, and women who don't back down.",
				),
				array(
					'key'           => 'field_wh_home_spot2_url',
					'label'         => 'Spotlight 2 — link',
					'name'          => 'home_spot2_url',
					'type'          => 'text',
					'default_value' => '/whiskey-tango-foxtrot/',
				),
				array(
					'key'       => 'field_wh_home_tab_about',
					'label'     => 'About teaser',
					'type'      => 'tab',
					'placement' => 'top',
				),
				array(
					'key'           => 'field_wh_home_about_eyebrow',
					'label'         => 'Eyebrow',
					'name'          => 'home_about_eyebrow',
					'type'          => 'text',
					'default_value' => 'Behind the pen',
				),
				array(
					'key'           => 'field_wh_home_about_heading',
					'label'         => 'Heading',
					'name'          => 'home_about_heading',
					'type'          => 'text',
					'default_value' => "Hi, I'm Ali Wren",
				),
				array(
					'key'           => 'field_wh_home_about_quote',
					'label'         => 'Quote',
					'name'          => 'home_about_quote',
					'type'          => 'textarea',
					'rows'          => 4,
					'default_value' => 'Author, biological anthropologist, and proud Minnesota mom. I write romantic adventures that blend science, suspense, and heart — stories with fierce heroines, loyal heroes, and love that\'s never quite as simple as it seems.',
				),

				array(
					'key'       => 'field_wh_home_tab_writing',
					'label'     => 'Currently writing',
					'type'      => 'tab',
					'placement' => 'top',
				),
				array(
					'key'     => 'field_wh_home_msg_writing',
					'type'    => 'message',
					'message' => 'The cards come from the **Writing** menu — mark a project "Feature on the home page" to show it here. Only the two headings below live on this page.',
				),
				array(
					'key'           => 'field_wh_home_writing_eyebrow',
					'label'         => 'Eyebrow',
					'name'          => 'home_writing_eyebrow',
					'type'          => 'text',
					'default_value' => 'On the horizon',
				),
				array(
					'key'           => 'field_wh_home_writing_heading',
					'label'         => 'Heading',
					'name'          => 'home_writing_heading',
					'type'          => 'text',
					'default_value' => 'Currently writing',
				),

				array(
					'key'       => 'field_wh_home_tab_events',
					'label'     => 'Events teaser',
					'type'      => 'tab',
					'placement' => 'top',
				),
				array(
					'key'     => 'field_wh_home_msg_events',
					'type'    => 'message',
					'message' => 'The event cards come from the **Events** menu (upcoming + the two most recent past events). Only the heading below lives on this page.',
				),
				array(
					'key'           => 'field_wh_home_events_eyebrow',
					'label'         => 'Eyebrow',
					'name'          => 'home_events_eyebrow',
					'type'          => 'text',
					'default_value' => 'Events & appearances',
				),
				array(
					'key'           => 'field_wh_home_events_lede',
					'label'         => 'Intro line',
					'name'          => 'home_events_lede',
					'type'          => 'text',
					'default_value' => 'Signings, book fairs & author events — where to find me next.',
				),

				array(
					'key'       => 'field_wh_home_tab_news',
					'label'     => 'Newsletter band',
					'type'      => 'tab',
					'placement' => 'top',
				),
				array(
					'key'           => 'field_wh_home_news_eyebrow',
					'label'         => 'Eyebrow',
					'name'          => 'home_news_eyebrow',
					'type'          => 'text',
					'default_value' => 'Join the Hollow',
				),
				array(
					'key'           => 'field_wh_home_news_heading',
					'label'         => 'Heading',
					'name'          => 'home_news_heading',
					'type'          => 'text',
					'default_value' => 'Get bonus chapters + first look at new releases',
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'front-page.php',
					),
				),
			),
			'menu_order'     => 0,
			'position'       => 'acf_after_title',
			'style'          => 'default',
			'active'         => true,
			'hide_on_screen' => array( 'the_content' ),
		)
	);

	// ===== Books page =====
	acf_add_local_field_group(
		array(
			'key'      => 'group_wh_page_books',
			'title'    => 'Page copy — Books',
			'fields'   => array(
				array(
					'key'           => 'field_wh_books_eyebrow',
					'label'         => 'Eyebrow',
					'name'          => 'books_eyebrow',
					'type'          => 'text',
					'default_value' => 'The Books',
				),
				array(
					'key'           => 'field_wh_books_title',
					'label'         => 'Heading',
					'name'          => 'books_title',
					'type'          => 'text',
					'default_value' => 'Fierce women. Brilliant love. Stories with heart.',
				),
				array(
					'key'           => 'field_wh_books_lede',
					'label'         => 'Intro line',
					'name'          => 'books_lede',
					'type'          => 'textarea',
					'rows'          => 2,
					'instructions'  => 'The sentence "…and signed copies are in the shop" stays fixed after this, with its link always working.',
					'default_value' => 'Every book Ali has written, organized by series. Pick a title below to read more',
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'page-books.php',
					),
				),
			),
			'menu_order'     => 0,
			'position'       => 'acf_after_title',
			'style'          => 'default',
			'active'         => true,
			'hide_on_screen' => array( 'the_content' ),
		)
	);

	// ===== The Veiled Prophecy (series) page =====
	acf_add_local_field_group(
		array(
			'key'      => 'group_wh_page_vp',
			'title'    => 'Page copy — The Veiled Prophecy',
			'fields'   => array(
				array(
					'key'           => 'field_wh_vp_cover_image',
					'label'         => 'Cover photo',
					'name'          => 'series_cover_image',
					'type'          => 'image',
					'instructions'  => 'The banner photo at the top of the page.',
					'return_format' => 'array',
					'preview_size'  => 'medium',
				),
				array(
					'key'           => 'field_wh_vp_eyebrow',
					'label'         => 'Hero eyebrow',
					'name'          => 'series_eyebrow',
					'type'          => 'text',
					'default_value' => 'Fantasy series · Kingdom of Sylvaeris',
				),
				array(
					'key'           => 'field_wh_vp_title',
					'label'         => 'Hero heading',
					'name'          => 'series_title',
					'type'          => 'text',
					'default_value' => 'The Veiled Prophecy',
				),
				array(
					'key'           => 'field_wh_vp_lede',
					'label'         => 'Hero tagline',
					'name'          => 'series_lede',
					'type'          => 'textarea',
					'rows'          => 3,
					'default_value' => "She thought she was human. The fae realm knows better — a saga of ancient magic, dangerous love, and a prophecy that won't stay hidden.",
				),
				array(
					'key'           => 'field_wh_vp_about_heading',
					'label'         => 'About the series — heading',
					'name'          => 'about_series_heading',
					'type'          => 'text',
					'default_value' => 'A world of secrets, prophecy, and dangerous love',
				),
				array(
					'key'           => 'field_wh_vp_about_body',
					'label'         => 'About the series — body',
					'name'          => 'about_series_body',
					'type'          => 'wysiwyg',
					'media_upload'  => 0,
					'tabs'          => 'all',
					'default_value' => "<p>Hidden deep beyond the veil, Sylvaeris is a land where ancient magic stirs, and fate weaves tighter than any spell.</p>\n<p>At the heart of this world is Veralyn, a girl who grew up believing she was human—until the truth calls her back.</p>\n<p>Beside her stands Caelum, the guarded prince with the power to read auras and a kingdom to protect.</p>\n<p>Dark secrets rise, the Veilbound Order beckons, and not everyone wants the heir's chosen to survive.</p>\n<p>A tale of fate, forbidden magic, and slow-burn romance awaits. Start free, then follow the saga.</p>",
				),
				array(
					'key'           => 'field_wh_vp_about_image',
					'label'         => 'About the series — image',
					'name'          => 'about_series_image',
					'type'          => 'image',
					'instructions'  => 'The artwork beside the About-the-series text.',
					'return_format' => 'array',
					'preview_size'  => 'medium',
				),
				array(
					'key'     => 'field_wh_vp_msg_reading',
					'type'    => 'message',
					'message' => 'The "Reading order" cards are pulled live from the **Books** menu (filtered to this series, ordered by book number) — add, remove, or edit a book there and it updates here automatically.',
				),
				array(
					'key'     => 'field_wh_vp_msg_news',
					'type'    => 'message',
					'message' => 'The "Join the Hollow" band near the bottom of the page.',
				),
				array(
					'key'           => 'field_wh_vp_news_eyebrow',
					'label'         => 'Newsletter band — eyebrow',
					'name'          => 'news_eyebrow',
					'type'          => 'text',
					'default_value' => 'Join the Hollow',
				),
				array(
					'key'           => 'field_wh_vp_news_heading',
					'label'         => 'Newsletter band — heading',
					'name'          => 'news_heading',
					'type'          => 'text',
					'default_value' => 'Get bonus chapters + first look at new releases',
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'page-the-veiled-prophecy.php',
					),
				),
			),
			'menu_order'     => 0,
			'position'       => 'acf_after_title',
			'style'          => 'default',
			'active'         => true,
			'hide_on_screen' => array( 'the_content' ),
		)
	);

	// ===== Whiskey Tango Foxtrot (series) page =====
	acf_add_local_field_group(
		array(
			'key'      => 'group_wh_page_wtf',
			'title'    => 'Page copy — Whiskey Tango Foxtrot',
			'fields'   => array(
				array(
					'key'           => 'field_wh_wtf_cover_image',
					'label'         => 'Cover photo',
					'name'          => 'series_cover_image',
					'type'          => 'image',
					'instructions'  => 'The banner photo at the top of the page.',
					'return_format' => 'array',
					'preview_size'  => 'medium',
				),
				array(
					'key'           => 'field_wh_wtf_eyebrow',
					'label'         => 'Hero eyebrow',
					'name'          => 'series_eyebrow',
					'type'          => 'text',
					'default_value' => 'Contemporary romance',
				),
				array(
					'key'           => 'field_wh_wtf_title',
					'label'         => 'Hero heading',
					'name'          => 'series_title',
					'type'          => 'text',
					'default_value' => 'Whiskey Tango Foxtrot',
				),
				array(
					'key'           => 'field_wh_wtf_lede',
					'label'         => 'Hero tagline',
					'name'          => 'series_lede',
					'type'          => 'textarea',
					'rows'          => 3,
					'default_value' => 'Fierce, funny, unforgettable — love that hits like a shot and lingers like the good stuff.',
				),
				array(
					'key'           => 'field_wh_wtf_about_heading',
					'label'         => 'About the series — heading',
					'name'          => 'about_series_heading',
					'type'          => 'text',
					'default_value' => "Sharp banter, real heartbreak, women who don't back down",
				),
				array(
					'key'           => 'field_wh_wtf_about_body',
					'label'         => 'About the series — body',
					'name'          => 'about_series_body',
					'type'          => 'wysiwyg',
					'media_upload'  => 0,
					'tabs'          => 'all',
					'default_value' => "<p>Whiskey Tango Foxtrot is contemporary romance with teeth — the kind of story that makes you laugh on one page and reach for a tissue on the next.</p>\n<p>At its center are women who've been knocked down and refuse to stay there, and the men who are smart enough not to underestimate them.</p>\n<p>Every secret has a cost, every drink has a story, and every ending is earned — not handed out.</p>\n<p>Start with Whiskey &amp; Secrets, free forever, then follow the series as it unfolds.</p>",
				),
				array(
					'key'           => 'field_wh_wtf_about_image',
					'label'         => 'About the series — image',
					'name'          => 'about_series_image',
					'type'          => 'image',
					'instructions'  => 'The artwork beside the About-the-series text.',
					'return_format' => 'array',
					'preview_size'  => 'medium',
				),
				array(
					'key'     => 'field_wh_wtf_msg_reading',
					'type'    => 'message',
					'message' => 'The "Reading order" cards are pulled live from the **Books** menu (filtered to this series, ordered by book number) — add, remove, or edit a book there and it updates here automatically.',
				),
				array(
					'key'     => 'field_wh_wtf_msg_news',
					'type'    => 'message',
					'message' => 'The "Join the Hollow" band near the bottom of the page.',
				),
				array(
					'key'           => 'field_wh_wtf_news_eyebrow',
					'label'         => 'Newsletter band — eyebrow',
					'name'          => 'news_eyebrow',
					'type'          => 'text',
					'default_value' => 'Join the Hollow',
				),
				array(
					'key'           => 'field_wh_wtf_news_heading',
					'label'         => 'Newsletter band — heading',
					'name'          => 'news_heading',
					'type'          => 'text',
					'default_value' => 'Get bonus chapters + first look at new releases',
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'page-whiskey-tango-foxtrot.php',
					),
				),
			),
			'menu_order'     => 0,
			'position'       => 'acf_after_title',
			'style'          => 'default',
			'active'         => true,
			'hide_on_screen' => array( 'the_content' ),
		)
	);

	// ===== On the Horizon page =====
	acf_add_local_field_group(
		array(
			'key'      => 'group_wh_page_horizon',
			'title'    => 'Page copy — On the Horizon',
			'fields'   => array(
				array(
					'key'           => 'field_wh_hz_eyebrow',
					'label'         => 'Eyebrow',
					'name'          => 'hz_eyebrow',
					'type'          => 'text',
					'default_value' => 'Coming soon from Ali',
				),
				array(
					'key'           => 'field_wh_hz_title',
					'label'         => 'Heading',
					'name'          => 'hz_title',
					'type'          => 'text',
					'default_value' => 'On the Horizon',
				),
				array(
					'key'           => 'field_wh_hz_lede',
					'label'         => 'Intro line',
					'name'          => 'hz_lede',
					'type'          => 'textarea',
					'rows'          => 3,
					'default_value' => "I'm always working on new stories. This page is where I share upcoming projects, early details, and what I'm currently writing. Information may change as these stories evolve.",
				),
				array(
					'key'     => 'field_wh_hz_msg_news',
					'type'    => 'message',
					'message' => 'The "Join the Hollow" band near the bottom of the page.',
				),
				array(
					'key'           => 'field_wh_hz_news_eyebrow',
					'label'         => 'Newsletter band — eyebrow',
					'name'          => 'news_eyebrow',
					'type'          => 'text',
					'default_value' => 'Join the Hollow',
				),
				array(
					'key'           => 'field_wh_hz_news_heading',
					'label'         => 'Newsletter band — heading',
					'name'          => 'news_heading',
					'type'          => 'text',
					'default_value' => 'Be the first to know when these release',
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'page-on-the-horizon.php',
					),
				),
			),
			'menu_order'     => 0,
			'position'       => 'acf_after_title',
			'style'          => 'default',
			'active'         => true,
			'hide_on_screen' => array( 'the_content' ),
		)
	);

	// ===== About page — portrait (right sidebar) =====
	acf_add_local_field_group(
		array(
			'key'      => 'group_wh_about_photo',
			'title'    => 'Portrait photo',
			'fields'   => array(
				array(
					'key'           => 'field_wh_about_portrait',
					'label'         => 'Portrait',
					'name'          => 'about_portrait',
					'type'          => 'image',
					'instructions'  => 'Your author photo in the pink header. If empty, the theme photo is used.',
					'return_format' => 'array',
					'preview_size'  => 'medium',
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'page-about.php',
					),
				),
			),
			'menu_order'     => 0,
			'position'       => 'side',
			'style'          => 'default',
			'active'         => true,
		)
	);

	// About page's Header/Bio/Facts/Connect/Journey Timeline are NOT an ACF
	// group — they're one custom meta box with a single tab bar (see
	// inc/about-page-editor.php), since ACF's own tabs can't include the
	// Facts/Journey "add row" lists. The Portrait photo field above is the
	// only ACF field left for this page.
}
add_action( 'acf/init', 'wrens_hollow_register_page_fields' );
