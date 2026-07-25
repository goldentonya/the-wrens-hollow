<?php
/**
 * The About page's "Say hello" contact form. Uses a configured contact-form
 * plugin shortcode (Customize > Forms > "Contact form") when set — e.g.
 * Contact Form 7 or WPForms, both installed on the live site — else the
 * theme's own placeholder form (js/main.js shows an honest "not connected
 * yet" status instead of a fake success; nothing is silently lost).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$wh_cf_shortcode = wh_form_shortcode( 'contact' );
?>
<?php if ( $wh_cf_shortcode ) : ?>
  <div class="form-embed">
    <?php echo do_shortcode( $wh_cf_shortcode ); // phpcs:ignore WordPress.Security.EscapeOutput -- owner-authored shortcode (Customizer), sanitized via wp_kses_post() on save. ?>
  </div>
<?php else : ?>
  <form class="optin-form" id="contactForm">
    <div class="optin-row">
      <label class="optin-label" for="contactName">Your name</label>
      <input class="field" id="contactName" name="name" type="text" required autocomplete="name">
    </div>
    <div class="optin-row">
      <label class="optin-label" for="contactEmail">Your email</label>
      <input class="field" id="contactEmail" name="email" type="email" required autocomplete="email">
    </div>
    <div class="optin-row">
      <label class="optin-label" for="contactSubject">Subject</label>
      <input class="field" id="contactSubject" name="subject" type="text">
    </div>
    <div class="optin-row">
      <label class="optin-label" for="contactMessage">Your message (optional)</label>
      <textarea class="field" id="contactMessage" name="message" rows="5"></textarea>
    </div>
    <button class="btn" type="submit">Submit</button>
  </form>
  <p class="form-status" id="contactStatus"></p>
<?php endif; ?>
<?php unset( $wh_cf_shortcode ); ?>
