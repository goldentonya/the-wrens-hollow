<?php
/**
 * Template Name: Events & Appearances
 */
$wh_nav_active = 'events';
get_header();
?>

<section class="sec sec--pink">
  <div class="wrap">
    <p class="eyebrow"><?php wh_the( 'ev_eyebrow', 'Events & appearances' ); ?></p>
    <h1 class="h-lg"><?php wh_the( 'ev_title', 'Come say hi' ); ?></h1>
    <p class="lede" style="margin-top:12px;"><?php wh_the( 'ev_lede', 'Signings, book fairs & author events — where to find me next.' ); ?></p>
  </div>
</section>

<section class="sec">
  <div class="wrap">
    <h2 class="h-md" style="margin-bottom:20px;">Upcoming</h2>
    <?php
    $wh_upcoming = wh_events( 'upcoming' );
    if ( $wh_upcoming ) :
      foreach ( $wh_upcoming as $wh_event ) {
        wh_render_event_card( $wh_event );
      }
    else :
    ?>
    <div class="card event-card">
      <div class="event-date event-date--tba">
        <div class="event-date__mon" style="color:var(--text-muted);">TBA</div>
      </div>
      <div>
        <h3>More dates TBD</h3>
        <p class="txt">New appearances are added throughout the year — check back soon.</p>
      </div>
    </div>
    <?php endif; ?>
  </div>
</section>

<?php $wh_past = wh_events( 'past' ); ?>
<?php if ( $wh_past ) : ?>
<section class="sec sec--dashed-top">
  <div class="wrap">
    <h2 class="h-md" style="margin-bottom:20px;">Past events</h2>
    <?php
    foreach ( $wh_past as $wh_event ) {
      wh_render_event_card( $wh_event );
    }
    ?>
  </div>
</section>
<?php endif; ?>

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
