<?php
/**
 * The Wren's Hollow theme functions.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function wrens_hollow_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'wrens_hollow_setup' );

function wrens_hollow_assets() {
	wp_enqueue_style(
		'wrens-hollow-fonts',
		'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Mulish:wght@400;600;700;800&family=Alex+Brush&display=swap',
		array(),
		null
	);
	wp_enqueue_style( 'wrens-hollow-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );
	wp_enqueue_script( 'wrens-hollow-main', get_template_directory_uri() . '/js/main.js', array(), wp_get_theme()->get( 'Version' ), true );

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
	$fragments['#cartCount'] = '<span class="nav__cart-count" id="cartCount">' . intval( $count ) . '</span>';
	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'wrens_hollow_cart_count_fragment' );

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
