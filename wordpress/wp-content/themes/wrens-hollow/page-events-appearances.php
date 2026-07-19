<?php
/**
 * Template Name: Events & Appearances
 */
$wh_nav_active = 'events';
get_header();
?>

<section class="sec sec--pink">
  <div class="wrap">
    <p class="eyebrow">Events &amp; appearances</p>
    <h1 class="h-lg">Come say hi</h1>
    <p class="lede" style="margin-top:12px;">Signings, book fairs &amp; author events — where to find me next.</p>
  </div>
</section>

<section class="sec">
  <div class="wrap">
    <h2 class="h-md" style="margin-bottom:20px;">Upcoming</h2>
    <div class="card event-card">
      <div class="event-date event-date--tba">
        <div class="event-date__mon" style="color:var(--text-muted);">TBA</div>
      </div>
      <div>
        <h3>More dates TBD</h3>
        <p class="txt">New appearances are added throughout the year — check back soon.</p>
      </div>
    </div>
  </div>
</section>

<section class="sec sec--dashed-top">
  <div class="wrap">
    <h2 class="h-md" style="margin-bottom:20px;">Past events</h2>

    <div class="card event-card">
      <div class="event-date">
        <div class="event-date__day">11</div>
        <div class="event-date__mon">JUL</div>
      </div>
      <div>
        <h3>The Summer's Best Book Fair for Grown Ups</h3>
        <p class="txt">📍 The Grandstand, Falcon Heights, MN · July 11, 2026 · 11am–7pm</p>
        <a class="btn btn--outline btn--sm" href="https://facebook.com/events/s/the-summers-best-book-fair-for/1640890470424298" target="_blank" rel="noopener">Event details</a>
      </div>
    </div>

    <div class="card event-card">
      <div class="event-date">
        <div class="event-date__day">28</div>
        <div class="event-date__mon">JUN</div>
      </div>
      <div>
        <h3>Booked It! At the Brewery</h3>
        <p class="txt">📍 Sunken Ship Brewery Company, Princeton, MN · June 28, 2026 · 11am–4pm</p>
        <a class="btn btn--outline btn--sm" href="https://facebook.com/events/s/booked-it-at-the-brewery/861609956787546/" target="_blank" rel="noopener">Event details</a>
      </div>
    </div>

    <div class="card event-card">
      <div class="event-date">
        <div class="event-date__day">31</div>
        <div class="event-date__mon">MAY</div>
      </div>
      <div>
        <h3>Whiskey &amp; Lies Book Launch</h3>
        <p class="txt">📍 Dana's Bookstore, Isanti, MN · May 31, 2026 · 11am–2pm</p>
        <a class="btn btn--outline btn--sm" href="https://facebook.com/events/s/whiskey-lies-book-launch-event/1674830936855932/" target="_blank" rel="noopener">Event details</a>
      </div>
    </div>

    <div class="card event-card">
      <div class="event-date">
        <div class="event-date__day">30</div>
        <div class="event-date__mon">MAY</div>
      </div>
      <div>
        <h3>New Moons Bookstore Grand Opening</h3>
        <p class="txt">📍 New Moons Bookstore, Forest Lake, MN · May 30, 2026 · 1pm–4pm</p>
        <a class="btn btn--outline btn--sm" href="https://facebook.com/events/s/new-moons-bookshop-two-day-gra/1686221752731399/" target="_blank" rel="noopener">Event details</a>
      </div>
    </div>

    <div class="card event-card">
      <div class="event-date">
        <div class="event-date__day">25</div>
        <div class="event-date__mon">APR</div>
      </div>
      <div>
        <h3>Book Fair @ The Bee</h3>
        <p class="txt">📍 The Bee Caffe, Milaca, MN · April 25, 2026 · 10am–2pm</p>
        <a class="btn btn--outline btn--sm" href="https://facebook.com/events/s/book-fair-the-bee-425/3187285531578869" target="_blank" rel="noopener">Event details</a>
      </div>
    </div>

    <div class="card event-card">
      <div class="event-date">
        <div class="event-date__day">5</div>
        <div class="event-date__mon">MAR</div>
      </div>
      <div>
        <h3>Booked It! At the Brewery</h3>
        <p class="txt">📍 Sunken Ship Brewery Company, Princeton, MN · March 5, 2026 · 4pm–8pm</p>
        <a class="btn btn--outline btn--sm" href="https://facebook.com/events/s/booked-it-at-the-brewery/1254943413157183/" target="_blank" rel="noopener">Event details</a>
      </div>
    </div>

    <div class="card event-card">
      <div class="event-date">
        <div class="event-date__day">14</div>
        <div class="event-date__mon">FEB</div>
      </div>
      <div>
        <h3>Love Local Authors</h3>
        <p class="txt">📍 Enchanted Quill, North Branch, MN · February 14, 2026 · 11am–2pm</p>
        <a class="btn btn--outline btn--sm" href="https://facebook.com/events/s/love-local-authors-event/1180611124260845/" target="_blank" rel="noopener">Event details</a>
      </div>
    </div>

    <div class="card event-card">
      <div class="event-date">
        <div class="event-date__day">16</div>
        <div class="event-date__mon">NOV</div>
      </div>
      <div>
        <h3>Veilfall Debut Book Signing – Meet Ali Wren</h3>
        <p class="txt">📍 Dana's Bookstore, Isanti, MN · November 16, 2025 · 12pm–3pm</p>
      </div>
    </div>
  </div>
</section>

<section class="sec sec--tight sec--cream2 sec--dashed-top">
  <div class="wrap sec--center">
    <p class="eyebrow">Join the Hollow</p>
    <h2 class="h-md" style="color:var(--plum-deep);">Never miss an event or release</h2>
    <form class="newsletter-form" id="newsletterForm" style="margin-left:auto;margin-right:auto;">
      <input class="field" type="email" placeholder="your@email.com" required aria-label="Email address">
      <button class="btn" type="submit">Subscribe</button>
    </form>
    <p class="form-status" id="newsletterStatus"></p>
  </div>
</section>

<?php get_footer(); ?>
