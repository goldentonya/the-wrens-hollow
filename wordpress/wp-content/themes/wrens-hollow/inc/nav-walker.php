<?php
/**
 * Custom nav walker that renders the "Primary navigation" WP menu (Appearance >
 * Menus) into the theme's exact hand-coded nav markup — including the "Books"
 * dropdown flyout with its two-line sub-labels — so the design is unchanged
 * whether the owner reorders, renames, or adds menu items.
 *
 * Expected menu shape (auto-created by wp-cli/init.sh, freely editable after):
 *   Home, Books (with 2 child items: the two series, each with a Description
 *   used as its sub-label), About, Shop, On the Horizon, Events.
 * The cart icon is NOT a menu item — it stays hardcoded in
 * template-parts/site-nav.php since it's live application state, not content.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Maps a nav URL's path to the $wh_nav_active key it corresponds to, so the
 * Walker can highlight the right item(s) using the same signal the page
 * templates already set — including lighting up "Books" (and, for the series
 * pages, "Books" + that series) while on a page that isn't literally that URL
 * (e.g. an individual book page).
 */
function wrens_hollow_nav_active_key_for_url( $url ) {
	$path = trim( (string) wp_parse_url( $url, PHP_URL_PATH ), '/' );
	$map  = array(
		''                      => 'home',
		'books'                 => 'books',
		'about'                 => 'about',
		'shop'                  => 'shop',
		'on-the-horizon'        => 'horizon',
		'events-appearances'    => 'events',
		'the-veiled-prophecy'   => 'read-free',
		'whiskey-tango-foxtrot' => 'wtf',
	);
	return isset( $map[ $path ] ) ? $map[ $path ] : null;
}

/**
 * Whether a given menu item should render with .is-active, based on the
 * template's $wh_nav_active signal (not WP's own current-menu-item, so book
 * pages correctly light up their series + "Books" without being literal
 * children of those menu items).
 */
function wrens_hollow_nav_item_is_active( $item, $wh_nav_active, $has_children ) {
	if ( '' === (string) $wh_nav_active ) {
		return false;
	}
	if ( $has_children ) {
		// The "Books" item: active for the Books page itself and both series.
		return in_array( $wh_nav_active, array( 'books', 'read-free', 'wtf' ), true );
	}
	return wrens_hollow_nav_active_key_for_url( $item->url ) === $wh_nav_active;
}

class Wrens_Hollow_Walker extends Walker_Nav_Menu {

	public function start_lvl( &$output, $depth = 0, $args = null ) {
		$output .= '<div class="nav__dropdown-menu"><div class="nav__dropdown-menu-inner">';
	}

	public function end_lvl( &$output, $depth = 0, $args = null ) {
		$output .= '</div></div>';
	}

	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		global $wh_nav_active;

		// Core's Walker::display_element() only copies has_children onto $args
		// when $args is an array (a back-compat path); wp_nav_menu() passes an
		// *object*, so that never fires here. The real value lives on the
		// Walker instance itself ($this->has_children), set right before this
		// call — but it gets overwritten while children render, so stash it on
		// the item (a distinct object per menu item) to read back in end_el().
		$has_children           = ! empty( $this->has_children );
		$item->wh_has_children = $has_children;

		$label     = ! empty( $item->title ) ? $item->title : '';
		$url       = ! empty( $item->url ) ? $item->url : '';
		$is_active = wrens_hollow_nav_item_is_active( $item, $wh_nav_active, $has_children );

		if ( 0 === $depth ) {
			if ( $has_children ) {
				$output .= '<div class="nav__dropdown">';
				$output .= '<a class="nav__link nav__link--has-chevron' . ( $is_active ? ' is-active' : '' ) . '" href="' . esc_url( $url ) . '">';
				$output .= esc_html( $label );
				$output .= '<svg class="nav__dropdown-chevron" viewBox="0 0 10 6" aria-hidden="true"><path d="M1 1l4 4 4-4" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
				$output .= '</a>';
			} else {
				$output .= '<a class="nav__link' . ( $is_active ? ' is-active' : '' ) . '" href="' . esc_url( $url ) . '">' . esc_html( $label ) . '</a>';
			}
		} else {
			// Dropdown child link — the menu item's Description field (set in
			// Appearance > Menus > (item) > Description) is the sub-label.
			$sub     = trim( (string) $item->description );
			$output .= '<a class="nav__dropdown-link' . ( $is_active ? ' is-active' : '' ) . '" href="' . esc_url( $url ) . '">';
			$output .= '<span class="nav__dropdown-link-title">' . esc_html( $label ) . '</span>';
			if ( $sub ) {
				$output .= '<span class="nav__dropdown-link-sub">' . esc_html( $sub ) . '</span>';
			}
			$output .= '</a>';
		}
	}

	public function end_el( &$output, $item, $depth = 0, $args = null ) {
		if ( 0 === $depth && ! empty( $item->wh_has_children ) ) {
			$output .= '</div>'; // closes .nav__dropdown opened in start_el()
		}
	}
}

/**
 * Renders today's hardcoded nav if no "Primary navigation" menu is assigned yet
 * (Appearance > Menus), so the site keeps working — init.sh auto-creates and
 * assigns the menu, so this is a safety net, not the normal path.
 */
function wrens_hollow_nav_fallback() {
	global $wh_nav_active;
	$active  = isset( $wh_nav_active ) ? $wh_nav_active : '';
	$books_active = in_array( $active, array( 'books', 'read-free', 'wtf' ), true );
	$cls = function ( $key ) use ( $active ) {
		return 'nav__link' . ( $key === $active ? ' is-active' : '' );
	};
	?>
	<a class="<?php echo esc_attr( $cls( 'home' ) ); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
	<div class="nav__dropdown">
	  <a class="nav__link nav__link--has-chevron<?php echo $books_active ? ' is-active' : ''; ?>" href="<?php echo esc_url( home_url( '/books/' ) ); ?>">
	    Books
	    <svg class="nav__dropdown-chevron" viewBox="0 0 10 6" aria-hidden="true"><path d="M1 1l4 4 4-4" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
	  </a>
	  <div class="nav__dropdown-menu">
	    <div class="nav__dropdown-menu-inner">
	      <a class="nav__dropdown-link<?php echo 'read-free' === $active ? ' is-active' : ''; ?>" href="<?php echo esc_url( home_url( '/the-veiled-prophecy/' ) ); ?>">
	        <span class="nav__dropdown-link-title">The Veiled Prophecy</span>
	        <span class="nav__dropdown-link-sub">Fantasy · Kingdom of Sylvaeris</span>
	      </a>
	      <a class="nav__dropdown-link<?php echo 'wtf' === $active ? ' is-active' : ''; ?>" href="<?php echo esc_url( home_url( '/whiskey-tango-foxtrot/' ) ); ?>">
	        <span class="nav__dropdown-link-title">Whiskey Tango Foxtrot</span>
	        <span class="nav__dropdown-link-sub">Contemporary romance</span>
	      </a>
	    </div>
	  </div>
	</div>
	<a class="<?php echo esc_attr( $cls( 'about' ) ); ?>" href="<?php echo esc_url( home_url( '/about/' ) ); ?>">About</a>
	<a class="<?php echo esc_attr( $cls( 'shop' ) ); ?>" href="<?php echo esc_url( function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' ) ); ?>">Shop</a>
	<a class="<?php echo esc_attr( $cls( 'horizon' ) ); ?>" href="<?php echo esc_url( home_url( '/on-the-horizon/' ) ); ?>">On the Horizon</a>
	<a class="<?php echo esc_attr( $cls( 'events' ) ); ?>" href="<?php echo esc_url( home_url( '/events-appearances/' ) ); ?>">Events</a>
	<?php
}

/**
 * Minimal walker for the footer "Explore" links — flat <a> tags with no
 * wrapping <li>/<ul>, matching the existing .footer-links markup. Submenus (if
 * ever added) are flattened rather than nested, since the footer design has no
 * dropdown affordance.
 */
class Wrens_Hollow_Footer_Walker extends Walker_Nav_Menu {
	public function start_lvl( &$output, $depth = 0, $args = null ) {}
	public function end_lvl( &$output, $depth = 0, $args = null ) {}
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$output .= '<a href="' . esc_url( $item->url ) . '">' . esc_html( $item->title ) . '</a>';
	}
	public function end_el( &$output, $item, $depth = 0, $args = null ) {}
}

/**
 * Renders today's hardcoded footer links if no "Footer links" menu is assigned.
 */
function wrens_hollow_footer_nav_fallback() {
	?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
	<a href="<?php echo esc_url( home_url( '/books/' ) ); ?>">Books</a>
	<a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">About</a>
	<a href="<?php echo esc_url( function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' ) ); ?>">Shop</a>
	<a href="<?php echo esc_url( home_url( '/on-the-horizon/' ) ); ?>">On the Horizon</a>
	<a href="<?php echo esc_url( home_url( '/events-appearances/' ) ); ?>">Events</a>
	<?php
}
