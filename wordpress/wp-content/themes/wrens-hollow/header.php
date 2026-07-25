<?php
/**
 * Shared header/nav. Templates set $wh_nav_active before calling get_header()
 * to one of: 'home' | 'books' | 'shop' | 'about' | 'horizon' | 'events' | 'read-free' | 'wtf' | '' (none).
 * 'read-free' and 'wtf' are the two series (The Veiled Prophecy and Whiskey
 * Tango Foxtrot) — both they and their individual book pages count as "Books"
 * for nav-highlighting purposes, and appear as a hover flyout under "Books".
 */
// header.php is require()'d from inside load_template(), a function — so the
// $wh_nav_active global each page template sets (at the top-level/global scope
// WordPress executes page templates in) isn't automatically in scope here
// without this explicit pull-in.
global $wh_nav_active;
if ( ! isset( $wh_nav_active ) ) {
	$wh_nav_active = '';
}

// header.php and template-parts/site-nav.php are each require()'d inside
// load_template() (a function), so these need an explicit `global` here too
// (same reason as $wh_nav_active above) — otherwise site-nav.php's own
// `global $wh_cart_count, $wh_cart_url;` sees unset variables and the cart
// icon/badge render as empty/zero regardless of the real cart state.
global $wh_cart_count, $wh_cart_url;
$wh_cart_count = ( function_exists( 'WC' ) && WC()->cart ) ? WC()->cart->get_cart_contents_count() : 0;
$wh_cart_url   = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : home_url( '/' );
?>
<!DOCTYPE html>
<html lang="en" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#main">Skip to content</a>

<header class="site-header">
  <div class="wrap nav">
    <a class="nav__brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
      <img class="nav__logo" src="<?php echo esc_url( wh_logo_url() ); ?>" alt="Ali Wren logo" width="700" height="290">
    </a>
    <a class="nav__word" href="<?php echo esc_url( home_url( '/' ) ); ?>">
      <span class="nav__title">THE WREN'S HOLLOW</span>
      <span class="nav__sub">Ali Wren · Author</span>
    </a>
    <div class="nav__right">
      <?php get_template_part( 'template-parts/site-nav' ); ?>
      <div class="nav__actions">
        <a class="nav__link nav__cart" href="<?php echo esc_url( $wh_cart_url ); ?>" aria-label="Cart">🛒<span class="nav__cart-count<?php echo $wh_cart_count > 0 ? '' : ' is-empty'; ?>" id="cartCount"><?php echo intval( $wh_cart_count ); ?></span></a>
        <button class="nav__toggle" id="navToggle" aria-expanded="false" aria-controls="navLinks" aria-label="Toggle menu">
          <span></span><span></span><span></span>
        </button>
      </div>
    </div>
  </div>
</header>

<main id="main">
