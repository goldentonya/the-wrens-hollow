<?php
/**
 * Template Name: Whiskey Tango Foxtrot
 */
$wh_nav_active = 'wtf';
get_header();
?>

<section class="sec--dark2 series-header">
  <div class="wrap" style="max-width:560px;">
    <p class="eyebrow eyebrow--on-dark">Contemporary romance</p>
    <h1 class="h-lg" style="color:#fff;">Whiskey Tango Foxtrot</h1>
    <p class="lede" style="margin:14px auto 0;">Fierce, funny, unforgettable — love that hits like a shot and lingers like the good stuff.</p>
  </div>
</section>

<section class="sec sec--tight">
  <div class="wrap">
    <p class="txt" style="max-width:600px;">Contemporary romance with sharp banter, real heartbreak, and women who don't back down. Here's where to begin.</p>
  </div>
</section>

<section class="sec sec--dashed-top">
  <div class="wrap">
    <p class="eyebrow">Reading order</p>
    <div class="card book-card book-card--featured">
      <div class="ph-box"><img src="<?php echo esc_url( get_template_directory_uri() . '/images/covers/whiskey-and-secrets.jpg' ); ?>" alt="Whiskey &amp; Secrets book cover" style="width:92px;height:128px;object-fit:cover;border-radius:4px;"></div>
      <div>
        <p class="book-card__tag">Book 1 · First chapters free</p>
        <h3>Whiskey &amp; Secrets</h3>
        <p class="txt">Some secrets are worth the hangover.</p>
        <a class="btn btn--sm" href="#read">Read free chapters →</a>
        <a class="btn btn--outline btn--sm" href="<?php echo esc_url( home_url( '/whiskey-and-secrets/' ) ); ?>" style="margin-left:8px;">View book &amp; buy →</a>
      </div>
    </div>
    <div class="card book-card">
      <div class="ph-box"><img src="<?php echo esc_url( get_template_directory_uri() . '/images/covers/whiskey-and-lies.jpg' ); ?>" alt="Whiskey &amp; Lies book cover" style="width:92px;height:128px;object-fit:cover;border-radius:4px;"></div>
      <div>
        <p class="book-card__tag">Book 2 · Free</p>
        <h3>Whiskey &amp; Lies</h3>
        <p class="txt">Includes bonus chapters for readers who finish the book.</p>
        <a class="btn btn--outline btn--sm" href="#read">Read free →</a>
        <a class="btn btn--outline btn--sm" href="<?php echo esc_url( home_url( '/whiskey-and-lies/' ) ); ?>" style="margin-left:8px;">View book →</a>
      </div>
    </div>
  </div>
</section>

<section class="sec sec--cream">
  <div class="wrap grid-2">
    <div class="card review-card">
      <p class="stars">★★★★★</p>
      <p class="txt">Sharp, funny, and it wrecked me in the best way.</p>
    </div>
    <div class="card review-card">
      <p class="stars">★★★★★</p>
      <p class="txt">I need Book 3 immediately.</p>
    </div>
  </div>
</section>

<section class="sec sec--tight sec--cream2">
  <div class="wrap sec--center">
    <p class="eyebrow">Join the Hollow</p>
    <h2 class="h-md" style="color:var(--plum-deep);">Get bonus chapters + first look at new releases</h2>
    <form class="newsletter-form" id="newsletterForm" style="margin-left:auto;margin-right:auto;">
      <input class="field" type="email" placeholder="your@email.com" required aria-label="Email address">
      <button class="btn" type="submit">Notify me</button>
    </form>
    <p class="form-status" id="newsletterStatus"></p>
  </div>
</section>

<?php get_footer(); ?>
