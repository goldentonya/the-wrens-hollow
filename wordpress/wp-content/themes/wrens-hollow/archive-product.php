<?php
/**
 * Overrides WooCommerce's default Shop page — this is the real storefront:
 * where people come to buy. Whiskey & Secrets, Whiskey & Lies, and Veilfall
 * are real, purchasable products (real price + WooCommerce add-to-cart);
 * Veilbound is shown dimmed with a "notify me" button, since it isn't
 * purchasable yet. This is separate from the "Books" page (page-books.php),
 * which is a browsing-only library with no prices or cart.
 */
$wh_nav_active = 'shop';
get_header();

$wh_ws_id      = function_exists( 'wc_get_product_id_by_sku' ) ? wc_get_product_id_by_sku( 'whiskey-and-secrets-signed' ) : 0;
$wh_ws_product = $wh_ws_id ? wc_get_product( $wh_ws_id ) : false;

$wh_vf_id      = function_exists( 'wc_get_product_id_by_sku' ) ? wc_get_product_id_by_sku( 'veilfall-paperback' ) : 0;
$wh_vf_product = $wh_vf_id ? wc_get_product( $wh_vf_id ) : false;

$wh_wl_id      = function_exists( 'wc_get_product_id_by_sku' ) ? wc_get_product_id_by_sku( 'whiskey-and-lies-signed' ) : 0;
$wh_wl_product = $wh_wl_id ? wc_get_product( $wh_wl_id ) : false;
?>

<section class="sec sec--pink">
  <div class="wrap">
    <p class="eyebrow">The Shop</p>
    <h1 class="h-lg">Signed copies, straight from Ali</h1>
    <p class="lede" style="margin-top:12px;">Every signed copy available direct from Ali, shipped straight to you. More titles are added here as they become available — see <a href="<?php echo esc_url( home_url( '/books/' ) ); ?>" style="color:var(--plum);font-weight:700;">all the books</a> for the full catalog.</p>
  </div>
</section>

<section class="sec sec--dashed-top">
  <div class="wrap">
    <div class="grid-2">

      <div class="card product-card" id="whiskey-and-secrets">
        <div class="ph-box"><img src="<?php echo esc_url( get_template_directory_uri() . '/images/covers/whiskey-and-secrets.jpg' ); ?>" alt="Whiskey &amp; Secrets book cover" style="width:100%;height:100%;object-fit:cover;border-radius:6px;"></div>
        <p class="book-card__tag">Book 1 · Whiskey Tango Foxtrot</p>
        <h3>Whiskey &amp; Secrets</h3>
        <p class="txt">Signed paperback.</p>
        <?php if ( $wh_ws_product ) : ?>
          <div class="product-card__row">
            <span class="product-card__price"><?php echo wp_kses_post( $wh_ws_product->get_price_html() ); ?></span>
            <?php echo do_shortcode( '[add_to_cart id="' . $wh_ws_id . '" show_price="false" style=""]' ); ?>
          </div>
        <?php else : ?>
          <div class="product-card__row">
            <span class="product-card__price">$21.99</span>
            <button class="btn btn--outline btn--sm" type="button" data-notify="the Whiskey & Secrets paperback">Notify me</button>
          </div>
        <?php endif; ?>
      </div>

      <div class="card product-card" id="whiskey-and-lies">
        <div class="ph-box"><img src="<?php echo esc_url( get_template_directory_uri() . '/images/covers/whiskey-and-lies.jpg' ); ?>" alt="Whiskey &amp; Lies book cover" style="width:100%;height:100%;object-fit:cover;border-radius:6px;"></div>
        <p class="book-card__tag">Book 2 · Whiskey Tango Foxtrot</p>
        <h3>Whiskey &amp; Lies</h3>
        <p class="txt">Signed paperback.</p>
        <?php if ( $wh_wl_product ) : ?>
          <div class="product-card__row">
            <span class="product-card__price"><?php echo wp_kses_post( $wh_wl_product->get_price_html() ); ?></span>
            <?php echo do_shortcode( '[add_to_cart id="' . $wh_wl_id . '" show_price="false" style=""]' ); ?>
          </div>
        <?php else : ?>
          <div class="product-card__row">
            <span class="product-card__price">$21.99</span>
            <button class="btn btn--outline btn--sm" type="button" data-notify="Whiskey & Lies">Notify me</button>
          </div>
        <?php endif; ?>
      </div>

      <div class="card product-card" id="veilfall">
        <div class="ph-box"><img src="<?php echo esc_url( get_template_directory_uri() . '/images/covers/veilfall.jpg' ); ?>" alt="Veilfall book cover" style="width:100%;height:100%;object-fit:cover;border-radius:6px;"></div>
        <p class="book-card__tag">Book 1 · The Veiled Prophecy</p>
        <h3>Veilfall</h3>
        <p class="txt">Paperback.</p>
        <?php if ( $wh_vf_product ) : ?>
          <div class="product-card__row">
            <span class="product-card__price"><?php echo wp_kses_post( $wh_vf_product->get_price_html() ); ?></span>
            <?php echo do_shortcode( '[add_to_cart id="' . $wh_vf_id . '" show_price="false" style=""]' ); ?>
          </div>
        <?php else : ?>
          <div class="product-card__row">
            <span class="product-card__price">$19.99</span>
            <button class="btn btn--outline btn--sm" type="button" data-notify="the Veilfall paperback">Notify me</button>
          </div>
        <?php endif; ?>
      </div>

      <div class="card product-card product-card--soon" id="veilbound">
        <div class="ph-box"><img src="<?php echo esc_url( get_template_directory_uri() . '/images/covers/veilbound.jpg' ); ?>" alt="Veilbound book cover" style="width:100%;height:100%;object-fit:cover;border-radius:6px;"></div>
        <p class="book-card__tag">Book 2 · The Veiled Prophecy</p>
        <h3>Veilbound</h3>
        <p class="txt">Signed paperback.</p>
        <div class="product-card__row">
          <span class="product-card__price">Coming soon</span>
          <button class="btn btn--outline btn--sm" type="button" data-notify="Veilbound">Notify me</button>
        </div>
      </div>

    </div>
  </div>
</section>

<section class="sec sec--center sec--dashed-top">
  <div class="wrap">
    <p class="txt" style="margin:0;">Prefer your e-reader? <a href="https://www.amazon.com/s?k=ali+wren+author" target="_blank" rel="noopener" style="color:var(--plum);font-weight:700;">Find every title on Amazon →</a></p>
  </div>
</section>

<?php get_footer(); ?>
