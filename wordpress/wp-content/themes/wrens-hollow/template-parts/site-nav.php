<?php
/**
 * The <nav class="nav__links"> content: the "Primary navigation" menu
 * (Appearance > Menus), rendered via Wrens_Hollow_Walker to reproduce the exact
 * theme markup, plus the cart icon (kept out of the menu — it's live app state,
 * not editable content). $wh_nav_active/$wh_cart_count/$wh_cart_url are set by
 * header.php before this part is included.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $wh_cart_count, $wh_cart_url;
?>
<nav class="nav__links" id="navLinks">
  <?php
  wp_nav_menu(
  	array(
  		'theme_location' => 'primary',
  		'container'      => false,
  		'items_wrap'     => '%3$s',
  		'walker'         => new Wrens_Hollow_Walker(),
  		'fallback_cb'    => 'wrens_hollow_nav_fallback',
  	)
  );
  ?>
  <a class="nav__link nav__cart" href="<?php echo esc_url( $wh_cart_url ); ?>" aria-label="Cart">🛒<span class="nav__cart-count<?php echo $wh_cart_count > 0 ? '' : ' is-empty'; ?>" id="cartCount"><?php echo intval( $wh_cart_count ); ?></span></a>
</nav>
