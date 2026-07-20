<?php
/**
 * The repeated "Join the Hollow" newsletter subscribe band — identical form
 * markup everywhere; only the wrapping section classes, eyebrow, heading, and
 * button label vary per page. Call with:
 *
 *   get_template_part( 'template-parts/newsletter-band', null, array(
 *       'section_class' => 'sec sec--tight sec--cream2 sec--dashed-top',
 *       'eyebrow_class' => 'eyebrow',
 *       'eyebrow'       => 'Join the Hollow',
 *       'heading'       => 'Get bonus chapters + first look at new releases',
 *       'heading_style' => 'color:var(--plum-deep);',
 *       'button'        => 'Notify me',
 *   ) );
 *
 * Any arg left out falls back to the values below (the most common variant).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$wh_nb_section       = isset( $args['section_class'] ) ? $args['section_class'] : 'sec sec--tight sec--cream2 sec--dashed-top';
$wh_nb_eyebrow_class = isset( $args['eyebrow_class'] ) ? $args['eyebrow_class'] : 'eyebrow';
$wh_nb_eyebrow       = isset( $args['eyebrow'] ) ? $args['eyebrow'] : 'Join the Hollow';
$wh_nb_heading       = isset( $args['heading'] ) ? $args['heading'] : 'Get bonus chapters + first look at new releases';
$wh_nb_heading_style = isset( $args['heading_style'] ) ? $args['heading_style'] : 'color:var(--plum-deep);';
$wh_nb_button        = isset( $args['button'] ) ? $args['button'] : 'Notify me';
?>
<section class="<?php echo esc_attr( $wh_nb_section ); ?>">
  <div class="wrap sec--center">
    <p class="<?php echo esc_attr( $wh_nb_eyebrow_class ); ?>"><?php echo esc_html( $wh_nb_eyebrow ); ?></p>
    <h2 class="h-md" style="<?php echo esc_attr( $wh_nb_heading_style ); ?>"><?php echo esc_html( $wh_nb_heading ); ?></h2>
    <form class="newsletter-form" id="newsletterForm" style="margin-left:auto;margin-right:auto;">
      <input class="field" type="email" placeholder="your@email.com" required aria-label="Email address">
      <button class="btn" type="submit"><?php echo esc_html( $wh_nb_button ); ?></button>
    </form>
    <p class="form-status" id="newsletterStatus"></p>
  </div>
</section>
<?php unset( $wh_nb_section, $wh_nb_eyebrow_class, $wh_nb_eyebrow, $wh_nb_heading, $wh_nb_heading_style, $wh_nb_button );