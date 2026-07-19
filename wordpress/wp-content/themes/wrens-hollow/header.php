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

$wh_cart_count = ( function_exists( 'WC' ) && WC()->cart ) ? WC()->cart->get_cart_contents_count() : 0;
$wh_cart_url   = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : home_url( '/' );

function wh_nav_class( $key, $current ) {
	return 'nav__link' . ( $key === $current ? ' is-active' : '' );
}

$wh_books_active = in_array( $wh_nav_active, array( 'books', 'read-free', 'wtf' ), true );
?>
<!DOCTYPE html>
<html lang="en" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<a class="skip-link" href="#main">Skip to content</a>

<header class="site-header">
  <div class="wrap nav">
    <a class="nav__brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
      <span class="nav__mark">AW</span>
      <span class="nav__word">
        <span class="nav__title">THE WREN'S HOLLOW</span>
        <span class="nav__sub">Ali Wren · Author</span>
      </span>
    </a>
    <button class="nav__toggle" id="navToggle" aria-expanded="false" aria-controls="navLinks" aria-label="Toggle menu">
      <span></span><span></span><span></span>
    </button>
    <nav class="nav__links" id="navLinks">
      <a class="<?php echo esc_attr( wh_nav_class( 'home', $wh_nav_active ) ); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
      <div class="nav__dropdown">
        <a class="nav__link nav__link--has-chevron<?php echo $wh_books_active ? ' is-active' : ''; ?>" href="<?php echo esc_url( home_url( '/books/' ) ); ?>">
          Books
          <svg class="nav__dropdown-chevron" viewBox="0 0 10 6" aria-hidden="true"><path d="M1 1l4 4 4-4" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
        <div class="nav__dropdown-menu">
          <div class="nav__dropdown-menu-inner">
            <a class="nav__dropdown-link<?php echo 'read-free' === $wh_nav_active ? ' is-active' : ''; ?>" href="<?php echo esc_url( home_url( '/the-veiled-prophecy/' ) ); ?>">
              <span class="nav__dropdown-link-title">The Veiled Prophecy</span>
              <span class="nav__dropdown-link-sub">Fantasy · Kingdom of Sylvaeris</span>
            </a>
            <a class="nav__dropdown-link<?php echo 'wtf' === $wh_nav_active ? ' is-active' : ''; ?>" href="<?php echo esc_url( home_url( '/whiskey-tango-foxtrot/' ) ); ?>">
              <span class="nav__dropdown-link-title">Whiskey Tango Foxtrot</span>
              <span class="nav__dropdown-link-sub">Contemporary romance</span>
            </a>
          </div>
        </div>
      </div>
      <a class="<?php echo esc_attr( wh_nav_class( 'shop', $wh_nav_active ) ); ?>" href="<?php echo esc_url( function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' ) ); ?>">Shop</a>
      <a class="<?php echo esc_attr( wh_nav_class( 'about', $wh_nav_active ) ); ?>" href="<?php echo esc_url( home_url( '/about/' ) ); ?>">About</a>
      <a class="<?php echo esc_attr( wh_nav_class( 'horizon', $wh_nav_active ) ); ?>" href="<?php echo esc_url( home_url( '/on-the-horizon/' ) ); ?>">On the Horizon</a>
      <a class="<?php echo esc_attr( wh_nav_class( 'events', $wh_nav_active ) ); ?>" href="<?php echo esc_url( home_url( '/events-appearances/' ) ); ?>">Events</a>
      <a class="nav__link nav__cart" href="<?php echo esc_url( $wh_cart_url ); ?>" aria-label="Cart">🛒<span class="nav__cart-count" id="cartCount"><?php echo intval( $wh_cart_count ); ?></span></a>
    </nav>
  </div>
</header>

<main id="main">
