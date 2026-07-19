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
