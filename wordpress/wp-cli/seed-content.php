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

/** Seed Events, only if none exist yet. */
$existing_events = get_posts(
	array(
		'post_type'   => 'wh_event',
		'post_status' => 'any',
		'numberposts' => 1,
		'fields'      => 'ids',
	)
);

if ( empty( $existing_events ) ) {
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

	if ( class_exists( 'WP_CLI' ) ) {
		WP_CLI::log( "[seed] Created {$count} events." );
	}
} elseif ( class_exists( 'WP_CLI' ) ) {
	WP_CLI::log( '[seed] Events already present — skipping event seed.' );
}
