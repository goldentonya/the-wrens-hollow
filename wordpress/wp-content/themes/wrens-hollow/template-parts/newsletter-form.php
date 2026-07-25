<?php
/**
 * The actual email-capture form used by the "Join the Hollow" band
 * (template-parts/newsletter-band.php) and the About page's newsletter
 * column — factored out so both pick up a configured mailing-list provider
 * (Customize > Forms > "Newsletter signup") the same way. When nothing is
 * configured, falls back to the theme's own placeholder form (js/main.js
 * shows an honest "not connected yet" status instead of a fake success).
 *
 * Call with:
 *   get_template_part( 'template-parts/newsletter-form', null, array(
 *       'button' => 'Notify me',              // fallback-form button label
 *       'style'  => 'margin-left:auto;margin-right:auto;', // optional inline style
 *   ) );
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$wh_nf_button    = isset( $args['button'] ) ? $args['button'] : 'Notify me';
$wh_nf_style     = isset( $args['style'] ) ? $args['style'] : '';
$wh_nf_shortcode = wh_form_shortcode( 'newsletter' );
?>
<?php if ( $wh_nf_shortcode ) : ?>
  <div class="form-embed"<?php echo $wh_nf_style ? ' style="' . esc_attr( $wh_nf_style ) . '"' : ''; ?>>
    <?php echo do_shortcode( $wh_nf_shortcode ); // phpcs:ignore WordPress.Security.EscapeOutput -- owner-authored shortcode/embed (Customizer), sanitized via wp_kses_post() on save. ?>
  </div>
<?php else : ?>
  <form class="newsletter-form" id="newsletterForm"<?php echo $wh_nf_style ? ' style="' . esc_attr( $wh_nf_style ) . '"' : ''; ?>>
    <label class="sr-only" for="newsletterEmail">Email address</label>
    <input class="field" id="newsletterEmail" type="email" placeholder="your@email.com" required>
    <button class="btn" type="submit"><?php echo esc_html( $wh_nf_button ); ?></button>
  </form>
  <p class="form-status" id="newsletterStatus"></p>
<?php endif; ?>
<?php unset( $wh_nf_button, $wh_nf_style, $wh_nf_shortcode ); ?>
