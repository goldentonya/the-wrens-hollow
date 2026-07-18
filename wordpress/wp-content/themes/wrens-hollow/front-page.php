<?php
/**
 * Template Name: Home
 */
$wh_nav_active = 'home';
get_header();
?>

<!-- Hero -->
<section class="sec sec--pink">
  <div class="wrap hero">
    <div class="wh-fade">
      <p class="eyebrow">The Veiled Prophecy · Book 1</p>
      <h1 class="h-lg" style="font-size:clamp(32px,5vw,48px);line-height:1.1;">She doesn't know who to trust.</h1>
      <p class="lede" style="margin-top:14px;">Begin the fantasy series with <strong>Veilfall</strong>, the free first book readers can't put down.</p>
      <a class="btn" href="<?php echo esc_url( home_url( '/the-veiled-prophecy/' ) ); ?>">Start Reading Free →</a>
      <p class="trust-line">★★★★★ · 200+ reviews · free forever</p>
    </div>
    <div class="hero__cover wh-fade" style="--delay:.1s">
      <div class="ph-box"><img src="<?php echo esc_url( get_template_directory_uri() . '/images/covers/veilfall.jpg' ); ?>" alt="Veilfall book cover" style="width:220px;height:320px;object-fit:cover;box-shadow:0 18px 40px rgba(60,40,50,.28);border-radius:4px;"></div>
    </div>
  </div>
</section>

<!-- Newsletter band -->
<section class="sec sec--tight sec--dark">
  <div class="wrap sec--center">
    <p class="eyebrow eyebrow--on-dark">Join the Hollow</p>
    <h2 class="h-md" style="font-size:24px;">Get bonus chapters + first look at new releases</h2>
    <form class="newsletter-form" id="newsletterForm" style="margin-left:auto;margin-right:auto;">
      <input class="field" type="email" placeholder="your@email.com" required aria-label="Email address">
      <button class="btn" type="submit">Subscribe</button>
    </form>
    <p class="form-status" id="newsletterStatus"></p>
  </div>
</section>

<!-- Explore the books -->
<section class="sec" id="books">
  <div class="wrap">
    <p class="eyebrow">Explore the books</p>
    <h2 class="h-lg">Two worlds, one storyteller</h2>
    <div style="margin-top:32px;">
      <div class="card book-card book-card--featured">
        <div class="ph-box"><img src="<?php echo esc_url( get_template_directory_uri() . '/images/covers/veiled-prophecy.jpg' ); ?>" alt="The Veiled Prophecy cover" style="width:92px;height:128px;object-fit:cover;border-radius:4px;"></div>
        <div>
          <p class="book-card__tag">Fantasy · lead series</p>
          <h3>The Veiled Prophecy</h3>
          <p class="txt">Veilfall · Book 1 coming soon. Epic, romantic, high-stakes.</p>
          <a class="btn btn--outline btn--sm" href="<?php echo esc_url( home_url( '/the-veiled-prophecy/' ) ); ?>">Enter the story</a>
        </div>
      </div>
      <div class="card book-card">
        <div class="ph-box"><img src="<?php echo esc_url( get_template_directory_uri() . '/images/covers/whiskey-tango-foxtrot.jpg' ); ?>" alt="Whiskey Tango Foxtrot cover" style="width:92px;height:128px;object-fit:cover;border-radius:4px;"></div>
        <div>
          <p class="book-card__tag">Contemporary romance</p>
          <h3>Whiskey Tango Foxtrot</h3>
          <p class="txt">Whiskey &amp; Secrets · Whiskey &amp; Lies. Read the first chapters free.</p>
          <a class="btn btn--outline btn--sm" href="<?php echo esc_url( home_url( '/whiskey-tango-foxtrot/' ) ); ?>">Read free chapters</a>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="divider-label">★ Reader reviews</div>

<!-- Reviews -->
<section class="sec sec--tight">
  <div class="wrap grid-2">
    <div class="card review-card">
      <p class="stars">★★★★★</p>
      <p class="txt">"Couldn't put it down — the tension is unreal."</p>
      <p class="source">— Goodreads</p>
    </div>
    <div class="card review-card">
      <p class="stars">★★★★★</p>
      <p class="txt">"Fierce women and swoony romance. More please!"</p>
      <p class="source">— Amazon</p>
    </div>
  </div>
</section>

<!-- About teaser -->
<section class="sec sec--cream">
  <div class="wrap bio-row">
    <div class="ph-box ph-box--round"><img src="<?php echo esc_url( get_template_directory_uri() . '/images/photos/ali-wren.jpg' ); ?>" alt="Ali Wren, author" style="width:140px;height:160px;object-fit:cover;border-radius:50%;"></div>
    <div>
      <p class="eyebrow">Behind the pen</p>
      <h3 class="h-md">Hi, I'm Ali Wren</h3>
      <p class="txt">Indie author from Minnesota writing romance &amp; fantasy full of emotion, danger, and unforgettable connections.</p>
      <a class="btn btn--outline btn--sm" href="<?php echo esc_url( home_url( '/about/' ) ); ?>">Read more</a>
    </div>
  </div>
</section>

<!-- Currently writing -->
<section class="sec sec--dashed-top">
  <div class="wrap" style="max-width:520px;">
    <p class="eyebrow">On the horizon</p>
    <h3 class="h-md">Currently writing…</h3>
    <p class="txt">Sneak peek at the next book + a progress bar for the WIP.</p>
    <div class="progress-track"><div class="progress-fill" style="width:62%"></div></div>
  </div>
</section>

<?php get_footer(); ?>
