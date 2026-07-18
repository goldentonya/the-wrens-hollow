<?php
/**
 * Template Name: Whiskey & Secrets
 */
$wh_nav_active = 'wtf';
get_header();

$wh_product_id = function_exists( 'wc_get_product_id_by_sku' ) ? wc_get_product_id_by_sku( 'whiskey-and-secrets-signed' ) : 0;
$wh_product    = $wh_product_id ? wc_get_product( $wh_product_id ) : false;
?>

<section class="sec--dark2 series-header">
  <div class="wrap" style="max-width:560px;">
    <p class="eyebrow eyebrow--on-dark">Whiskey Tango Foxtrot · Book 1</p>
    <h1 class="h-lg" style="color:#fff;">Whiskey &amp; Secrets</h1>
    <p class="lede" style="margin:14px auto 0;">Some secrets are worth the hangover.</p>
  </div>
</section>

<section class="sec sec--pink">
  <div class="wrap hero">
    <div class="wh-fade">
      <p class="book-card__tag">Book 1 · Available now</p>
      <p class="txt">Fierce, funny, unforgettable contemporary romance — sharp banter, real heartbreak, and a heroine who doesn't back down. Whiskey &amp; Secrets kicks off the Whiskey Tango Foxtrot series with the kind of love that hits like a shot and lingers like the good stuff.</p>
      <div class="product-card__row" id="buy" style="justify-content:flex-start;gap:16px;margin-top:20px;">
        <?php if ( $wh_product ) : ?>
          <span class="product-card__price"><?php echo wp_kses_post( $wh_product->get_price_html() ); ?> · Signed paperback</span>
          <?php echo do_shortcode( '[add_to_cart id="' . $wh_product_id . '" show_price="false" style=""]' ); ?>
        <?php else : ?>
          <span class="product-card__price">$21.99 · Signed paperback</span>
          <button class="btn btn--outline" type="button" data-notify="the Whiskey & Secrets paperback">Notify me when available</button>
        <?php endif; ?>
      </div>
    </div>
    <div class="hero__cover wh-fade" style="--delay:.1s">
      <div class="ph-box"><img src="<?php echo esc_url( get_template_directory_uri() . '/images/covers/whiskey-and-secrets.jpg' ); ?>" alt="Whiskey &amp; Secrets book cover" style="width:220px;height:320px;object-fit:cover;box-shadow:0 18px 40px rgba(60,40,50,.28);border-radius:4px;"></div>
    </div>
  </div>
</section>

<section class="sec sec--cream sec--dashed-top">
  <div class="wrap book-about">
    <p class="eyebrow">About the book</p>
    <h2 class="h-md">Whiskey &amp; Secrets</h2>
    <p class="txt" style="max-width:600px;">When biological anthropology grad student Sarah agrees to lead a research expedition in the Amazon Rainforest, she never expected to need military protection — let alone from Wade "Wraith" Blakely, the stoic, enigmatic former Green Beret who's been assigned to keep her team safe.</p>
    <p class="txt" style="max-width:600px;">Wade is used to dangerous missions, but babysitting scientists wasn't what he signed up for. Until one of them goes missing, and secrets buried deep in the jungle — and in Sarah's past — begin to surface. As the threat around them escalates, so does the undeniable pull between Sarah and Wade. But trusting each other might be their only way out alive.</p>
    <p class="txt" style="max-width:600px;margin-top:20px;"><a href="<?php echo esc_url( function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) . '#whiskey-and-secrets' : home_url( '/shop/#whiskey-and-secrets' ) ); ?>" style="color:var(--plum);font-weight:700;">Find the paperback available here →</a></p>
    <p class="txt" style="max-width:600px;">The ebook will be available on Kindle Unlimited!</p>
    <p class="txt" style="max-width:600px;font-style:italic;margin-top:20px;">Readers are loving Whiskey &amp; Secrets! With an average rating of 4.5 stars on Goodreads, fans are praising its mix of adventure, romance, and suspense.</p>
    <a class="btn btn--outline" href="https://www.goodreads.com/book/show/246550825-whiskey-secrets" target="_blank" rel="noopener" style="margin-top:6px;">Goodreads</a>
  </div>
</section>

<section class="sec sec--pink sec--dashed-top">
  <div class="wrap sec--center">
    <h2 class="h-md" style="color:var(--plum-deep);">Read Whiskey &amp; Secrets</h2>
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
  <div class="wrap">
    <p class="eyebrow" style="text-align:center;margin-bottom:28px;">What readers are saying</p>
    <div class="grid-2">
      <div class="card review-card">
        <p class="stars">★★★★★</p>
        <p class="txt">Sharp, funny, and it wrecked me in the best way.</p>
        <p class="source">— Reader review</p>
      </div>
      <div class="card review-card">
        <p class="stars">★★★★★</p>
        <p class="txt">I need Book 3 immediately.</p>
        <p class="source">— Reader review</p>
      </div>
    </div>
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
