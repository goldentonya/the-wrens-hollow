<?php
/**
 * The "Read the book" free-chapters opt-in form, shared by all four book
 * detail pages (page-veilfall.php, page-veilbound.php,
 * page-whiskey-and-secrets.php, page-whiskey-and-lies.php — identical
 * name+email markup on each). Each book can have its own distinct opt-in form
 * (Customize > Forms > "Free-chapters opt-in — [book]") — pass which one via:
 *
 *   get_template_part( 'template-parts/optin-form', null, array( 'book' => 'veilfall' ) );
 *
 * A book with nothing set there falls back to the shared "default" field,
 * then to the theme's own placeholder form (js/main.js shows an honest "not
 * connected yet" status instead of a fake success).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$wh_of_book       = isset( $args['book'] ) ? $args['book'] : '';
$wh_of_shortcode  = $wh_of_book ? wh_form_shortcode( 'optin_' . $wh_of_book ) : '';
if ( ! $wh_of_shortcode ) {
	$wh_of_shortcode = wh_form_shortcode( 'optin' );
}
?>
<?php if ( $wh_of_shortcode ) : ?>
  <div class="form-embed" style="text-align:left;max-width:420px;margin:0 auto;">
    <?php echo do_shortcode( $wh_of_shortcode ); // phpcs:ignore WordPress.Security.EscapeOutput -- owner-authored shortcode/embed (Customizer), sanitized via wp_kses_post() on save. ?>
  </div>
<?php else : ?>
  <form class="optin-form" id="optinForm" style="text-align:left;max-width:420px;margin:0 auto;">
    <div class="optin-row">
      <label class="optin-label" for="optinFirst">Name <span class="req">*</span></label>
      <div class="optin-row__fields">
        <div class="optin-field">
          <input class="field" id="optinFirst" name="firstName" type="text" required autocomplete="given-name">
          <span class="optin-sublabel">First</span>
        </div>
        <div class="optin-field">
          <input class="field" id="optinLast" name="lastName" type="text" autocomplete="family-name">
          <span class="optin-sublabel">Last</span>
        </div>
      </div>
    </div>
    <div class="optin-row">
      <label class="optin-label" for="optinEmail">Email <span class="req">*</span></label>
      <input class="field" id="optinEmail" name="email" type="email" required autocomplete="email">
    </div>
    <button class="btn" type="submit">Submit</button>
  </form>
  <p class="form-status" id="optinStatus"></p>
<?php endif; ?>
<?php unset( $wh_of_book, $wh_of_shortcode ); ?>
