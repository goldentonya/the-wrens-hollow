<?php
/**
 * Overrides WooCommerce's default Shop page — this is the real storefront:
 * where people come to buy. Whiskey & Secrets, Whiskey & Lies, and Veilfall
 * are real, purchasable products (real price + WooCommerce add-to-cart);
 * Veilbound is shown dimmed with a "notify me" button, since it isn't
 * purchasable yet. This is separate from the "Books" page (page-books.php),
 * which is a browsing-only library with no prices or cart.
 *
 * Any other published product (merch, bundles, anything not one of the three
 * books above) is appended after Veilbound via a normal WooCommerce query —
 * otherwise a non-book product would never appear here at all, since the
 * cards above are matched by SKU rather than a real product loop.
 *
 * The SKU each book is matched against is owner-editable (Customize > Shop
 * (product SKUs)) via wh_shop_sku(), rather than requiring her WooCommerce
 * product to match a SKU hardcoded in the theme — see inc/customizer.php.
 */
$wh_nav_active = 'shop';
get_header();

$wh_ws_id      = function_exists( 'wc_get_product_id_by_sku' ) ? wc_get_product_id_by_sku( wh_shop_sku( 'whiskey-and-secrets' ) ) : 0;
$wh_ws_product = $wh_ws_id ? wc_get_product( $wh_ws_id ) : false;

$wh_vf_id      = function_exists( 'wc_get_product_id_by_sku' ) ? wc_get_product_id_by_sku( wh_shop_sku( 'veilfall' ) ) : 0;
$wh_vf_product = $wh_vf_id ? wc_get_product( $wh_vf_id ) : false;

$wh_wl_id      = function_exists( 'wc_get_product_id_by_sku' ) ? wc_get_product_id_by_sku( wh_shop_sku( 'whiskey-and-lies' ) ) : 0;
$wh_wl_product = $wh_wl_id ? wc_get_product( $wh_wl_id ) : false;

// Veilbound isn't purchasable yet, so there's no WooCommerce product for it —
// but it may still have a Book entry (with its own featured image). Resolve
// its cover the same way the book detail pages / reading-order cards do
// (wh_book_cover()), instead of hardcoding the static asset path, so an
// owner-uploaded cover shows up here too and a missing one degrades to the
// same styled placeholder as everywhere else.
$wh_vb_book  = function_exists( 'wh_book' ) ? wh_book( 'veilbound' ) : null;
$wh_vb_cover = $wh_vb_book ? wh_book_cover( $wh_vb_book ) : get_template_directory_uri() . '/images/covers/veilbound.jpg';
?>

<section class="sec sec--pink">
  <div class="wrap">
    <p class="eyebrow">The Shop</p>
    <h1 class="h-lg">Signed copies, straight from Ali</h1>
    <p class="lede" style="margin-top:12px;">Every signed copy available direct from Ali, shipped straight to you. More titles are added here as they become available.</p>
  </div>
</section>

<section class="sec sec--dashed-top">
  <div class="wrap">
    <div class="shop-grid">

      <div class="card product-card" id="whiskey-and-secrets">
        <?php if ( $wh_ws_id ) : ?><a href="<?php echo esc_url( get_permalink( $wh_ws_id ) ); ?>"><?php endif; ?>
        <div class="ph-box"><img src="<?php echo esc_url( get_template_directory_uri() . '/images/covers/whiskey-and-secrets.jpg' ); ?>" alt="Whiskey &amp; Secrets book cover" style="width:100%;height:100%;object-fit:cover;border-radius:6px;"></div>
        <?php if ( $wh_ws_id ) : ?></a><?php endif; ?>
        <div class="product-card__body">
          <p class="book-card__tag">Book 1 · Whiskey Tango Foxtrot</p>
          <h3><?php if ( $wh_ws_id ) : ?><a href="<?php echo esc_url( get_permalink( $wh_ws_id ) ); ?>"><?php endif; ?>Whiskey &amp; Secrets<?php if ( $wh_ws_id ) : ?></a><?php endif; ?></h3>
          <p class="txt">Signed paperback.</p>
        </div>
        <div class="product-card__row">
          <?php if ( $wh_ws_product ) : ?>
            <span class="product-card__price"><?php echo wp_kses_post( $wh_ws_product->get_price_html() ); ?></span>
            <?php echo do_shortcode( '[add_to_cart id="' . $wh_ws_id . '" show_price="false" style=""]' ); ?>
          <?php else : ?>
            <span class="product-card__price">$21.99</span>
            <button class="btn btn--outline btn--sm" type="button" data-notify="the Whiskey & Secrets paperback">Notify me</button>
          <?php endif; ?>
        </div>
      </div>

      <div class="card product-card" id="whiskey-and-lies">
        <?php if ( $wh_wl_id ) : ?><a href="<?php echo esc_url( get_permalink( $wh_wl_id ) ); ?>"><?php endif; ?>
        <div class="ph-box"><img src="<?php echo esc_url( get_template_directory_uri() . '/images/covers/whiskey-and-lies.jpg' ); ?>" alt="Whiskey &amp; Lies book cover" style="width:100%;height:100%;object-fit:cover;border-radius:6px;"></div>
        <?php if ( $wh_wl_id ) : ?></a><?php endif; ?>
        <div class="product-card__body">
          <p class="book-card__tag">Book 2 · Whiskey Tango Foxtrot</p>
          <h3><?php if ( $wh_wl_id ) : ?><a href="<?php echo esc_url( get_permalink( $wh_wl_id ) ); ?>"><?php endif; ?>Whiskey &amp; Lies<?php if ( $wh_wl_id ) : ?></a><?php endif; ?></h3>
          <p class="txt">Signed paperback.</p>
        </div>
        <div class="product-card__row">
          <?php if ( $wh_wl_product ) : ?>
            <span class="product-card__price"><?php echo wp_kses_post( $wh_wl_product->get_price_html() ); ?></span>
            <?php echo do_shortcode( '[add_to_cart id="' . $wh_wl_id . '" show_price="false" style=""]' ); ?>
          <?php else : ?>
            <span class="product-card__price">$21.99</span>
            <button class="btn btn--outline btn--sm" type="button" data-notify="Whiskey & Lies">Notify me</button>
          <?php endif; ?>
        </div>
      </div>

      <div class="card product-card" id="veilfall">
        <?php if ( $wh_vf_id ) : ?><a href="<?php echo esc_url( get_permalink( $wh_vf_id ) ); ?>"><?php endif; ?>
        <div class="ph-box"><img src="<?php echo esc_url( get_template_directory_uri() . '/images/covers/veilfall.jpg' ); ?>" alt="Veilfall book cover" style="width:100%;height:100%;object-fit:cover;object-position:top;border-radius:6px;"></div>
        <?php if ( $wh_vf_id ) : ?></a><?php endif; ?>
        <div class="product-card__body">
          <p class="book-card__tag">Book 1 · The Veiled Prophecy</p>
          <h3><?php if ( $wh_vf_id ) : ?><a href="<?php echo esc_url( get_permalink( $wh_vf_id ) ); ?>"><?php endif; ?>Veilfall<?php if ( $wh_vf_id ) : ?></a><?php endif; ?></h3>
          <p class="txt">Paperback.</p>
        </div>
        <div class="product-card__row">
          <?php if ( $wh_vf_product ) : ?>
            <span class="product-card__price"><?php echo wp_kses_post( $wh_vf_product->get_price_html() ); ?></span>
            <?php echo do_shortcode( '[add_to_cart id="' . $wh_vf_id . '" show_price="false" style=""]' ); ?>
          <?php else : ?>
            <span class="product-card__price">$19.99</span>
            <button class="btn btn--outline btn--sm" type="button" data-notify="the Veilfall paperback">Notify me</button>
          <?php endif; ?>
        </div>
      </div>

      <div class="card product-card product-card--soon" id="veilbound">
        <div class="ph-box"><img src="<?php echo esc_url( $wh_vb_cover ); ?>" alt="Veilbound book cover" style="width:100%;height:100%;object-fit:cover;border-radius:6px;"></div>
        <div class="product-card__body">
          <p class="book-card__tag">Book 2 · The Veiled Prophecy</p>
          <h3>Veilbound</h3>
          <p class="txt">Signed paperback.</p>
        </div>
        <div class="product-card__row">
          <span class="product-card__price">Coming soon</span>
          <button class="btn btn--outline btn--sm" type="button" data-notify="Veilbound">Notify me</button>
        </div>
      </div>

      <?php
      $wh_shop_known_ids     = array_filter( array( $wh_ws_id, $wh_vf_id, $wh_wl_id ) );
      $wh_shop_extra_products = function_exists( 'wc_get_products' ) ? wc_get_products(
        array(
          'status'  => 'publish',
          'limit'   => -1,
          'orderby' => 'menu_order title',
          'exclude' => $wh_shop_known_ids,
        )
      ) : array();
      foreach ( $wh_shop_extra_products as $wh_extra_product ) :
        $wh_extra_id = $wh_extra_product->get_id();
        ?>
        <div class="card product-card" id="product-<?php echo esc_attr( $wh_extra_id ); ?>">
          <a href="<?php echo esc_url( get_permalink( $wh_extra_id ) ); ?>">
            <div class="ph-box"><?php echo wp_kses_post( $wh_extra_product->get_image( 'woocommerce_thumbnail', array( 'style' => 'width:100%;height:100%;object-fit:cover;border-radius:6px;' ) ) ); ?></div>
          </a>
          <div class="product-card__body">
            <h3><a href="<?php echo esc_url( get_permalink( $wh_extra_id ) ); ?>"><?php echo esc_html( $wh_extra_product->get_name() ); ?></a></h3>
          </div>
          <div class="product-card__row">
            <span class="product-card__price"><?php echo wp_kses_post( $wh_extra_product->get_price_html() ); ?></span>
            <?php echo do_shortcode( '[add_to_cart id="' . $wh_extra_id . '" show_price="false" style=""]' ); ?>
          </div>
        </div>
      <?php endforeach; ?>

    </div>
  </div>
</section>

<section class="sec sec--center sec--dashed-top">
  <div class="wrap">
    <p class="txt" style="margin:0;">Prefer your e-reader? <a href="https://www.amazon.com/s?k=ali+wren+author" target="_blank" rel="noopener" style="color:var(--plum);font-weight:700;">Find every title on Amazon →</a></p>
  </div>
</section>

<?php get_footer(); ?>
