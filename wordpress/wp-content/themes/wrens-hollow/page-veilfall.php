<?php
/**
 * Template Name: Veilfall
 */
$wh_nav_active = 'read-free';
get_header();

$wh_product_id = function_exists( 'wc_get_product_id_by_sku' ) ? wc_get_product_id_by_sku( wh_shop_sku( 'veilfall' ) ) : 0;
$wh_product    = $wh_product_id ? wc_get_product( $wh_product_id ) : false;

$wh_book    = function_exists( 'wh_book' ) ? wh_book( 'veilfall' ) : null;
$wh_book_id = $wh_book ? $wh_book->ID : false;
?>

<section class="sec--dark2 series-header">
  <?php
  wh_breadcrumbs(
  	array(
  		array( 'label' => 'Books', 'url' => home_url( '/books/' ) ),
  		array( 'label' => 'The Veiled Prophecy', 'url' => home_url( '/the-veiled-prophecy/' ) ),
  		array( 'label' => 'Veilfall' ),
  	)
  );
  ?>
  <div class="wrap" style="max-width:560px;">
    <p class="eyebrow eyebrow--on-dark"><?php wh_the( 'header_eyebrow', 'The Veiled Prophecy · Book 1', $wh_book_id ); ?></p>
    <h1 class="h-lg" style="color:#fff;"><?php echo esc_html( $wh_book ? get_the_title( $wh_book ) : 'Veilfall' ); ?></h1>
    <p class="lede" style="margin:14px auto 0;"><?php wh_the( 'hero_lede', 'Step into the Kingdom of Sylvaeris.', $wh_book_id ); ?></p>
  </div>
</section>

<section class="sec sec--pink">
  <div class="wrap hero">
    <div class="wh-fade">
      <p class="book-card__tag"><?php wh_the( 'hero_tag', 'Book 1 · Available now', $wh_book_id ); ?></p>
      <p class="txt"><?php wh_the( 'hero_blurb', "She was hidden in the human realm to stay safe. But magic has a way of finding what was never meant to be forgotten. Start Veralyn's story with this dark fae fantasy romance.", $wh_book_id ); ?></p>
      <div class="product-card__row" id="buy" style="justify-content:flex-start;gap:16px;margin-top:20px;">
        <?php if ( $wh_product ) : ?>
          <span class="product-card__price"><?php echo wp_kses_post( $wh_product->get_price_html() ); ?> · Paperback</span>
          <?php echo do_shortcode( '[add_to_cart id="' . $wh_product_id . '" show_price="false" style=""]' ); ?>
        <?php else : ?>
          <span class="product-card__price">$19.99 · Paperback</span>
          <button class="btn btn--outline" type="button" data-notify="the Veilfall paperback">Notify me when available</button>
        <?php endif; ?>
      </div>
    </div>
    <div class="hero__cover wh-fade" style="--delay:.1s">
      <div class="ph-box"><img src="<?php echo esc_url( $wh_book ? wh_book_cover( $wh_book ) : get_template_directory_uri() . '/images/covers/veilfall.jpg' ); ?>" alt="<?php echo esc_attr( $wh_book ? get_the_title( $wh_book ) : 'Veilfall' ); ?> book cover" style="width:100%;height:100%;object-fit:cover;border-radius:4px;"></div>
    </div>
  </div>
</section>

<section class="sec sec--cream sec--dashed-top">
  <div class="wrap book-about">
    <p class="eyebrow">About the book</p>
    <h2 class="h-md"><?php echo esc_html( $wh_book ? get_the_title( $wh_book ) : 'Veilfall' ); ?></h2>
    <div class="book-about__body" style="max-width:600px;">
      <?php wh_wysiwyg( 'about_body', '', $wh_book_id ); ?>
    </div>
  </div>
</section>

<section class="sec sec--pink sec--dashed-top">
  <div class="wrap sec--center">
    <h2 class="h-md" style="color:var(--plum-deep);"><?php wh_the( 'read_heading', 'Read ' . ( $wh_book ? get_the_title( $wh_book ) : 'Veilfall' ), $wh_book_id ); ?></h2>
    <p class="txt" style="max-width:440px;margin:0 auto 20px;"><?php wh_the( 'read_subtext', 'Enter your email below to receive the opening chapters instantly.', $wh_book_id ); ?></p>
    <?php get_template_part( 'template-parts/optin-form' ); ?>
  </div>
</section>

<section class="sec sec--cream sec--dashed-top">
  <div class="wrap">
    <p class="eyebrow" style="text-align:center;margin-bottom:28px;">What readers are saying</p>
    <?php $wh_book_reviews = $wh_book_id ? wh_reviews_for_book( $wh_book_id ) : array(); ?>
    <?php if ( $wh_book_reviews ) : ?>
    <div class="grid-2">
      <?php foreach ( $wh_book_reviews as $wh_review ) { wh_render_review_card( $wh_review ); } ?>
    </div>
    <?php else : ?>
    <p class="txt" style="max-width:440px;margin:0 auto;text-align:center;">Reviews will show up here soon — check back!</p>
    <?php endif; ?>
  </div>
</section>

<?php
get_template_part(
	'template-parts/newsletter-band',
	null,
	array(
		'eyebrow' => wh_field( 'news_eyebrow', 'Join the Hollow', $wh_book_id ),
		'heading' => wh_field( 'news_heading', 'Get bonus chapters + first look at new releases', $wh_book_id ),
	)
);
?>

<?php get_footer(); ?>
