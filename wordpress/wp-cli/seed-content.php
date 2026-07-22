<?php
/**
 * One-time content seeder, run via `wp eval-file` from init.sh after the ACF and
 * Custom Post Type UI plugins are active. It pre-fills the site's editable
 * content (currently: Events) with the copy that used to be hardcoded in the
 * templates, so the owner edits her existing words instead of starting blank.
 *
 * Idempotent: each section is skipped when its content already exists, so it
 * never overwrites edits the owner makes later. Re-running on `docker compose up`
 * is safe.
 */

if ( ! function_exists( 'update_field' ) ) {
	if ( class_exists( 'WP_CLI' ) ) {
		WP_CLI::warning( '[seed] ACF not active — skipping content seed.' );
	}
	return;
}

/** Seed Events once, tracked by an option flag so manual events don't block it
 * and it never double-seeds on subsequent boots. */
if ( ! get_option( 'wh_seeded_events' ) ) {
	$events = array(
		array(
			'title'    => "The Summer's Best Book Fair for Grown Ups",
			'date'     => '20260711',
			'details'  => '📍 The Grandstand, Falcon Heights, MN · July 11, 2026 · 11am–7pm',
			'url'      => 'https://facebook.com/events/s/the-summers-best-book-fair-for/1640890470424298',
			'upcoming' => false,
		),
		array(
			'title'    => 'Booked It! At the Brewery',
			'date'     => '20260628',
			'details'  => '📍 Sunken Ship Brewery Company, Princeton, MN · June 28, 2026 · 11am–4pm',
			'url'      => 'https://facebook.com/events/s/booked-it-at-the-brewery/861609956787546/',
			'upcoming' => false,
		),
		array(
			'title'    => 'Whiskey & Lies Book Launch',
			'date'     => '20260531',
			'details'  => "📍 Dana's Bookstore, Isanti, MN · May 31, 2026 · 11am–2pm",
			'url'      => 'https://facebook.com/events/s/whiskey-lies-book-launch-event/1674830936855932/',
			'upcoming' => false,
		),
		array(
			'title'    => 'New Moons Bookstore Grand Opening',
			'date'     => '20260530',
			'details'  => '📍 New Moons Bookstore, Forest Lake, MN · May 30, 2026 · 1pm–4pm',
			'url'      => 'https://facebook.com/events/s/new-moons-bookshop-two-day-gra/1686221752731399/',
			'upcoming' => false,
		),
		array(
			'title'    => 'Book Fair @ The Bee',
			'date'     => '20260425',
			'details'  => '📍 The Bee Caffe, Milaca, MN · April 25, 2026 · 10am–2pm',
			'url'      => 'https://facebook.com/events/s/book-fair-the-bee-425/3187285531578869',
			'upcoming' => false,
		),
		array(
			'title'    => 'Booked It! At the Brewery',
			'date'     => '20260305',
			'details'  => '📍 Sunken Ship Brewery Company, Princeton, MN · March 5, 2026 · 4pm–8pm',
			'url'      => 'https://facebook.com/events/s/booked-it-at-the-brewery/1254943413157183/',
			'upcoming' => false,
		),
		array(
			'title'    => 'Love Local Authors',
			'date'     => '20260214',
			'details'  => '📍 Enchanted Quill, North Branch, MN · February 14, 2026 · 11am–2pm',
			'url'      => 'https://facebook.com/events/s/love-local-authors-event/1180611124260845/',
			'upcoming' => false,
		),
		array(
			'title'    => 'Veilfall Debut Book Signing – Meet Ali Wren',
			'date'     => '20251116',
			'details'  => "📍 Dana's Bookstore, Isanti, MN · November 16, 2025 · 12pm–3pm",
			'url'      => '',
			'upcoming' => false,
		),
	);

	$count = 0;
	foreach ( $events as $ev ) {
		$post_id = wp_insert_post(
			array(
				'post_type'   => 'wh_event',
				'post_title'  => $ev['title'],
				'post_status' => 'publish',
			)
		);
		if ( $post_id && ! is_wp_error( $post_id ) ) {
			update_field( 'event_date', $ev['date'], $post_id );
			update_field( 'event_details', $ev['details'], $post_id );
			update_field( 'event_url', $ev['url'], $post_id );
			update_field( 'is_upcoming', $ev['upcoming'] ? 1 : 0, $post_id );
			$count++;
		}
	}

	update_option( 'wh_seeded_events', 1 );

	if ( class_exists( 'WP_CLI' ) ) {
		WP_CLI::log( "[seed] Created {$count} events." );
	}
} elseif ( class_exists( 'WP_CLI' ) ) {
	WP_CLI::log( '[seed] Events already seeded — skipping.' );
}

/** Seed Reviews once. Quote = post title, source = review_source field. */
if ( ! get_option( 'wh_seeded_reviews' ) ) {
	$reviews = array(
		array( 'quote' => "Couldn't put it down — the tension is unreal.", 'source' => 'Goodreads' ),
		array( 'quote' => 'Fierce women and swoony romance. More please!', 'source' => 'Amazon' ),
		array( 'quote' => "Veilfall is the fae fantasy I didn't know I needed. That ending!", 'source' => 'NetGalley' ),
		array( 'quote' => 'Whiskey Tango Foxtrot had me laughing one page and crying the next.', 'source' => 'BookBub' ),
		array( 'quote' => "Ali Wren writes heroines who don't wait to be saved.", 'source' => '@reads.with.casey, TikTok' ),
		array( 'quote' => 'Whiskey & Secrets had the perfect amount of banter and heartbreak.', 'source' => 'Instagram' ),
	);

	$rcount = 0;
	foreach ( $reviews as $i => $rv ) {
		$post_id = wp_insert_post(
			array(
				'post_type'   => 'wh_review',
				'post_title'  => $rv['quote'],
				'post_status' => 'publish',
				'menu_order'  => $i,
			)
		);
		if ( $post_id && ! is_wp_error( $post_id ) ) {
			update_field( 'review_source', $rv['source'], $post_id );
			$rcount++;
		}
	}

	update_option( 'wh_seeded_reviews', 1 );

	if ( class_exists( 'WP_CLI' ) ) {
		WP_CLI::log( "[seed] Created {$rcount} reviews." );
	}
} elseif ( class_exists( 'WP_CLI' ) ) {
	WP_CLI::log( '[seed] Reviews already seeded — skipping.' );
}

/** Seed Books once (library grid + detail-page copy). */
if ( ! get_option( 'wh_seeded_books' ) ) {
	$books = array(
		array(
			'title'      => 'Veilfall',
			'key'        => 'veilfall',
			'series'     => 'veiled-prophecy',
			'number'     => 1,
			'grid_tag'   => 'Book 1 · Free',
			'grid_blurb' => "She thought she was human. The fae realm knows better. Start Veralyn's story with this dark fae fantasy romance.",
			'hero_tag'   => 'Book 1 · Available now',
			'hero_lede'  => 'Step into the Kingdom of Sylvaeris.',
			'hero_blurb' => "She was hidden in the human realm to stay safe. But magic has a way of finding what was never meant to be forgotten. Start Veralyn's story with this dark fae fantasy romance.",
			'about'      => <<<'HTML'
<p>She was hidden in the human realm to stay safe. But magic has a way of finding what was never meant to be forgotten.</p>
<p>Veralyn spent her whole life believing she was ordinary, until the night everything changed. When her parents are killed, the truth shatters through her carefully built world: she's not human. She's fae. And not just any fae, she's bound to a prophecy that could alter the future of the entire realm. Forced to return to Sylvaeris she attends Auravale Academy.</p>
<p>Auravale Academy is a school for the elite and powerful. Vera must confront a world she was never meant to leave… and powers she doesn't yet understand.</p>
<p>Caelum Thornevale, Prince of the realm and heir to the throne, is used to having control. But when he crosses paths with Vera everything changes.</p>
<p>As her magic awakens, so do old enemies and forgotten secrets. In a kingdom on the brink of war, fate is not a choice.</p>
<p><em>But love might be.</em></p>
<p><a href="/shop/#veilfall">Find the Paperback available here!</a></p>
<p>The Ebook is available on Kindle Unlimited!</p>
HTML,
		),
		array(
			'title'      => 'Veilbound',
			'key'        => 'veilbound',
			'series'     => 'veiled-prophecy',
			'number'     => 2,
			'grid_tag'   => 'Book 2 · Coming soon',
			'grid_blurb' => 'The next chapter in the Kingdom of Sylvaeris saga — the fate of the kingdom, and her heart, hangs in the balance.',
			'hero_tag'   => 'Book 2 · Coming soon',
			'hero_lede'  => 'The fate of the kingdom — and her heart — hangs in the balance.',
			'hero_blurb' => 'The next chapter in the Kingdom of Sylvaeris saga, picking up where Veilfall leaves off.',
			'about'      => <<<'HTML'
<p>In Veilfall, Veralyn's world shattered when her parents were murdered and she was forced to return to the fae realm she never knew was hers. Hidden in the human world to protect her from a prophecy foretelling her death, Vera was thrust into Auravale Academy and the dangerous ranks of the Veilbound Order — where enemies watch from the shadows.</p>
<p>In Veilbound, Vera's magic fully awakens during the Veilfall Festival, revealing gifts tied not only to the fae realm, but to the first Fae Queen herself. As her power deepens, so do the mysteries surrounding her fate, including unexpected connections to a vampire and a wolf shifter she was never meant to meet.</p>
<p>Caelum Thornevale, Prince of Sylvaeris and heir to all the fae lands, refuses to let Vera face her destiny alone. Bound by a fated mate bond that Vera continues to resist, Caelum fights to protect her—even as she pushes him away to shield him from a future where she may not survive.</p>
<p>With love that could destroy her and a prophecy counting down her remaining time, Vera must decide whether protecting her heart is worth losing everything else.</p>
<p><em>Veilbound is a romantic fae fantasy filled with prophecy, ancient magic, fated mates, and a love that refuses to be denied.</em></p>
<p><strong>Coming Fall 2026!</strong></p>
HTML,
		),
		array(
			'title'      => 'Whiskey & Secrets',
			'key'        => 'whiskey-and-secrets',
			'series'     => 'whiskey-tango-foxtrot',
			'number'     => 1,
			'grid_tag'   => 'Book 1 · Available now',
			'grid_blurb' => "Some secrets are worth the hangover. Fierce, funny, unforgettable contemporary romance — sharp banter, real heartbreak, and a heroine who doesn't back down.",
			'hero_tag'   => 'Book 1 · Available now',
			'hero_lede'  => 'Some secrets are worth the hangover.',
			'hero_blurb' => "Fierce, funny, unforgettable contemporary romance — sharp banter, real heartbreak, and a heroine who doesn't back down. Whiskey & Secrets kicks off the Whiskey Tango Foxtrot series with the kind of love that hits like a shot and lingers like the good stuff.",
			'about'      => <<<'HTML'
<p>When biological anthropology grad student Sarah agrees to lead a research expedition in the Amazon Rainforest, she never expected to need military protection — let alone from Wade "Wraith" Blakely, the stoic, enigmatic former Green Beret who's been assigned to keep her team safe.</p>
<p>Wade is used to dangerous missions, but babysitting scientists wasn't what he signed up for. Until one of them goes missing, and secrets buried deep in the jungle — and in Sarah's past — begin to surface. As the threat around them escalates, so does the undeniable pull between Sarah and Wade. But trusting each other might be their only way out alive.</p>
<p><a href="/shop/#whiskey-and-secrets">Find the paperback available here →</a></p>
<p>The ebook will be available on Kindle Unlimited!</p>
<p><em>Readers are loving Whiskey &amp; Secrets! With an average rating of 4.5 stars on Goodreads, fans are praising its mix of adventure, romance, and suspense.</em></p>
HTML,
		),
		array(
			'title'      => 'Whiskey & Lies',
			'key'        => 'whiskey-and-lies',
			'series'     => 'whiskey-tango-foxtrot',
			'number'     => 2,
			'grid_tag'   => 'Book 2 · Available now',
			'grid_blurb' => 'Every relationship has a few secrets. Hers might be unforgivable. Includes bonus chapters for readers who finish the book.',
			'hero_tag'   => 'Book 2 · Available now',
			'hero_lede'  => 'Every relationship has a few secrets. Hers might be unforgivable.',
			'hero_blurb' => "The Whiskey Tango Foxtrot series continues — more sharp banter, more real heartbreak, and a heroine who still won't back down. Whiskey & Lies includes bonus chapters for readers who finish the book.",
			'about'      => <<<'HTML'
<p>Jake 'Glitch' Thompson came home from the military with more scars than he admits—some you can see, and some you can't. Drifting between ghosts of old missions, his old life and a future he's not sure he deserves, the only thing keeping him grounded is the woman who stole his heart.</p>
<p>Fallon Moore has always been the steady one—sharp, loyal, and burning with a quiet strength that's carried her through hell. She swore she'd never let love make her weak, but Jake seems to be her exception. And when Jake does something to chase her away, the pull between them is impossible to ignore.</p>
<p>But their second chance doesn't come easy. Shadows from Fallon's past and the people who want to exploit them, close in fast. Jake isn't just fighting for the man he loves; he's fighting for the life they could have together.</p>
<p>With bullets flying and secrets unraveling, Jake will have to decide if he can fight through her ghosts… and will risk everything to prove that home isn't a place. It's the person you'd burn the world for.</p>
<p><em>A gripping romance of loyalty, danger, and the kind of love that survives the wreckage.</em></p>
<p><a href="/shop/#whiskey-and-lies">Find the paperback available here →</a></p>
<p><strong>Available: May 28, 2026</strong></p>
<p>The Ebook will be available on Kindle Unlimited!</p>
HTML,
		),
	);

	$bcount = 0;
	foreach ( $books as $bk ) {
		$post_id = wp_insert_post(
			array(
				'post_type'   => 'wh_book',
				'post_title'  => $bk['title'],
				'post_status' => 'publish',
				'menu_order'  => $bk['number'],
			)
		);
		if ( $post_id && ! is_wp_error( $post_id ) ) {
			update_field( 'book_key', $bk['key'], $post_id );
			update_field( 'series', $bk['series'], $post_id );
			update_field( 'book_number', $bk['number'], $post_id );
			update_field( 'grid_tag', $bk['grid_tag'], $post_id );
			update_field( 'grid_blurb', $bk['grid_blurb'], $post_id );
			update_field( 'hero_tag', $bk['hero_tag'], $post_id );
			update_field( 'hero_lede', $bk['hero_lede'], $post_id );
			update_field( 'hero_blurb', $bk['hero_blurb'], $post_id );
			update_field( 'about_body', $bk['about'], $post_id );
			$bcount++;
		}
	}

	update_option( 'wh_seeded_books', 1 );

	if ( class_exists( 'WP_CLI' ) ) {
		WP_CLI::log( "[seed] Created {$bcount} books." );
	}
} elseif ( class_exists( 'WP_CLI' ) ) {
	WP_CLI::log( '[seed] Books already seeded — skipping.' );
}

/** Back-fill "Released?" + product SKU on the 4 existing books once, so the
 * series-page "Reading order" buttons work correctly now that it's pulled
 * live from the Books menu instead of separately-edited page fields. Runs
 * once regardless of when the books above were created. */
if ( ! get_option( 'wh_seeded_book_release_info' ) && function_exists( 'wh_book' ) ) {
	$release_info = array(
		'veilfall'            => array( 'released' => 1, 'sku' => 'veilfall-paperback' ),
		'veilbound'           => array( 'released' => 0, 'sku' => '' ),
		'whiskey-and-secrets' => array( 'released' => 1, 'sku' => 'whiskey-and-secrets-signed' ),
		'whiskey-and-lies'    => array( 'released' => 1, 'sku' => 'whiskey-and-lies-signed' ),
	);
	foreach ( $release_info as $key => $info ) {
		$book = wh_book( $key );
		if ( ! $book ) {
			continue;
		}
		update_field( 'is_released', $info['released'], $book->ID );
		update_field( 'product_sku', $info['sku'], $book->ID );
	}
	update_option( 'wh_seeded_book_release_info', 1 );
	if ( class_exists( 'WP_CLI' ) ) {
		WP_CLI::log( '[seed] Back-filled release info on existing books.' );
	}
} elseif ( class_exists( 'WP_CLI' ) ) {
	WP_CLI::log( '[seed] Book release info already seeded — skipping.' );
}

/** Seed the per-book reviews once (assigned to a book via review_book). */
if ( ! get_option( 'wh_seeded_book_reviews' ) && function_exists( 'wh_book' ) ) {
	$book_reviews = array(
		'veilfall'            => array(
			array( 'quote' => 'The world-building is gorgeous.', 'source' => 'Reader review' ),
			array( 'quote' => 'Give me book one already!', 'source' => 'Reader review' ),
		),
		'whiskey-and-secrets' => array(
			array( 'quote' => 'Sharp, funny, and it wrecked me in the best way.', 'source' => 'Reader review' ),
			array( 'quote' => 'I need Book 3 immediately.', 'source' => 'Reader review' ),
		),
	);

	$brcount = 0;
	foreach ( $book_reviews as $book_key => $revs ) {
		$book = wh_book( $book_key );
		if ( ! $book ) {
			continue;
		}
		foreach ( $revs as $i => $rv ) {
			$post_id = wp_insert_post(
				array(
					'post_type'   => 'wh_review',
					'post_title'  => $rv['quote'],
					'post_status' => 'publish',
					'menu_order'  => $i,
				)
			);
			if ( $post_id && ! is_wp_error( $post_id ) ) {
				update_field( 'review_source', $rv['source'], $post_id );
				update_field( 'review_book', $book->ID, $post_id );
				$brcount++;
			}
		}
	}

	update_option( 'wh_seeded_book_reviews', 1 );

	if ( class_exists( 'WP_CLI' ) ) {
		WP_CLI::log( "[seed] Created {$brcount} book reviews." );
	}
} elseif ( class_exists( 'WP_CLI' ) ) {
	WP_CLI::log( '[seed] Book reviews already seeded — skipping.' );
}

/** Back-fill rating + placement on reviews created before those fields existed,
 * so the editor shows the correct selection for each. Runs once. */
if ( ! get_option( 'wh_migrated_review_meta' ) ) {
	$all_reviews = get_posts(
		array(
			'post_type'   => 'wh_review',
			'post_status' => 'any',
			'numberposts' => -1,
			'fields'      => 'ids',
		)
	);
	foreach ( $all_reviews as $rid ) {
		if ( '' === (string) get_post_meta( $rid, 'review_rating', true ) ) {
			update_field( 'review_rating', '5', $rid );
		}
		if ( '' === (string) get_post_meta( $rid, 'review_placement', true ) ) {
			$placement = get_post_meta( $rid, 'review_book', true ) ? 'book' : 'homepage';
			update_field( 'review_placement', $placement, $rid );
		}
	}
	update_option( 'wh_migrated_review_meta', 1 );
	if ( class_exists( 'WP_CLI' ) ) {
		WP_CLI::log( '[seed] Back-filled rating/placement on existing reviews.' );
	}
}

/** Seed the two series-page review carousels once (placement = series). */
if ( ! get_option( 'wh_seeded_series_reviews' ) ) {
	$series_reviews = array(
		'veiled-prophecy'       => array(
			array( 'quote' => "Veilfall is the fae fantasy I didn't know I needed. That ending!", 'source' => 'NetGalley' ),
			array( 'quote' => 'The world-building is gorgeous — Sylvaeris feels like a real place.', 'source' => 'Goodreads' ),
			array( 'quote' => "Veralyn and Caelum's slow burn wrecked me. Give me book two already!", 'source' => '@reads.with.casey, TikTok' ),
			array( 'quote' => 'Dark fae romance done right. I devoured this in one sitting.', 'source' => 'Amazon' ),
			array( 'quote' => 'The prophecy twist had me gasping out loud. Sylvaeris lives rent-free in my head.', 'source' => 'BookBub' ),
			array( 'quote' => 'Fierce heroine, dangerous magic, and a romance that earns every slow burn.', 'source' => 'Instagram' ),
		),
		'whiskey-tango-foxtrot' => array(
			array( 'quote' => 'Sharp, funny, and it wrecked me in the best way.', 'source' => 'Goodreads' ),
			array( 'quote' => 'Whiskey Tango Foxtrot had me laughing one page and crying the next.', 'source' => 'BookBub' ),
			array( 'quote' => 'Whiskey & Secrets had the perfect amount of banter and heartbreak.', 'source' => 'Instagram' ),
			array( 'quote' => 'I need Book 3 immediately. These women do not back down.', 'source' => 'Amazon' ),
			array( 'quote' => 'The bonus chapters in Whiskey & Lies destroyed me. In a good way.', 'source' => 'NetGalley' ),
			array( 'quote' => "Ali Wren writes heroines who don't wait to be saved.", 'source' => '@reads.with.casey, TikTok' ),
		),
	);

	$srcount = 0;
	foreach ( $series_reviews as $series_slug => $revs ) {
		foreach ( $revs as $i => $rv ) {
			$post_id = wp_insert_post(
				array(
					'post_type'   => 'wh_review',
					'post_title'  => $rv['quote'],
					'post_status' => 'publish',
					'menu_order'  => $i,
				)
			);
			if ( $post_id && ! is_wp_error( $post_id ) ) {
				update_field( 'review_source', $rv['source'], $post_id );
				update_field( 'review_rating', '5', $post_id );
				update_field( 'review_placement', 'series', $post_id );
				update_field( 'review_series', $series_slug, $post_id );
				$srcount++;
			}
		}
	}

	update_option( 'wh_seeded_series_reviews', 1 );

	if ( class_exists( 'WP_CLI' ) ) {
		WP_CLI::log( "[seed] Created {$srcount} series reviews." );
	}
} elseif ( class_exists( 'WP_CLI' ) ) {
	WP_CLI::log( '[seed] Series reviews already seeded — skipping.' );
}

/** Import the existing theme cover files into the Media Library and set them as
 * each book's Featured Image ("Book cover"), so that box isn't empty. Once. */
if ( ! get_option( 'wh_seeded_book_covers' ) && function_exists( 'wh_book' ) ) {
	require_once ABSPATH . 'wp-admin/includes/image.php';
	$cover_keys = array( 'veilfall', 'whiskey-and-secrets', 'whiskey-and-lies' );
	$ccount     = 0;
	foreach ( $cover_keys as $key ) {
		$book = wh_book( $key );
		if ( ! $book || has_post_thumbnail( $book->ID ) ) {
			continue;
		}
		$file = get_template_directory() . '/images/covers/' . $key . '.jpg';
		if ( ! file_exists( $file ) ) {
			continue;
		}
		$upload = wp_upload_bits( $key . '.jpg', null, file_get_contents( $file ) );
		if ( ! empty( $upload['error'] ) ) {
			continue;
		}
		$attach_id = wp_insert_attachment(
			array(
				'post_mime_type' => $upload['type'],
				'post_title'     => get_the_title( $book ) . ' cover',
				'post_status'    => 'inherit',
			),
			$upload['file'],
			$book->ID
		);
		if ( ! $attach_id || is_wp_error( $attach_id ) ) {
			continue;
		}
		wp_update_attachment_metadata( $attach_id, wp_generate_attachment_metadata( $attach_id, $upload['file'] ) );
		set_post_thumbnail( $book->ID, $attach_id );
		$ccount++;
	}
	update_option( 'wh_seeded_book_covers', 1 );
	if ( class_exists( 'WP_CLI' ) ) {
		WP_CLI::log( "[seed] Attached {$ccount} book covers." );
	}
} elseif ( class_exists( 'WP_CLI' ) ) {
	WP_CLI::log( '[seed] Book covers already attached — skipping.' );
}

/** Seed the About page's Journey timeline + Facts once, directly as page
 * postmeta (see inc/inline-repeaters.php) — these are inline "add row" lists
 * on the About page itself, not a separate CPT, since they're only ever shown
 * there. */
if ( ! get_option( 'wh_seeded_about_repeaters' ) ) {
	$about_page = get_page_by_path( 'about' );
	if ( $about_page ) {
		$milestones = array(
			array(
				'date' => 'May 2024',
				'body' => '<p>Started writing <strong>Whiskey &amp; Secrets</strong>, the first book in the Whiskey Tango Foxtrot series—a romance filled with science, suspense, and a fiercely protective Green Beret.</p>',
			),
			array(
				'date' => 'June 2025',
				'body' => '<p>Official launch of <strong>Whiskey &amp; Secrets</strong>! The beginning of a series that pairs strong women (often scientists) with the men brave enough to fight beside them.</p>',
			),
			array(
				'date' => 'November 2025',
				'body' => '<p>Launched <strong>Veilfall</strong>! The start of the Veiled Prophecy series.</p>',
			),
			array(
				'date' => '2026',
				'body' => "<p>Currently writing <strong>Whiskey &amp; Lies</strong>, book two in the series—featuring Fallon, a guarded survivor with a fiery spirit, and Jake, the team's communications expert with secrets of his own. Also writing <strong>Veilbound</strong>, book two in the Veiled Prophecy series.</p>\n<p>I took a break from both to start the Northfall Syndicate series. A suspense stalker book centered in Cambridge, MN. This one is very near and dear to my heart and to all those fighting with past traumas.</p>",
			),
		);
		update_post_meta( $about_page->ID, 'about_milestones', $milestones );

		$facts = array(
			array( 'icon' => '📍', 'text' => 'Based in Minnesota' ),
			array( 'icon' => '✍️', 'text' => 'Two series in progress' ),
			array( 'icon' => '☕', 'text' => 'Fueled by coffee' ),
			array( 'icon' => '💌', 'text' => 'Loves hearing from readers' ),
		);
		update_post_meta( $about_page->ID, 'about_facts', $facts );
	}

	update_option( 'wh_seeded_about_repeaters', 1 );
	if ( class_exists( 'WP_CLI' ) ) {
		WP_CLI::log( '[seed] Seeded About page Journey timeline + Facts.' );
	}
} elseif ( class_exists( 'WP_CLI' ) ) {
	WP_CLI::log( '[seed] About page repeaters already seeded — skipping.' );
}

/** Seed the On-the-Horizon projects once. */
if ( ! get_option( 'wh_seeded_projects' ) ) {
	$projects = array(
		array(
			'title'    => 'Whiskey & Lies',
			'status'   => 'now-available',
			'subtitle' => 'Book 2 · Whiskey Tango Foxtrot · Military Romantic Suspense',
			'label'    => 'Read more →',
			'url'      => home_url( '/whiskey-and-lies/' ),
			'body'     => <<<'HTML'
<p>In Whiskey &amp; Secrets, readers fell in love with Sergeant Wade "Wraith" Blakely and Sarah amid danger in the Amazon rainforest.</p>
<p>Whiskey &amp; Lies continues the story by introducing Fallon, Sarah's best friend and roommate, and Jake "Glitch" Thompson, the communications expert from Green Beret team Whiskey Tango Foxtrot.</p>
<p>When Fallon and Jake meet, the connection is instant — but Jake is still haunted by the fiancée who left him behind, and Fallon carries a past she's tried desperately to escape. As old threats resurface and Fallon's past begins to close in, Jake must decide whether he's willing to let go of what broke him… in time to save the woman who might change everything.</p>
<p><em>Whiskey &amp; Lies is a high-stakes military romance about trust, second chances, and choosing the future over the ghosts of the past.</em></p>
HTML,
		),
		array(
			'title'    => 'Veilbound',
			'status'   => 'in-progress',
			'subtitle' => 'Book 2 · The Veiled Prophecy · Fae Fantasy Romance',
			'label'    => 'Learn more →',
			'url'      => home_url( '/veilbound/' ),
			'body'     => <<<'HTML'
<p>In Veilfall, Veralyn's world shattered when her parents were murdered and she was forced to return to the fae realm she never knew was hers. Hidden in the human world to protect her from a prophecy foretelling her death, Vera was thrust into Auravale Academy and the dangerous ranks of the Veilbound Order — where enemies watch from the shadows.</p>
<p>In Veilbound, Vera's magic fully awakens during the Veilfall Festival, revealing gifts tied not only to the fae realm, but to the first Fae Queen herself. As her power deepens, so do the mysteries surrounding her fate, including unexpected connections to a vampire and a wolf shifter she was never meant to meet.</p>
<p>Caelum Thornevale, Prince of Sylvaeris and heir to all the fae lands, refuses to let Vera face her destiny alone. Bound by a fated mate bond that Vera continues to resist, Caelum fights to protect her—even as she pushes him away to shield him from a future where she may not survive.</p>
<p>With love that could destroy her and a prophecy counting down her remaining time, Vera must decide whether protecting her heart is worth losing everything else.</p>
<p><em>Veilbound is a romantic fae fantasy filled with prophecy, ancient magic, fated mates, and a love that refuses to be denied.</em></p>
HTML,
		),
		array(
			'title'    => 'His Northern Fixation',
			'status'   => 'in-progress',
			'subtitle' => 'Standalone · Northfall Syndicate · Romantic Suspense / Thriller',
			'label'    => '',
			'url'      => '',
			'body'     => <<<'HTML'
<p><strong>Standalone Novel in the Northfall Syndicate Universe</strong></p>
<p>This is the first book in a high-stakes romantic suspense series centered on the Northfall Syndicate.</p>
<p>Axel Halvik moves to Minnesota at eighteen, bringing his younger brother with him, determined to protect him from their father and take down the criminal empire that spans nearly all of Scandinavia. When Axel opens a new club in Cambridge, he forges connections that could finally help him succeed and meets Allyce, a struggling single mother with soulful brown eyes and hair that captivates him from the start.</p>
<p>What Axel thought would be one night turns into something more when Allyce finds herself targeted by a stalker. Though she fears Axel could be involved, the danger proves even closer than she imagined. As threats escalate and secrets come to light, Axel must confront his past and fight for the woman he can't let go, even if it takes him back to Sweden to finally end his father's empire.</p>
<p><em>Stalker is a romantic suspense novel of danger, family loyalty, and love that refuses to be denied.</em></p>
HTML,
		),
		array(
			'title'    => 'Untitled Vampire Novel',
			'status'   => 'planning',
			'subtitle' => 'Spin-off · Veilfall world · Vampire Fantasy Romance',
			'label'    => '',
			'url'      => '',
			'body'     => <<<'HTML'
<p>In Veilfall, readers learn that Vera's fate is tied to a mysterious vampire bound to the prophecy surrounding her life and death. This novel tells that story.</p>
<p>Ravienne is an eighteen-year-old girl living a quiet life in North Carolina until the night she turns eighteen. A haunting dream changes everything: a fae girl in agony reaches for her, standing beside another girl Ravienne has never met. When the dream fades, Ravienne awakens with unfamiliar cravings… and the devastating truth that she was adopted on that very night eighteen years ago.</p>
<p>Searching for answers, Ravienne follows the pull of her blood to Nocteris, a strange and dangerous land where vampires rule and nothing is as it seems. There, she finds unexpected allies among the townspeople and enemies watching her every move.</p>
<p>When Ravienne seeks answers from Ronan Vicaris, her presence draws the attention of King Aldric, who believes she may be a threat to his kingdom. Imprisoned within the castle walls, Ravienne must uncover the truth of who she is before it's taken from her entirely.</p>
<p>Help comes from an unlikely ally and from the girl in her dreams but escape comes at a cost. When King Aldric learns the truth of Ravienne's identity, he must decide whether to hunt her down… or save her.</p>
<p><em>This spin-off fantasy explores destiny, blood magic, and the ties that bind vampires and fae in a world where prophecy reaches far beyond one realm.</em></p>
<p>Title still under wraps.</p>
HTML,
		),
	);

	$pcount = 0;
	foreach ( $projects as $i => $pr ) {
		$post_id = wp_insert_post(
			array(
				'post_type'   => 'wh_project',
				'post_title'  => $pr['title'],
				'post_status' => 'publish',
				'menu_order'  => $i,
			)
		);
		if ( $post_id && ! is_wp_error( $post_id ) ) {
			update_field( 'project_status', $pr['status'], $post_id );
			update_field( 'project_subtitle', $pr['subtitle'], $post_id );
			update_field( 'project_body', $pr['body'], $post_id );
			update_field( 'project_link_label', $pr['label'], $post_id );
			update_field( 'project_link_url', $pr['url'], $post_id );
			$pcount++;
		}
	}

	update_option( 'wh_seeded_projects', 1 );
	if ( class_exists( 'WP_CLI' ) ) {
		WP_CLI::log( "[seed] Created {$pcount} projects." );
	}
} elseif ( class_exists( 'WP_CLI' ) ) {
	WP_CLI::log( '[seed] Projects already seeded — skipping.' );
}

/** Seed home-page extras once: which projects show under "Currently writing"
 * (with progress), and the two series-spotlight covers. */
if ( ! get_option( 'wh_seeded_home_extras' ) && function_exists( 'wh_book' ) ) {
	$home_projects = array(
		'Veilbound'             => array(
			'blurb'    => "Vera's magic is fully awakening — and so is the prophecy counting down her remaining time. The next chapter in the Kingdom of Sylvaeris saga picks up right where Veilfall leaves off.",
			'progress' => 62,
			'label'    => 'Draft in progress · Coming Fall 2026',
		),
		'His Northern Fixation' => array(
			'blurb'    => "Axel Halvik moved to Minnesota to protect his brother and take down his father's criminal empire — until Allyce, a single mother with a stalker closing in, becomes the one thing he can't walk away from.",
			'progress' => 30,
			'label'    => 'Early chapters · Northfall Syndicate series',
		),
	);
	foreach ( $home_projects as $title => $d ) {
		$found = get_posts(
			array(
				'post_type'      => 'wh_project',
				'title'          => $title,
				'posts_per_page' => 1,
				'post_status'    => 'publish',
			)
		);
		if ( $found ) {
			$pid = $found[0]->ID;
			update_field( 'project_on_home', 1, $pid );
			update_field( 'project_home_blurb', $d['blurb'], $pid );
			update_field( 'project_progress', $d['progress'], $pid );
			update_field( 'project_progress_label', $d['label'], $pid );
		}
	}

	$home_id = (int) get_option( 'page_on_front' );
	if ( $home_id ) {
		$vf = wh_book( 'veilfall' );
		if ( $vf && has_post_thumbnail( $vf->ID ) ) {
			update_field( 'home_spot1_cover', get_post_thumbnail_id( $vf->ID ), $home_id );
		}
		$ws = wh_book( 'whiskey-and-secrets' );
		if ( $ws && has_post_thumbnail( $ws->ID ) ) {
			update_field( 'home_spot2_cover', get_post_thumbnail_id( $ws->ID ), $home_id );
		}
	}

	update_option( 'wh_seeded_home_extras', 1 );
	if ( class_exists( 'WP_CLI' ) ) {
		WP_CLI::log( '[seed] Seeded home-page extras (currently-writing + spotlight covers).' );
	}
} elseif ( class_exists( 'WP_CLI' ) ) {
	WP_CLI::log( '[seed] Home extras already seeded — skipping.' );
}

/** Attach the current theme photos to the newly-added image fields (home hero,
 * both series' cover + about-section art) once, so those fields show the
 * site's real photo instead of "no image uploaded" until the owner replaces
 * it. Uploads each theme file into the Media Library and sets the field to
 * that attachment, same pattern as the book cover / team badge seeding above. */
if ( ! get_option( 'wh_seeded_page_images' ) ) {
	require_once ABSPATH . 'wp-admin/includes/image.php';

	/**
	 * Uploads a theme image file (if not already uploaded under that filename)
	 * and returns its attachment ID, or 0 on failure.
	 */
	$wh_seed_upload_image = function ( $rel_path, $parent_id, $title ) {
		$filename = basename( $rel_path );

		$existing = get_posts(
			array(
				'post_type'      => 'attachment',
				'posts_per_page' => 1,
				'title'          => $title,
				'post_status'    => 'inherit',
				'fields'         => 'ids',
			)
		);
		if ( $existing ) {
			return (int) $existing[0];
		}

		$file = get_template_directory() . '/' . ltrim( $rel_path, '/' );
		if ( ! file_exists( $file ) ) {
			return 0;
		}
		$upload = wp_upload_bits( $filename, null, file_get_contents( $file ) );
		if ( ! empty( $upload['error'] ) ) {
			return 0;
		}
		$attach_id = wp_insert_attachment(
			array(
				'post_mime_type' => $upload['type'],
				'post_title'     => $title,
				'post_status'    => 'inherit',
			),
			$upload['file'],
			$parent_id
		);
		if ( ! $attach_id || is_wp_error( $attach_id ) ) {
			return 0;
		}
		wp_update_attachment_metadata( $attach_id, wp_generate_attachment_metadata( $attach_id, $upload['file'] ) );
		return $attach_id;
	};

	$home_id = (int) get_option( 'page_on_front' );
	if ( $home_id ) {
		$id = $wh_seed_upload_image( 'images/photos/ali-wren-header.jpg', $home_id, 'Home hero photo' );
		if ( $id ) {
			update_field( 'home_hero_image', $id, $home_id );
		}
	}

	$vp_page = get_page_by_path( 'the-veiled-prophecy' );
	if ( $vp_page ) {
		$id = $wh_seed_upload_image( 'images/photos/prophecy.png', $vp_page->ID, 'The Veiled Prophecy cover photo' );
		if ( $id ) {
			update_field( 'series_cover_image', $id, $vp_page->ID );
		}
		$id = $wh_seed_upload_image( 'images/photos/wilderness.png', $vp_page->ID, 'The Veiled Prophecy about-section art' );
		if ( $id ) {
			update_field( 'about_series_image', $id, $vp_page->ID );
		}
	}

	$wtf_page_img = get_page_by_path( 'whiskey-tango-foxtrot' );
	if ( $wtf_page_img ) {
		$id = $wh_seed_upload_image( 'images/photos/shadowlink.png', $wtf_page_img->ID, 'Whiskey Tango Foxtrot cover photo' );
		if ( $id ) {
			update_field( 'series_cover_image', $id, $wtf_page_img->ID );
		}
		$id = $wh_seed_upload_image( 'images/photos/map.jpeg', $wtf_page_img->ID, 'Whiskey Tango Foxtrot about-section art' );
		if ( $id ) {
			update_field( 'about_series_image', $id, $wtf_page_img->ID );
		}
	}

	update_option( 'wh_seeded_page_images', 1 );
	if ( class_exists( 'WP_CLI' ) ) {
		WP_CLI::log( '[seed] Seeded home hero image + both series pages\' cover/about images.' );
	}
} elseif ( class_exists( 'WP_CLI' ) ) {
	WP_CLI::log( '[seed] Page images already seeded — skipping.' );
}

/** Seed the Whiskey Tango Foxtrot team roster once, directly as page postmeta
 * (see inc/inline-repeaters.php) — it's an inline "add row" list on that page
 * itself, not a separate CPT, since it's only ever shown there. */
if ( ! get_option( 'wh_seeded_wtf_team' ) ) {
	require_once ABSPATH . 'wp-admin/includes/image.php';
	$wtf_page = get_page_by_path( 'whiskey-tango-foxtrot' );

	if ( $wtf_page ) {
		$team_source = array(
			array( 'img' => 'wraith', 'name' => 'Wade "Wraith" Blakely', 'desc' => 'Team leader. Quiet, deadly, and protective. A force in the field with a guarded heart.' ),
			array( 'img' => 'glitch', 'name' => 'Jake "Glitch" Thompson', 'desc' => 'Communications expert. Brilliant with tech, haunted by his past, loyal to the end.' ),
			array( 'img' => 'reaper', 'name' => 'Simon "Reaper" Miller', 'desc' => 'Second-in-command. Lethal and strategic, but with a sarcastic streak and unmatched loyalty.' ),
			array( 'img' => 'sparta', 'name' => 'Shawn "Sparta" Jackson', 'desc' => 'Operations specialist. Keeps the team focused, carries ancient wisdom, and has a plan for everything.' ),
			array( 'img' => 'magellan', 'name' => 'Joel "Magellan" Ramirez', 'desc' => 'Weapons and logistics. Strength, charm, and a heart as steady as his aim.' ),
			array( 'img' => 'stitches', 'name' => 'Nick "Stitches" Davies', 'desc' => "Medic. Calm under pressure, a healer who's seen too much." ),
			array( 'img' => 'ghost', 'name' => 'Jackson "Ghost" Lewis', 'desc' => 'Intel. Silent, calculating, and often underestimated.' ),
		);

		$team = array();
		foreach ( $team_source as $m ) {
			$attach_id = 0;
			$file      = get_template_directory() . '/images/team/' . $m['img'] . '.png';
			if ( file_exists( $file ) ) {
				$upload = wp_upload_bits( $m['img'] . '.png', null, file_get_contents( $file ) );
				if ( empty( $upload['error'] ) ) {
					$attach_id = wp_insert_attachment(
						array(
							'post_mime_type' => $upload['type'],
							'post_title'     => $m['name'] . ' badge',
							'post_status'    => 'inherit',
						),
						$upload['file'],
						$wtf_page->ID
					);
					if ( $attach_id && ! is_wp_error( $attach_id ) ) {
						wp_update_attachment_metadata( $attach_id, wp_generate_attachment_metadata( $attach_id, $upload['file'] ) );
					} else {
						$attach_id = 0;
					}
				}
			}
			$team[] = array(
				'name'  => $m['name'],
				'desc'  => $m['desc'],
				'image' => $attach_id,
			);
		}

		update_post_meta( $wtf_page->ID, 'wtf_team', $team );
	}

	update_option( 'wh_seeded_wtf_team', 1 );
	if ( class_exists( 'WP_CLI' ) ) {
		WP_CLI::log( '[seed] Seeded Whiskey Tango Foxtrot team roster.' );
	}
} elseif ( class_exists( 'WP_CLI' ) ) {
	WP_CLI::log( '[seed] WTF team roster already seeded — skipping.' );
}

/** One-time cleanup: delete any leftover wh_milestone/wh_fact/wh_character
 * posts from before these became inline page repeaters. Harmless to skip if
 * none exist (e.g. a fresh install that never had the old CPTs). */
if ( ! get_option( 'wh_cleaned_up_old_repeater_cpts' ) ) {
	$old_posts = get_posts(
		array(
			'post_type'      => array( 'wh_milestone', 'wh_fact', 'wh_character' ),
			'post_status'    => 'any',
			'posts_per_page' => -1,
			'fields'         => 'ids',
		)
	);
	foreach ( $old_posts as $old_id ) {
		wp_delete_post( $old_id, true );
	}

	update_option( 'wh_cleaned_up_old_repeater_cpts', 1 );
	if ( class_exists( 'WP_CLI' ) ) {
		WP_CLI::log( '[seed] Cleaned up ' . count( $old_posts ) . ' leftover milestone/fact/team-member posts.' );
	}
} elseif ( class_exists( 'WP_CLI' ) ) {
	WP_CLI::log( '[seed] Old repeater CPT cleanup already done — skipping.' );
}
