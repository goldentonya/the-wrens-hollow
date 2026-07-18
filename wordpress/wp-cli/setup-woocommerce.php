<?php
// Run via `wp eval-file`. Idempotent: safe to run on every container start.

if ( ! function_exists( 'WC' ) ) {
	echo "WooCommerce is not active yet — skipping store setup.\n";
	return;
}

// --- Store base options -----------------------------------------------
update_option( 'woocommerce_currency', 'USD' );
update_option( 'woocommerce_currency_pos', 'left' );
update_option( 'woocommerce_default_country', 'US' );
update_option( 'woocommerce_calc_taxes', 'no' );
// Let people check out without creating an account.
update_option( 'woocommerce_enable_guest_checkout', 'yes' );

// --- Offline payment gateways (no merchant account needed) -------------
foreach ( array( 'woocommerce_cod_settings', 'woocommerce_bacs_settings' ) as $option_name ) {
	$settings = get_option( $option_name, array() );
	if ( ! is_array( $settings ) ) {
		$settings = array();
	}
	$settings['enabled'] = 'yes';
	update_option( $option_name, $settings );
}
echo "Payment gateways enabled: Cash on delivery, Direct bank transfer.\n";

// --- Classic (shortcode) Cart & Checkout --------------------------------
// WooCommerce 10.x defaults the Cart and Checkout pages to block markup, which
// renders client-side and uses .wc-block-* classes the theme doesn't style.
// The theme's stylesheet targets WooCommerce's *classic* markup, so switch
// these two pages to the classic shortcodes for an on-brand, server-rendered
// cart/checkout. Idempotent: only rewrites when the content differs.
$classic_pages = array(
	wc_get_page_id( 'cart' )     => '[woocommerce_cart]',
	wc_get_page_id( 'checkout' ) => '[woocommerce_checkout]',
);
foreach ( $classic_pages as $page_id => $shortcode ) {
	if ( $page_id > 0 ) {
		$page = get_post( $page_id );
		if ( $page && trim( $page->post_content ) !== $shortcode ) {
			wp_update_post( array(
				'ID'           => $page_id,
				'post_content' => $shortcode,
			) );
			echo "Set page {$page_id} to classic {$shortcode}.\n";
		}
	}
}

// --- Whiskey & Secrets — the one real, purchasable product --------------
$product_sku = 'whiskey-and-secrets-signed';
$existing_id = wc_get_product_id_by_sku( $product_sku );

if ( ! $existing_id ) {
	$product = new WC_Product_Simple();
	$product->set_name( 'Whiskey & Secrets — Signed Paperback' );
	$product->set_status( 'publish' );
	$product->set_catalog_visibility( 'visible' );
	$product->set_description(
		"When biological anthropology grad student Sarah agrees to lead a research expedition in the Amazon Rainforest, she never expected to need military protection — let alone from Wade \"Wraith\" Blakely, the stoic, enigmatic former Green Beret who's been assigned to keep her team safe."
	);
	$product->set_short_description( 'Signed paperback · Book 1 · Whiskey Tango Foxtrot' );
	$product->set_sku( $product_sku );
	$product->set_regular_price( '21.99' );
	$product->set_manage_stock( true );
	$product->set_stock_quantity( 25 );
	$product->set_stock_status( 'instock' );
	$product_id = $product->save();
	echo "Created product 'Whiskey & Secrets — Signed Paperback' (ID {$product_id}).\n";
} else {
	echo "Product 'Whiskey & Secrets — Signed Paperback' already exists (ID {$existing_id}).\n";
}

// --- Veilfall — signed paperback, the second real, purchasable product --
$veilfall_sku = 'veilfall-paperback';
$veilfall_existing_id = wc_get_product_id_by_sku( $veilfall_sku );

if ( ! $veilfall_existing_id ) {
	$veilfall_product = new WC_Product_Simple();
	$veilfall_product->set_name( 'Veilfall — Paperback' );
	$veilfall_product->set_status( 'publish' );
	$veilfall_product->set_catalog_visibility( 'visible' );
	$veilfall_product->set_description(
		"She was hidden in the human realm to stay safe. But magic has a way of finding what was never meant to be forgotten. Start Veralyn's story with this dark fae fantasy romance — Book 1 in the Kingdom of Sylvaeris saga."
	);
	$veilfall_product->set_short_description( 'Paperback · Book 1 · The Veiled Prophecy' );
	$veilfall_product->set_sku( $veilfall_sku );
	$veilfall_product->set_regular_price( '19.99' );
	$veilfall_product->set_manage_stock( true );
	$veilfall_product->set_stock_quantity( 25 );
	$veilfall_product->set_stock_status( 'instock' );
	$veilfall_product_id = $veilfall_product->save();
	echo "Created product 'Veilfall — Paperback' (ID {$veilfall_product_id}).\n";
} else {
	echo "Product 'Veilfall — Paperback' already exists (ID {$veilfall_existing_id}).\n";
}

// --- Whiskey & Lies — signed paperback, third real, purchasable product -
$wl_sku = 'whiskey-and-lies-signed';
$wl_existing_id = wc_get_product_id_by_sku( $wl_sku );

if ( ! $wl_existing_id ) {
	$wl_product = new WC_Product_Simple();
	$wl_product->set_name( 'Whiskey & Lies — Signed Paperback' );
	$wl_product->set_status( 'publish' );
	$wl_product->set_catalog_visibility( 'visible' );
	$wl_product->set_description(
		"Every relationship has a few secrets. Hers might be unforgivable. Book 2 in the Whiskey Tango Foxtrot series — signed paperback."
	);
	$wl_product->set_short_description( 'Signed paperback · Book 2 · Whiskey Tango Foxtrot' );
	$wl_product->set_sku( $wl_sku );
	$wl_product->set_regular_price( '21.99' );
	$wl_product->set_manage_stock( true );
	$wl_product->set_stock_quantity( 25 );
	$wl_product->set_stock_status( 'instock' );
	$wl_product_id = $wl_product->save();
	echo "Created product 'Whiskey & Lies — Signed Paperback' (ID {$wl_product_id}).\n";
} else {
	echo "Product 'Whiskey & Lies — Signed Paperback' already exists (ID {$wl_existing_id}).\n";
}

// --- Flat-rate shipping on the built-in "Rest of the World" zone --------
// Zone 0 is WooCommerce's catch-all: it matches every address not covered by
// another zone. Since we define no other zones, attaching a flat rate here
// guarantees a shipping option is offered to every customer, so checkout of a
// physical product is never blocked by "no shipping methods available".
if ( class_exists( 'WC_Shipping_Zone' ) ) {
	$zone = new WC_Shipping_Zone( 0 );

	$has_flat_rate = false;
	foreach ( $zone->get_shipping_methods() as $method ) {
		if ( 'flat_rate' === $method->id ) {
			$has_flat_rate = true;
			break;
		}
	}

	if ( ! $has_flat_rate ) {
		$instance_id = $zone->add_shipping_method( 'flat_rate' );

		$option_name = "woocommerce_flat_rate_{$instance_id}_settings";
		$flat_rate_settings = get_option( $option_name, array() );
		$flat_rate_settings['title'] = 'Flat rate shipping';
		$flat_rate_settings['cost']  = '4.50';
		update_option( $option_name, $flat_rate_settings );

		echo "Added a \$4.50 flat rate to the 'Rest of the World' shipping zone.\n";
	} else {
		echo "Flat-rate shipping already configured.\n";
	}
}
