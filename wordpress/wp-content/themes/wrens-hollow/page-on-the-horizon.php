<?php
/**
 * Template Name: On the Horizon
 *
 * Upcoming / in-progress projects. Text-forward: no cover art, since most of
 * these titles don't have covers yet. Whiskey & Lies is already released, so
 * it's shown as "now available" with a link, not as a work in progress.
 */
$wh_nav_active = 'horizon';
get_header();
?>

<section class="sec sec--pink">
  <div class="wrap">
    <p class="eyebrow"><?php wh_the( 'hz_eyebrow', 'Coming soon from Ali' ); ?></p>
    <h1 class="h-lg"><?php wh_the( 'hz_title', 'On the Horizon' ); ?></h1>
    <p class="lede" style="margin-top:12px;"><?php wh_the( 'hz_lede', "I'm always working on new stories. This page is where I share upcoming projects, early details, and what I'm currently writing. Information may change as these stories evolve." ); ?></p>
  </div>
</section>

<section class="sec sec--dashed-top">
  <div class="wrap">
    <div class="roadmap">

      <?php foreach ( wh_projects() as $wh_project ) { wh_render_project( $wh_project ); } ?>

    </div>
  </div>
</section>

<section class="sec sec--tight sec--cream2 sec--dashed-top">
  <div class="wrap sec--center">
    <p class="eyebrow">Join the Hollow</p>
    <h2 class="h-md" style="color:var(--plum-deep);">Be the first to know when these release</h2>
    <form class="newsletter-form" id="newsletterForm" style="margin-left:auto;margin-right:auto;">
      <input class="field" type="email" placeholder="your@email.com" required aria-label="Email address">
      <button class="btn" type="submit">Notify me</button>
    </form>
    <p class="form-status" id="newsletterStatus"></p>
  </div>
</section>

<?php get_footer(); ?>
