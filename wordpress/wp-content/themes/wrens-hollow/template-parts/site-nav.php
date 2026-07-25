<?php
/**
 * The <nav class="nav__links"> content: the "Primary navigation" menu
 * (Appearance > Menus), rendered via Wrens_Hollow_Walker to reproduce the exact
 * theme markup. This is the collapsible mobile drawer — the cart icon lives
 * outside of it (in .nav__actions, next to the hamburger) since it needs to
 * stay visible whether or not the drawer is open, not collapse with the rest
 * of the menu. $wh_nav_active is set by header.php before this part is
 * included.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
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
</nav>
