<?php
/**
 * Template Name: The Veiled Prophecy
 */
$wh_nav_active = 'read-free';
get_header();
?>

<section class="sec--dark2 series-header">
  <div class="wrap" style="max-width:560px;">
    <p class="eyebrow eyebrow--on-dark">Fantasy series · Kingdom of Sylvaeris</p>
    <h1 class="h-lg" style="color:#fff;">The Veiled Prophecy</h1>
    <p class="lede" style="margin:14px auto 0;">Hidden deep beyond the veil, Sylvaeris is a land where ancient magic stirs, and fate weaves tighter than any spell.</p>
    <p class="lede" style="margin-top:14px;">At the heart of this world is Veralyn, a girl who grew up believing she was human—until the truth calls her back.</p>
    <p class="lede" style="margin-top:14px;">Beside her stands Caelum, the guarded prince with the power to read auras and a kingdom to protect.</p>
    <p class="lede" style="margin-top:14px;">Dark secrets rise, the Veilbound Order beckons, and not everyone wants the heir’s chosen to survive.</p>
    <p class="lede" style="margin-top:14px;">A tale of fate, forbidden magic, and slow-burn romance awaits. Start free, then follow the saga.</p>
  </div>
</section>

<section class="sec sec--tight">
  <div class="wrap">
    <p class="txt" style="max-width:600px;">Epic romantasy where fierce women hold the fate of a kingdom — and their hearts — in the balance. Here's where to begin.</p>
  </div>
</section>

<section class="sec sec--dashed-top">
  <div class="wrap">
    <p class="eyebrow">Reading order</p>
    <div class="card book-card book-card--featured">
      <div class="ph-box"><img src="<?php echo esc_url( get_template_directory_uri() . '/images/covers/veilfall.jpg' ); ?>" alt="Veilfall book cover" style="width:92px;height:128px;object-fit:cover;border-radius:4px;"></div>
      <div>
        <p class="book-card__tag">Book 1 · First chapters free</p>
        <h3>Veilfall</h3>
        <p class="txt">She thought she was human. The fae realm knows better.</p>
        <a class="btn btn--sm" href="<?php echo esc_url( home_url( '/veilfall/' ) ); ?>">Start reading free →</a>
        <a class="btn btn--outline btn--sm" href="<?php echo esc_url( home_url( '/veilfall/#buy' ) ); ?>" style="margin-left:8px;">View book →</a>
      </div>
    </div>
    <div class="card book-card">
      <div class="ph-box"><img src="<?php echo esc_url( get_template_directory_uri() . '/images/covers/veilbound.jpg' ); ?>" alt="Veilbound book cover" style="width:92px;height:128px;object-fit:cover;border-radius:4px;"></div>
      <div>
        <p class="book-card__tag">Book 2 · Coming soon</p>
        <h3>Veilbound</h3>
        <p class="txt">The fate of the kingdom — and her heart — hangs in the balance.</p>
        <button class="btn btn--sm" type="button" data-notify="Veilbound">Notify me on release</button>
        <a class="btn btn--outline btn--sm" href="<?php echo esc_url( home_url( '/veilbound/' ) ); ?>" style="margin-left:8px;">Learn more →</a>
      </div>
    </div>
  </div>
</section>

<section class="sec sec--cream">
  <div class="wrap grid-2">
    <div class="card review-card">
      <p class="stars">★★★★★</p>
      <p class="txt">The world-building is gorgeous.</p>
    </div>
    <div class="card review-card">
      <p class="stars">★★★★★</p>
      <p class="txt">Give me book one already!</p>
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
