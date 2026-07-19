<?php
/**
 * Template Name: Whiskey & Lies
 */
$wh_nav_active = 'wtf';
get_header();

$wh_product_id = function_exists( 'wc_get_product_id_by_sku' ) ? wc_get_product_id_by_sku( 'whiskey-and-lies-signed' ) : 0;
$wh_product    = $wh_product_id ? wc_get_product( $wh_product_id ) : false;
?>

<section class="sec--dark2 series-header">
  <?php
  wh_breadcrumbs(
  	array(
  		array( 'label' => 'Books', 'url' => home_url( '/books/' ) ),
  		array( 'label' => 'Whiskey Tango Foxtrot', 'url' => home_url( '/whiskey-tango-foxtrot/' ) ),
  		array( 'label' => 'Whiskey & Lies' ),
  	)
  );
  ?>
  <div class="wrap" style="max-width:560px;">
    <p class="eyebrow eyebrow--on-dark">Whiskey Tango Foxtrot · Book 2</p>
    <h1 class="h-lg" style="color:#fff;">Whiskey &amp; Lies</h1>
    <p class="lede" style="margin:14px auto 0;">Every relationship has a few secrets. Hers might be unforgivable.</p>
  </div>
</section>

<section class="sec sec--pink">
  <div class="wrap hero">
    <div class="wh-fade">
      <p class="book-card__tag">Book 2 · Available now</p>
      <p class="txt">The Whiskey Tango Foxtrot series continues — more sharp banter, more real heartbreak, and a heroine who still won't back down. Whiskey &amp; Lies includes bonus chapters for readers who finish the book.</p>
      <div class="product-card__row" id="buy" style="justify-content:flex-start;gap:16px;margin-top:20px;">
        <?php if ( $wh_product ) : ?>
          <span class="product-card__price"><?php echo wp_kses_post( $wh_product->get_price_html() ); ?> · Signed paperback</span>
          <?php echo do_shortcode( '[add_to_cart id="' . $wh_product_id . '" show_price="false" style=""]' ); ?>
        <?php else : ?>
          <span class="product-card__price">$21.99 · Signed paperback</span>
          <button class="btn btn--outline" type="button" data-notify="the Whiskey & Lies paperback">Notify me when available</button>
        <?php endif; ?>
      </div>
    </div>
    <div class="hero__cover wh-fade" style="--delay:.1s">
      <div class="ph-box"><img src="<?php echo esc_url( get_template_directory_uri() . '/images/covers/whiskey-and-lies.jpg' ); ?>" alt="Whiskey &amp; Lies book cover" style="width:100%;height:100%;object-fit:cover;border-radius:4px;"></div>
    </div>
  </div>
</section>

<section class="sec sec--cream sec--dashed-top">
  <div class="wrap book-about">
    <p class="eyebrow">About the book</p>
    <h2 class="h-md">Whiskey &amp; Lies</h2>
    <p class="txt" style="max-width:600px;">Jake ‘Glitch’ Thompson came home from the military with more scars than he admits—some you can see, and some you can’t. Drifting between ghosts of old missions, his old life and a future he’s not sure he deserves, the only thing keeping him grounded is the woman who stole his heart.</p>
    <p class="txt" style="max-width:600px;">Fallon Moore has always been the steady one—sharp, loyal, and burning with a quiet strength that’s carried her through hell. She swore she’d never let love make her weak, but Jake seems to be her exception. And when Jake does something to chase her away, the pull between them is impossible to ignore.</p>
    <p class="txt" style="max-width:600px;">But their second chance doesn’t come easy. Shadows from Fallon’s past and the people who want to exploit them, close in fast. Jake isn’t just fighting for the man he loves; he’s fighting for the life they could have together.</p>
    <p class="txt" style="max-width:600px;">With bullets flying and secrets unraveling, Jake will have to decide if he can fight through her ghosts… and will risk everything to prove that home isn’t a place. It’s the person you’d burn the world for.</p>
    <p class="txt" style="max-width:600px;font-style:italic;">A gripping romance of loyalty, danger, and the kind of love that survives the wreckage.</p>
    <p class="txt" style="max-width:600px;margin-top:20px;"><a href="<?php echo esc_url( function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) . '#whiskey-and-lies' : home_url( '/shop/#whiskey-and-lies' ) ); ?>" style="color:var(--plum);font-weight:700;">Find the paperback available here →</a></p>
    <p class="txt" style="max-width:600px;font-weight:700;color:var(--plum-deep);">Available: May 28, 2026</p>
    <p class="txt" style="max-width:600px;">The Ebook will be available on Kindle Unlimited!</p>
  </div>
</section>

<section class="sec sec--pink sec--dashed-top">
  <div class="wrap sec--center">
    <h2 class="h-md" style="color:var(--plum-deep);">Read Whiskey &amp; Lies</h2>
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
    <p class="txt" style="max-width:440px;margin:0 auto;">Reviews will show up here once Whiskey &amp; Lies is out in the world — check back after release!</p>
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
