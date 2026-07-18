<?php
/**
 * Template Name: Veilfall
 */
$wh_nav_active = 'read-free';
get_header();

$wh_product_id = function_exists( 'wc_get_product_id_by_sku' ) ? wc_get_product_id_by_sku( 'veilfall-paperback' ) : 0;
$wh_product    = $wh_product_id ? wc_get_product( $wh_product_id ) : false;
?>

<section class="sec--dark2 series-header">
  <div class="wrap" style="max-width:560px;">
    <p class="eyebrow eyebrow--on-dark">The Veiled Prophecy · Book 1</p>
    <h1 class="h-lg" style="color:#fff;">Veilfall</h1>
    <p class="lede" style="margin:14px auto 0;">Step into the Kingdom of Sylvaeris.</p>
  </div>
</section>

<section class="sec sec--pink">
  <div class="wrap hero">
    <div class="wh-fade">
      <p class="book-card__tag">Book 1 · Available now</p>
      <p class="txt">She was hidden in the human realm to stay safe. But magic has a way of finding what was never meant to be forgotten. Start Veralyn's story with this dark fae fantasy romance.</p>
      <div class="product-card__row" id="buy" style="justify-content:flex-start;gap:16px;margin-top:20px;">
        <?php if ( $wh_product ) : ?>
          <span class="product-card__price"><?php echo wp_kses_post( $wh_product->get_price_html() ); ?> · Paperback</span>
          <?php echo do_shortcode( '[add_to_cart id="' . $wh_product_id . '" show_price="false" style=""]' ); ?>
        <?php else : ?>
          <span class="product-card__price">$19.99 · Paperback</span>
          <button class="btn btn--outline" type="button" data-notify="the Veilfall paperback">Notify me when available</button>
        <?php endif; ?>
      </div>
    </div>
    <div class="hero__cover wh-fade" style="--delay:.1s">
      <div class="ph-box"><img src="<?php echo esc_url( get_template_directory_uri() . '/images/covers/veilfall.jpg' ); ?>" alt="Veilfall book cover" style="width:220px;height:320px;object-fit:cover;box-shadow:0 18px 40px rgba(60,40,50,.28);border-radius:4px;"></div>
    </div>
  </div>
</section>

<section class="sec sec--cream sec--dashed-top">
  <div class="wrap book-about">
    <p class="eyebrow">About the book</p>
    <h2 class="h-md">Veilfall</h2>
    <p class="txt" style="max-width:600px;">She was hidden in the human realm to stay safe. But magic has a way of finding what was never meant to be forgotten.</p>
    <p class="txt" style="max-width:600px;">Veralyn spent her whole life believing she was ordinary, until the night everything changed. When her parents are killed, the truth shatters through her carefully built world: she's not human. She's fae. And not just any fae, she's bound to a prophecy that could alter the future of the entire realm. Forced to return to Sylvaeris she attends Auravale Academy.</p>
    <p class="txt" style="max-width:600px;">Auravale Academy is a school for the elite and powerful. Vera must confront a world she was never meant to leave… and powers she doesn't yet understand.</p>
    <p class="txt" style="max-width:600px;">Caelum Thornevale, Prince of the realm and heir to the throne, is used to having control. But when he crosses paths with Vera everything changes.</p>
    <p class="txt" style="max-width:600px;">As her magic awakens, so do old enemies and forgotten secrets. In a kingdom on the brink of war, fate is not a choice.</p>
    <p class="txt" style="max-width:600px;font-style:italic;">But love might be.</p>
    <p class="txt" style="max-width:600px;margin-top:20px;"><a href="<?php echo esc_url( function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) . '#veilfall' : home_url( '/shop/#veilfall' ) ); ?>" style="color:var(--plum);font-weight:700;">Find the Paperback available here!</a></p>
    <p class="txt" style="max-width:600px;">The Ebook is available on Kindle Unlimited!</p>
  </div>
</section>

<section class="sec sec--pink sec--dashed-top">
  <div class="wrap sec--center">
    <h2 class="h-md" style="color:var(--plum-deep);">Read Veilfall</h2>
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
        <p class="txt">The world-building is gorgeous.</p>
        <p class="source">— Reader review</p>
      </div>
      <div class="card review-card">
        <p class="stars">★★★★★</p>
        <p class="txt">Give me book one already!</p>
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
