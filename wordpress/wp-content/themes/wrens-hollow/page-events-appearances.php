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
    <div class="card event-card">
      <div class="event-date">
        <div class="event-date__day">14</div>
        <div class="event-date__mon">AUG</div>
      </div>
      <div>
        <h3>Book Fair for Grown-Ups</h3>
        <p class="txt">📍 Venue, City · 10am–4pm</p>
        <a class="btn btn--outline btn--sm" href="#">Details &amp; RSVP</a>
      </div>
    </div>
    <div class="card event-card">
      <div class="event-date event-date--tba">
        <div class="event-date__mon" style="color:var(--text-muted);">TBA</div>
      </div>
      <div>
        <h3>More dates coming</h3>
        <p class="txt">New appearances added throughout the year.</p>
      </div>
    </div>
  </div>
</section>

<section class="sec sec--cream sec--dashed-top">
  <div class="wrap" style="max-width:520px;">
    <p class="eyebrow">On the horizon</p>
    <h3 class="h-md">What's next from Ali</h3>
    <p class="txt">Upcoming releases + WIP progress.</p>
    <div class="progress-track"><div class="progress-fill" style="width:62%"></div></div>
  </div>
</section>

<section class="sec sec--tight sec--cream2">
  <div class="wrap sec--center">
    <h2 class="h-md" style="color:var(--plum-deep);">Never miss an event or release</h2>
    <form class="newsletter-form" id="newsletterForm" style="margin-left:auto;margin-right:auto;">
      <input class="field" type="email" placeholder="your@email.com" required aria-label="Email address">
      <button class="btn" type="submit">Subscribe</button>
    </form>
    <p class="form-status" id="newsletterStatus"></p>
  </div>
</section>

<?php get_footer(); ?>
