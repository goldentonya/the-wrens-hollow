<?php
/**
 * Template Name: Veilbound
 */
$wh_nav_active = 'read-free';
get_header();
?>

<section class="sec--dark2 series-header">
  <div class="wrap" style="max-width:560px;">
    <p class="eyebrow eyebrow--on-dark">The Veiled Prophecy · Book 2</p>
    <h1 class="h-lg" style="color:#fff;">Veilbound</h1>
    <p class="lede" style="margin:14px auto 0;">The fate of the kingdom — and her heart — hangs in the balance.</p>
  </div>
</section>

<section class="sec sec--pink">
  <div class="wrap hero">
    <div class="wh-fade">
      <p class="book-card__tag">Book 2 · Coming soon</p>
      <p class="txt">The next chapter in the Kingdom of Sylvaeris saga, picking up where Veilfall leaves off.</p>
      <div style="margin-top:20px;">
        <button class="btn btn--outline" type="button" data-notify="Veilbound">Notify me on release</button>
      </div>
      <p class="txt" style="margin-top:18px;"><a href="<?php echo esc_url( home_url( '/veilfall/' ) ); ?>" style="color:var(--plum);font-weight:700;">Haven't started the series? Read Veilfall free →</a></p>
    </div>
    <div class="hero__cover wh-fade" style="--delay:.1s">
      <div class="ph-box"><img src="<?php echo esc_url( get_template_directory_uri() . '/images/covers/veilbound.jpg' ); ?>" alt="Veilbound book cover" style="width:100%;height:100%;object-fit:cover;border-radius:4px;"></div>
    </div>
  </div>
</section>

<section class="sec sec--cream sec--dashed-top">
  <div class="wrap book-about">
    <p class="eyebrow">About the book</p>
    <h2 class="h-md">Veilbound</h2>
    <p class="txt" style="max-width:600px;">In Veilfall, Veralyn’s world shattered when her parents were murdered and she was forced to return to the fae realm she never knew was hers. Hidden in the human world to protect her from a prophecy foretelling her death, Vera was thrust into Auravale Academy and the dangerous ranks of the Veilbound Order — where enemies watch from the shadows.</p>
    <p class="txt" style="max-width:600px;">In Veilbound, Vera’s magic fully awakens during the Veilfall Festival, revealing gifts tied not only to the fae realm, but to the first Fae Queen herself. As her power deepens, so do the mysteries surrounding her fate, including unexpected connections to a vampire and a wolf shifter she was never meant to meet.</p>
    <p class="txt" style="max-width:600px;">Caelum Thornevale, Prince of Sylvaeris and heir to all the fae lands, refuses to let Vera face her destiny alone. Bound by a fated mate bond that Vera continues to resist, Caelum fights to protect her—even as she pushes him away to shield him from a future where she may not survive.</p>
    <p class="txt" style="max-width:600px;">With love that could destroy her and a prophecy counting down her remaining time, Vera must decide whether protecting her heart is worth losing everything else.</p>
    <p class="txt" style="max-width:600px;font-style:italic;">Veilbound is a romantic fae fantasy filled with prophecy, ancient magic, fated mates, and a love that refuses to be denied.</p>
    <p class="txt" style="max-width:600px;margin-top:20px;font-weight:700;color:var(--plum-deep);">Coming Fall 2026!</p>
  </div>
</section>

<section class="sec sec--pink sec--dashed-top">
  <div class="wrap sec--center">
    <h2 class="h-md" style="color:var(--plum-deep);">Read Veilbound</h2>
    <p class="txt" style="max-width:440px;margin:0 auto 20px;">Enter your email below to receive the opening chapters instantly.</p>
    <form class="optin-form" id="optinForm" style="text-align:left;max-width:420px;margin:0 auto;">
      <div class="optin-row">
        <label class="optin-label" for="optinFirst">Name <span class="req">*</span></label>
        <div class="optin-row__fields">
          <div class="optin-field">
            <input class="field" id="optinFirst" name="firstName" type="text" required autocomplete="given-name">
            <span class="optin-sublabel">First</span>
          </div>
          <div class="optin-field">
            <input class="field" id="optinLast" name="lastName" type="text" autocomplete="family-name">
            <span class="optin-sublabel">Last</span>
          </div>
        </div>
      </div>
      <div class="optin-row">
        <label class="optin-label" for="optinEmail">Email <span class="req">*</span></label>
        <input class="field" id="optinEmail" name="email" type="email" required autocomplete="email">
      </div>
      <button class="btn" type="submit">Submit</button>
    </form>
    <p class="form-status" id="optinStatus"></p>
  </div>
</section>

<section class="sec sec--cream sec--dashed-top">
  <div class="wrap sec--center">
    <p class="eyebrow" style="margin-bottom:12px;">What readers are saying</p>
    <p class="txt" style="max-width:440px;margin:0 auto;">Reviews will show up here once Veilbound is out in the world — check back after release!</p>
  </div>
</section>

<section class="sec sec--tight sec--cream2 sec--dashed-top">
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
