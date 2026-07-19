<?php
/**
 * Template Name: Whiskey & Lies
 */
$wh_nav_active = 'wtf';
get_header();

$wh_product_id = function_exists( 'wc_get_product_id_by_sku' ) ? wc_get_product_id_by_sku( 'whiskey-and-lies-signed' ) : 0;
$wh_product    = $wh_product_id ? wc_get_product( $wh_product_id ) : false;

$wh_book    = function_exists( 'wh_book' ) ? wh_book( 'whiskey-and-lies' ) : null;
$wh_book_id = $wh_book ? $wh_book->ID : false;
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
    <h1 class="h-lg" style="color:#fff;"><?php echo esc_html( $wh_book ? get_the_title( $wh_book ) : 'Whiskey & Lies' ); ?></h1>
    <p class="lede" style="margin:14px auto 0;"><?php wh_the( 'hero_lede', 'Every relationship has a few secrets. Hers might be unforgivable.', $wh_book_id ); ?></p>
  </div>
</section>

<section class="sec sec--pink">
  <div class="wrap hero">
    <div class="wh-fade">
      <p class="book-card__tag"><?php wh_the( 'hero_tag', 'Book 2 · Available now', $wh_book_id ); ?></p>
      <p class="txt"><?php wh_the( 'hero_blurb', "The Whiskey Tango Foxtrot series continues — more sharp banter, more real heartbreak, and a heroine who still won't back down. Whiskey & Lies includes bonus chapters for readers who finish the book.", $wh_book_id ); ?></p>
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
      <div class="ph-box"><img src="<?php echo esc_url( $wh_book ? wh_book_cover( $wh_book ) : get_template_directory_uri() . '/images/covers/whiskey-and-lies.jpg' ); ?>" alt="<?php echo esc_attr( $wh_book ? get_the_title( $wh_book ) : 'Whiskey & Lies' ); ?> book cover" style="width:100%;height:100%;object-fit:cover;border-radius:4px;"></div>
    </div>
  </div>
</section>

<section class="sec sec--cream sec--dashed-top">
  <div class="wrap book-about">
    <p class="eyebrow">About the book</p>
    <h2 class="h-md"><?php echo esc_html( $wh_book ? get_the_title( $wh_book ) : 'Whiskey & Lies' ); ?></h2>
    <div class="book-about__body" style="max-width:600px;">
      <?php wh_wysiwyg( 'about_body', '', $wh_book_id ); ?>
    </div>
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
