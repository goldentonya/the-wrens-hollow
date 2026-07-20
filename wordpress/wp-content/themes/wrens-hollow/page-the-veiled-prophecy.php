<?php
/**
 * Template Name: The Veiled Prophecy
 */
$wh_nav_active = 'read-free';
get_header();
?>

<!-- Masthead -->
<section class="hero-banner hero-banner--series">
  <?php
  wh_breadcrumbs(
  	array(
  		array( 'label' => 'Books', 'url' => home_url( '/books/' ) ),
  		array( 'label' => 'The Veiled Prophecy' ),
  	)
  );
  ?>
  <img class="hero-banner__img hero-banner__img--prophecy" src="<?php echo esc_url( get_template_directory_uri() . '/images/photos/prophecy.png' ); ?>" alt="The Veiled Prophecy series art" width="1536" height="1024">
  <div class="hero-banner__fade" aria-hidden="true"></div>
</section>
<section class="hero-cta">
  <div class="wrap sec--center wh-fade">
    <p class="eyebrow eyebrow--on-dark"><?php wh_the( 'series_eyebrow', 'Fantasy series · Kingdom of Sylvaeris' ); ?></p>
    <h1 class="hero-cta__title"><?php wh_the( 'series_title', 'The Veiled Prophecy' ); ?></h1>
    <p class="lede hero-cta__lede"><?php wh_the( 'series_lede', "She thought she was human. The fae realm knows better — a saga of ancient magic, dangerous love, and a prophecy that won't stay hidden." ); ?></p>
  </div>
</section>

<!-- About the Series -->
<section class="sec sec--dashed-top">
  <div class="wrap series-about">
    <div>
      <p class="eyebrow">About the Series</p>
      <h2 class="h-md"><?php wh_the( 'about_series_heading', 'A world of secrets, prophecy, and dangerous love' ); ?></h2>
      <div class="wh-rte" style="margin-top:14px;">
        <?php wh_wysiwyg( 'about_series_body', "<p>Hidden deep beyond the veil, Sylvaeris is a land where ancient magic stirs, and fate weaves tighter than any spell.</p><p>At the heart of this world is Veralyn, a girl who grew up believing she was human—until the truth calls her back.</p><p>Beside her stands Caelum, the guarded prince with the power to read auras and a kingdom to protect.</p><p>Dark secrets rise, the Veilbound Order beckons, and not everyone wants the heir's chosen to survive.</p><p>A tale of fate, forbidden magic, and slow-burn romance awaits. Start free, then follow the saga.</p>" ); ?>
      </div>
    </div>
    <img class="series-about__art" src="<?php echo esc_url( get_template_directory_uri() . '/images/photos/wilderness.png' ); ?>" alt="A moonlit castle deep in the Sylvaeris wilderness">
  </div>
</section>

<!-- Reading order -->
<section class="sec sec--cream sec--dashed-top">
  <div class="wrap">
    <p class="eyebrow">Reading order</p>
    <?php foreach ( wh_books( 'veiled-prophecy' ) as $wh_i => $wh_book_post ) { wh_render_reading_order_card( $wh_book_post, 0 === $wh_i ); } ?>
  </div>
</section>

<!-- Reviews -->
<section class="sec sec--tight sec--cream2 sec--dashed-top">
  <div class="wrap sec--center">
    <p class="eyebrow" style="margin-bottom:32px;">What Readers Are Saying</p>
    <?php wh_render_reviews_carousel( wh_reviews_for_series( 'veiled-prophecy' ) ); ?>
  </div>
</section>

<!-- Newsletter -->
<?php
get_template_part(
	'template-parts/newsletter-band',
	null,
	array(
		'section_class' => 'sec sec--tight sec--pink sec--dashed-top',
		'eyebrow'       => wh_field( 'news_eyebrow', 'Join the Hollow' ),
		'heading'       => wh_field( 'news_heading', 'Get bonus chapters + first look at new releases' ),
	)
);
?>

<?php get_footer(); ?>
