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
}
add_action( 'customize_register', 'wrens_hollow_customize_register' );
