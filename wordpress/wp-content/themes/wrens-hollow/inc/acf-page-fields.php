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

	// ===== About page — copy =====
	acf_add_local_field_group(
		array(
			'key'      => 'group_wh_page_about',
			'title'    => 'Page copy — About',
			'fields'   => array(

				// ---- Tab: Header ----
				array(
					'key'       => 'field_wh_ab_tab_hero',
					'label'     => 'Header',
					'type'      => 'tab',
					'placement' => 'top',
				),
				array(
					'key'           => 'field_wh_ab_greeting',
					'label'         => 'Greeting',
					'name'          => 'about_greeting',
					'type'          => 'text',
					'default_value' => 'Welcome!',
				),
				array(
					'key'           => 'field_wh_ab_name',
					'label'         => 'Name heading',
					'name'          => 'about_name',
					'type'          => 'text',
					'default_value' => "I'm Ali Wren",
				),
				array(
					'key'           => 'field_wh_ab_tagline',
					'label'         => 'Tagline',
					'name'          => 'about_tagline',
					'type'          => 'text',
					'default_value' => 'Indie author · Minnesota · romance & fantasy.',
				),

				// ---- Tab: A few things about me ----
				array(
					'key'       => 'field_wh_ab_tab_facts',
					'label'     => 'A few things about me',
					'type'      => 'tab',
					'placement' => 'top',
				),
				array(
					'key'           => 'field_wh_ab_facts_heading',
					'label'         => 'Heading',
					'name'          => 'facts_heading',
					'type'          => 'text',
					'default_value' => 'A few things about me',
				),
				array(
					'key'           => 'field_wh_ab_fact1_icon',
					'label'         => 'Fact 1 — icon',
					'name'          => 'fact_1_icon',
					'type'          => 'text',
					'default_value' => '📍',
				),
				array(
					'key'           => 'field_wh_ab_fact1_text',
					'label'         => 'Fact 1 — text',
					'name'          => 'fact_1_text',
					'type'          => 'text',
					'default_value' => 'Based in Minnesota',
				),
				array(
					'key'           => 'field_wh_ab_fact2_icon',
					'label'         => 'Fact 2 — icon',
					'name'          => 'fact_2_icon',
					'type'          => 'text',
					'default_value' => '✍️',
				),
				array(
					'key'           => 'field_wh_ab_fact2_text',
					'label'         => 'Fact 2 — text',
					'name'          => 'fact_2_text',
					'type'          => 'text',
					'default_value' => 'Two series in progress',
				),
				array(
					'key'           => 'field_wh_ab_fact3_icon',
					'label'         => 'Fact 3 — icon',
					'name'          => 'fact_3_icon',
					'type'          => 'text',
					'default_value' => '☕',
				),
				array(
					'key'           => 'field_wh_ab_fact3_text',
					'label'         => 'Fact 3 — text',
					'name'          => 'fact_3_text',
					'type'          => 'text',
					'default_value' => 'Fueled by coffee',
				),
				array(
					'key'           => 'field_wh_ab_fact4_icon',
					'label'         => 'Fact 4 — icon',
					'name'          => 'fact_4_icon',
					'type'          => 'text',
					'default_value' => '💌',
				),
				array(
					'key'           => 'field_wh_ab_fact4_text',
					'label'         => 'Fact 4 — text',
					'name'          => 'fact_4_text',
					'type'          => 'text',
					'default_value' => 'Loves hearing from readers',
				),

				// ---- Tab: Bio ----
				array(
					'key'       => 'field_wh_ab_tab_bio',
					'label'     => 'Bio',
					'type'      => 'tab',
					'placement' => 'top',
				),
				array(
					'key'           => 'field_wh_ab_bio_intro',
					'label'         => 'Intro paragraphs',
					'name'          => 'bio_intro',
					'type'          => 'wysiwyg',
					'media_upload'  => 0,
					'tabs'          => 'all',
					'default_value' => "<p>I write romance and fantasy filled with emotion, danger, and unforgettable connections.</p>\n<p>My stories are inspired by real-world experiences, human behavior, and the idea that love can be both powerful and complicated.</p>",
				),
				array(
					'key'           => 'field_wh_ab_bio_pullquote',
					'label'         => 'Pull quote',
					'name'          => 'bio_pullquote',
					'type'          => 'textarea',
					'rows'          => 4,
					'default_value' => "Author, biological anthropologist, and proud mom. I write romantic adventures that blend science, suspense, and heart. Stories where love is hard-won and nothing is ever as simple as it seems. You'll find strong heroines (often scientists), fiercely loyal heroes, and characters shaped by resilience, survival, and the choices that define them.",
				),
				array(
					'key'           => 'field_wh_ab_bio_more',
					'label'         => 'Remaining paragraphs',
					'name'          => 'bio_more',
					'type'          => 'wysiwyg',
					'media_upload'  => 0,
					'tabs'          => 'all',
					'default_value' => "<p>My writing is deeply influenced by my background in anthropology and my fascination with human behavior, why we love the way we do, what drives us, and what we're willing to risk for the people who matter most. Many of my stories are inspired by real-world experiences, from travel and culture to the emotional complexities we carry with us.</p>\n<p>Some of my earliest inspiration came from a trip to Brazil, where I fell in love with the landscape, the energy, and the depth of human connection I witnessed there. That experience, combined with my son's interest in the military and my own love of science, helped shape the stories I tell today—where emotion, danger, and discovery all collide.</p>\n<p>When I'm not writing, I'm answering phones at our family plumbing business, running a support brand for families affected by alopecia, or chasing my kids around, usually with a coffee (or water) in hand. Motherhood continues to be one of my biggest inspirations, reminding me daily what strength, love, and resilience truly look like.</p>\n<p>Welcome to my corner of the internet—where love is fierce, women are brilliant, and there's always more to the story.</p>",
				),

				// ---- Tab: Journey (timeline) ----
				array(
					'key'       => 'field_wh_ab_tab_journey',
					'label'     => 'Journey timeline',
					'type'      => 'tab',
					'placement' => 'top',
				),
				array(
					'key'           => 'field_wh_ab_journey_eyebrow',
					'label'         => 'Eyebrow',
					'name'          => 'journey_eyebrow',
					'type'          => 'text',
					'default_value' => 'My Journey',
				),
				array(
					'key'           => 'field_wh_ab_journey_heading',
					'label'         => 'Heading',
					'name'          => 'journey_heading',
					'type'          => 'text',
					'default_value' => 'The Road So Far',
				),
				array(
					'key'           => 'field_wh_ab_tl1_date',
					'label'         => 'Milestone 1 — date',
					'name'          => 'tl_1_date',
					'type'          => 'text',
					'default_value' => 'May 2024',
				),
				array(
					'key'           => 'field_wh_ab_tl1_body',
					'label'         => 'Milestone 1 — text',
					'name'          => 'tl_1_body',
					'type'          => 'wysiwyg',
					'media_upload'  => 0,
					'tabs'          => 'all',
					'default_value' => '<p>Started writing <strong>Whiskey &amp; Secrets</strong>, the first book in the Whiskey Tango Foxtrot series—a romance filled with science, suspense, and a fiercely protective Green Beret.</p>',
				),
				array(
					'key'           => 'field_wh_ab_tl2_date',
					'label'         => 'Milestone 2 — date',
					'name'          => 'tl_2_date',
					'type'          => 'text',
					'default_value' => 'June 2025',
				),
				array(
					'key'           => 'field_wh_ab_tl2_body',
					'label'         => 'Milestone 2 — text',
					'name'          => 'tl_2_body',
					'type'          => 'wysiwyg',
					'media_upload'  => 0,
					'tabs'          => 'all',
					'default_value' => '<p>Official launch of <strong>Whiskey &amp; Secrets</strong>! The beginning of a series that pairs strong women (often scientists) with the men brave enough to fight beside them.</p>',
				),
				array(
					'key'           => 'field_wh_ab_tl3_date',
					'label'         => 'Milestone 3 — date',
					'name'          => 'tl_3_date',
					'type'          => 'text',
					'default_value' => 'November 2025',
				),
				array(
					'key'           => 'field_wh_ab_tl3_body',
					'label'         => 'Milestone 3 — text',
					'name'          => 'tl_3_body',
					'type'          => 'wysiwyg',
					'media_upload'  => 0,
					'tabs'          => 'all',
					'default_value' => '<p>Launched <strong>Veilfall</strong>! The start of the Veiled Prophecy series.</p>',
				),
				array(
					'key'           => 'field_wh_ab_tl4_date',
					'label'         => 'Milestone 4 — date',
					'name'          => 'tl_4_date',
					'type'          => 'text',
					'default_value' => '2026',
				),
				array(
					'key'           => 'field_wh_ab_tl4_body',
					'label'         => 'Milestone 4 — text',
					'name'          => 'tl_4_body',
					'type'          => 'wysiwyg',
					'media_upload'  => 0,
					'tabs'          => 'all',
					'default_value' => "<p>Currently writing <strong>Whiskey &amp; Lies</strong>, book two in the series—featuring Fallon, a guarded survivor with a fiery spirit, and Jake, the team's communications expert with secrets of his own. Also writing <strong>Veilbound</strong>, book two in the Veiled Prophecy series.</p>\n<p>I took a break from both to start the Northfall Syndicate series. A suspense stalker book centered in Cambridge, MN. This one is very near and dear to my heart and to all those fighting with past traumas.</p>",
				),

				// ---- Tab: Connect ----
				array(
					'key'       => 'field_wh_ab_tab_connect',
					'label'     => 'Connect section',
					'type'      => 'tab',
					'placement' => 'top',
				),
				array(
					'key'           => 'field_wh_ab_connect_eyebrow',
					'label'         => 'Newsletter — eyebrow',
					'name'          => 'connect_eyebrow',
					'type'          => 'text',
					'default_value' => 'Join the Hollow',
				),
				array(
					'key'           => 'field_wh_ab_connect_heading',
					'label'         => 'Newsletter — heading',
					'name'          => 'connect_heading',
					'type'          => 'text',
					'default_value' => "Let's Stay Connected",
				),
				array(
					'key'           => 'field_wh_ab_connect_body',
					'label'         => 'Newsletter — text',
					'name'          => 'connect_body',
					'type'          => 'textarea',
					'rows'          => 3,
					'default_value' => 'Love strong heroines, slow-burn romance, and a little bit of danger? Sign up for my newsletter and get bonus chapters plus first look at new releases, behind-the-scenes peeks, character deep-dives, and updates straight to your inbox.',
				),
				array(
					'key'           => 'field_wh_ab_hello_eyebrow',
					'label'         => 'Contact — eyebrow',
					'name'          => 'hello_eyebrow',
					'type'          => 'text',
					'default_value' => 'Say hello',
				),
				array(
					'key'           => 'field_wh_ab_hello_heading',
					'label'         => 'Contact — heading',
					'name'          => 'hello_heading',
					'type'          => 'text',
					'default_value' => "I'd Love to Hear from You!",
				),
				array(
					'key'           => 'field_wh_ab_hello_body',
					'label'         => 'Contact — text',
					'name'          => 'hello_body',
					'type'          => 'textarea',
					'rows'          => 3,
					'default_value' => "Whether you're a fellow reader, a book club, a blogger, or just curious about my writing—drop a note below!",
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
			'position'       => 'acf_after_title',
			'style'          => 'default',
			'active'         => true,
			'hide_on_screen' => array( 'the_content' ),
		)
	);
}
add_action( 'acf/init', 'wrens_hollow_register_page_fields' );
