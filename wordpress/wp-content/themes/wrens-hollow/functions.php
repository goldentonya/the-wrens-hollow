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
	// filemtime() (not the static theme header Version) so every edit during
	// development busts browsers' cached copy of these files automatically.
	wp_enqueue_style( 'wrens-hollow-style', get_stylesheet_uri(), array(), filemtime( get_stylesheet_directory() . '/style.css' ) );
	wp_enqueue_script( 'wrens-hollow-main', get_template_directory_uri() . '/js/main.js', array(), filemtime( get_template_directory() . '/js/main.js' ), true );

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
