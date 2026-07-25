<?php
/**
 * The Wren's Hollow theme functions.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Editable-content layer: custom post types (Events/Reviews/Books), ACF field
 * definitions, and the template render helpers that read them (with the current
 * hardcoded copy as a fallback so nothing goes blank).
 */
require get_template_directory() . '/inc/post-types.php';
require get_template_directory() . '/inc/acf-fields.php';
require get_template_directory() . '/inc/acf-page-fields.php';
require get_template_directory() . '/inc/template-helpers.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/nav-walker.php';
require get_template_directory() . '/inc/admin-links.php';
require get_template_directory() . '/inc/inline-repeaters.php';
require get_template_directory() . '/inc/about-page-editor.php';
require get_template_directory() . '/inc/seo.php';

function wrens_hollow_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	// Standard theme scaffolding.
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
	);
	add_theme_support( 'responsive-embeds' );
	// The header/footer logo mark keeps its exact markup and CSS classes
	// (see wh_logo_url() in inc/template-helpers.php); this just lets the owner
	// replace the image itself via Appearance > Customize > Site Identity.
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 290,
			'width'       => 700,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	register_nav_menus(
		array(
			'primary' => 'Primary navigation',
			'footer'  => 'Footer links',
		)
	);

	// Matches the site's fixed content column (see .wrap max-width in style.css).
	if ( ! isset( $GLOBALS['content_width'] ) ) {
		$GLOBALS['content_width'] = 1080;
	}
}
add_action( 'after_setup_theme', 'wrens_hollow_setup' );

function wrens_hollow_assets() {
	// Cormorant Garamond, Mulish, and Alex Brush are self-hosted (see /fonts
	// and the @font-face rules at the top of style.css) rather than loaded
	// from fonts.googleapis.com — avoids a render-blocking third-party
	// request and the associated GDPR consideration, no separate enqueue
	// needed since they're declared in the stylesheet itself.

	// filemtime() (not the static theme header Version) so every edit during
	// development busts browsers' cached copy of these files automatically.
	wp_enqueue_style( 'wrens-hollow-style', get_stylesheet_uri(), array(), filemtime( get_stylesheet_directory() . '/style.css' ) );
	wp_enqueue_script( 'wrens-hollow-main', get_template_directory_uri() . '/js/main.js', array(), filemtime( get_template_directory() . '/js/main.js' ), true );

	// "Notify me" release-alert buttons (js/main.js, [data-notify]) inject a
	// signup form on click. If a real newsletter provider is configured
	// (Customize > Forms), hand its already-rendered markup to the script so
	// those buttons reuse the same real form instead of faking one.
	$wh_notify_html = '';
	if ( function_exists( 'wh_form_shortcode' ) ) {
		$wh_notify_shortcode = wh_form_shortcode( 'newsletter' );
		if ( $wh_notify_shortcode ) {
			$wh_notify_html = do_shortcode( $wh_notify_shortcode );
		}
	}
	wp_localize_script( 'wrens-hollow-main', 'wrensHollowForms', array( 'notifyFormHtml' => $wh_notify_html ) );

	// The book detail pages and the Shop page use the [add_to_cart] shortcode on
	// what WordPress considers ordinary pages, where WooCommerce doesn't enqueue
	// its AJAX add-to-cart script by default. Loading it here makes those buttons
	// add to the cart without a full page reload and keeps the nav 🛒 count live.
	if ( function_exists( 'WC' ) ) {
		wp_enqueue_script( 'wc-add-to-cart' );
	}
}
add_action( 'wp_enqueue_scripts', 'wrens_hollow_assets' );

/**
 * Keep the nav cart badge (#cartCount) in sync after AJAX add-to-cart,
 * without a full page reload. header.php prints the real server-side
 * count on every page load already.
 */
function wrens_hollow_cart_count_fragment( $fragments ) {
	$count = ( function_exists( 'WC' ) && WC()->cart ) ? WC()->cart->get_cart_contents_count() : 0;
	$class = 'nav__cart-count' . ( $count > 0 ? '' : ' is-empty' );
	$fragments['#cartCount'] = '<span class="' . esc_attr( $class ) . '" id="cartCount">' . intval( $count ) . '</span>';
	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'wrens_hollow_cart_count_fragment' );

/**
 * Shortens the cart page's "Apply coupon" button to just "Apply" — long
 * enough to force-wrap onto its own line below the coupon field at mobile
 * widths (see .woocommerce-cart .coupon in style.css, which lays the button
 * out to the input's left). Scoped to is_cart() so checkout's coupon form
 * (same core string) keeps the fuller "Apply coupon" label.
 */
function wrens_hollow_shorten_apply_coupon_text( $translation, $text, $domain ) {
	if ( 'woocommerce' === $domain && 'Apply coupon' === $text && function_exists( 'is_cart' ) && is_cart() ) {
		return 'Apply';
	}
	return $translation;
}
add_filter( 'gettext', 'wrens_hollow_shorten_apply_coupon_text', 10, 3 );

/**
 * Renders the breadcrumb trail used at the top of subpages (book pages,
 * series pages, shop product pages, etc.) so readers can navigate back up
 * the site hierarchy. Home is prepended automatically; pass the remaining
 * trail as an array of ['label' => string, 'url' => string|null] — omit
 * 'url' (or leave it null/empty) on the last, current-page item.
 *
 * $variant controls the chip's coloring: 'dark' (default) is a dark
 * translucent pill for overlaying photo/dark hero sections; 'light' is a
 * pale pill (matching the site's .chip filter pills) for light sections
 * like the product page's pink hero, where the dark pill reads as a stray
 * UI element rather than part of the design.
 */
function wh_breadcrumbs( array $trail, $variant = 'dark' ) {
	$items   = array_merge( array( array( 'label' => 'Home', 'url' => home_url( '/' ) ) ), $trail );
	$last    = count( $items ) - 1;
	$class   = 'breadcrumbs' . ( 'light' === $variant ? ' breadcrumbs--light' : '' );
	$out     = '<nav class="' . esc_attr( $class ) . '" aria-label="Breadcrumb"><div class="wrap"><ol class="breadcrumbs__list">';

	foreach ( $items as $i => $item ) {
		$is_current = ( $i === $last ) || empty( $item['url'] );
		$out       .= '<li' . ( $is_current ? ' aria-current="page"' : '' ) . '>';
		$out       .= $is_current
			? esc_html( $item['label'] )
			: '<a href="' . esc_url( $item['url'] ) . '">' . esc_html( $item['label'] ) . '</a>';
		$out       .= '</li>';
	}

	$out .= '</ol></div></nav>';
	echo $out; // phpcs:ignore WordPress.Security.EscapeOutput -- each piece already escaped above.
}

/**
 * WooCommerce templates in this theme live directly under /woocommerce
 * (the path WooCommerce looks for by default), so no extra wiring needed
 * beyond add_theme_support('woocommerce') above.
 */

/**
 * single-product.php's related-products section reuses WooCommerce's own
 * output — show up to 3 in a single row to match the rest of the storefront.
 */
function wrens_hollow_related_products_args( $args ) {
	$args['posts_per_page'] = 3;
	$args['columns']        = 3;
	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'wrens_hollow_related_products_args' );
