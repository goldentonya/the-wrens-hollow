<?php
/**
 * Site-wide settings that aren't tied to one page — the social profile links and
 * the footer tagline — exposed in the WordPress Customizer (Appearance →
 * Customize → "Site details"). Stored as theme mods with the current values as
 * defaults, so nothing changes until the owner edits them.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Default social profile URLs (also the fallback when a setting is empty).
 */
function wrens_hollow_social_defaults() {
	return array(
		'facebook'  => 'https://www.facebook.com/share/18DP2c832v/',
		'instagram' => 'https://www.instagram.com/aliwrenauthor',
		'tiktok'    => 'https://www.tiktok.com/@aliwrenauthor',
		'goodreads' => 'https://www.goodreads.com/author/show/14986224.Ali_Wren',
		'amazon'    => 'https://www.amazon.com/s?k=ali+wren+author',
	);
}

/**
 * Default product SKUs the Shop page looks up (also the fallback when a
 * setting is empty). These must match the SKU actually set on the
 * corresponding WooCommerce product's Inventory tab, else that book falls
 * back to the "Notify me" placeholder card — see archive-product.php.
 */
function wrens_hollow_shop_sku_defaults() {
	return array(
		'whiskey-and-secrets' => 'whiskey-and-secrets-signed',
		'whiskey-and-lies'    => 'whiskey-and-lies-signed',
		'veilfall'            => 'veilfall-paperback',
	);
}

/**
 * A shop product's SKU: the Customizer value, else the default.
 */
function wh_shop_sku( $key ) {
	$defaults = wrens_hollow_shop_sku_defaults();
	$default  = isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
	return get_theme_mod( 'wh_sku_' . $key, $default );
}

/**
 * A social profile URL: the Customizer value, else the default.
 */
function wh_social( $key ) {
	$defaults = wrens_hollow_social_defaults();
	$default  = isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
	return get_theme_mod( 'wh_social_' . $key, $default );
}

/**
 * The footer tagline.
 */
function wh_footer_tagline() {
	return get_theme_mod( 'wh_footer_tagline', 'Fierce love. Brilliant women. Stories with heart.' );
}

function wrens_hollow_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'wh_site',
		array(
			'title'    => 'Site details (social & footer)',
			'priority' => 30,
		)
	);

	$labels = array(
		'facebook'  => 'Facebook URL',
		'instagram' => 'Instagram URL',
		'tiktok'    => 'TikTok URL',
		'goodreads' => 'Goodreads URL',
		'amazon'    => 'Amazon URL',
	);
	foreach ( wrens_hollow_social_defaults() as $key => $url ) {
		$wp_customize->add_setting(
			'wh_social_' . $key,
			array(
				'default'           => $url,
				'sanitize_callback' => 'esc_url_raw',
			)
		);
		$wp_customize->add_control(
			'wh_social_' . $key,
			array(
				'label'   => $labels[ $key ],
				'section' => 'wh_site',
				'type'    => 'url',
			)
		);
	}

	$wp_customize->add_setting(
		'wh_footer_tagline',
		array(
			'default'           => 'Fierce love. Brilliant women. Stories with heart.',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'wh_footer_tagline',
		array(
			'label'   => 'Footer tagline',
			'section' => 'wh_site',
			'type'    => 'text',
		)
	);

	/**
	 * Forms — connects the site's four placeholder forms (newsletter band,
	 * free-chapters opt-in, About page contact form, and "Notify me" buttons,
	 * which reuse the newsletter one) to a real provider. Paste a shortcode
	 * (e.g. Contact Form 7's [contact-form-7 id="123"], WPForms'
	 * [wpforms id="123"], or the Newsletter plugin's signup shortcode) or a
	 * raw embed snippet (e.g. a Klaviyo form embed <div> + script). Left
	 * blank, the theme's own placeholder form is used instead — see
	 * template-parts/newsletter-form.php, optin-form.php, contact-form.php —
	 * so the site never ships a form that silently submits nowhere.
	 */
	$wp_customize->add_section(
		'wh_forms',
		array(
			'title'       => 'Forms (mailing list & contact)',
			'priority'    => 35,
			'description' => 'Connect the newsletter, free-chapters, and contact forms to a real provider (e.g. the Newsletter/Klaviyo, Contact Form 7, or WPForms plugins already installed). Leave a field blank to keep the built-in placeholder form there.',
		)
	);

	$wh_form_fields = array(
		'newsletter' => array(
			'label'       => 'Newsletter signup — shortcode/embed',
			'description' => 'Used by every "Join the Hollow" band, the About page newsletter form, and "Notify me" release-alert buttons.',
		),
		'optin'      => array(
			'label'       => 'Free-chapters opt-in — shortcode/embed',
			'description' => 'Used by the "Read the book" form on each book page.',
		),
		'contact'    => array(
			'label'       => 'Contact form — shortcode',
			'description' => 'Used by the About page "Say hello" contact form, e.g. [contact-form-7 id="123"] or [wpforms id="123"].',
		),
	);
	foreach ( $wh_form_fields as $wh_form_key => $wh_form_meta ) {
		$wp_customize->add_setting(
			'wh_form_' . $wh_form_key,
			array(
				'default'           => '',
				'sanitize_callback' => 'wp_kses_post',
			)
		);
		$wp_customize->add_control(
			'wh_form_' . $wh_form_key,
			array(
				'label'       => $wh_form_meta['label'],
				'description' => $wh_form_meta['description'],
				'section'     => 'wh_forms',
				'type'        => 'textarea',
			)
		);
	}

	/**
	 * Shop product SKUs — lets the owner point each book at whatever SKU she
	 * actually used on the real WooCommerce product, instead of the Shop page
	 * requiring her products to match a SKU hardcoded in the theme.
	 */
	$wp_customize->add_section(
		'wh_shop_skus',
		array(
			'title'       => 'Shop (product SKUs)',
			'priority'    => 36,
			'description' => "Match each book to its real product by SKU (Products → [book] → Inventory tab → SKU in wp-admin). Leave a field as-is to keep the theme's default SKU.",
		)
	);

	$wh_sku_defaults = wrens_hollow_shop_sku_defaults();
	$wh_sku_labels   = array(
		'whiskey-and-secrets' => 'Whiskey & Secrets — SKU',
		'whiskey-and-lies'    => 'Whiskey & Lies — SKU',
		'veilfall'            => 'Veilfall — SKU',
	);
	foreach ( $wh_sku_labels as $wh_sku_key => $wh_sku_label ) {
		$wp_customize->add_setting(
			'wh_sku_' . $wh_sku_key,
			array(
				'default'           => $wh_sku_defaults[ $wh_sku_key ],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			'wh_sku_' . $wh_sku_key,
			array(
				'label'   => $wh_sku_label,
				'section' => 'wh_shop_skus',
				'type'    => 'text',
			)
		);
	}
}
add_action( 'customize_register', 'wrens_hollow_customize_register' );
