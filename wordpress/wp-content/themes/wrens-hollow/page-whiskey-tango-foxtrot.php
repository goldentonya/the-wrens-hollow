<?php
/**
 * Template Name: Whiskey Tango Foxtrot
 */
$wh_nav_active = 'wtf';
get_header();
?>

<!-- Masthead -->
<section class="hero-banner hero-banner--series">
  <?php
  wh_breadcrumbs(
  	array(
  		array( 'label' => 'Books', 'url' => home_url( '/books/' ) ),
  		array( 'label' => 'Whiskey Tango Foxtrot' ),
  	)
  );
  ?>
  <?php wh_img( 'series_cover_image', 'images/photos/shadowlink.png', 'Whiskey Tango Foxtrot series art', 'class="hero-banner__img" width="1536" height="1024"' ); ?>
  <div class="hero-banner__fade" aria-hidden="true"></div>
</section>
<section class="hero-cta">
  <div class="wrap sec--center wh-fade">
    <p class="eyebrow eyebrow--on-dark"><?php wh_the( 'series_eyebrow', 'Contemporary romance' ); ?></p>
    <h1 class="hero-cta__title"><?php wh_the( 'series_title', 'Whiskey Tango Foxtrot' ); ?></h1>
    <p class="lede hero-cta__lede"><?php wh_the( 'series_lede', 'Fierce, funny, unforgettable — love that hits like a shot and lingers like the good stuff.' ); ?></p>
  </div>
</section>

<!-- About the Series -->
<section class="sec sec--dashed-top">
  <div class="wrap series-about">
    <div>
      <p class="eyebrow">About the Series</p>
      <h2 class="h-md"><?php wh_the( 'about_series_heading', "Sharp banter, real heartbreak, women who don't back down" ); ?></h2>
      <div class="wh-rte" style="margin-top:14px;">
        <?php wh_wysiwyg( 'about_series_body', "<p>Whiskey Tango Foxtrot is contemporary romance with teeth — the kind of story that makes you laugh on one page and reach for a tissue on the next.</p><p>At its center are women who've been knocked down and refuse to stay there, and the men who are smart enough not to underestimate them.</p><p>Every secret has a cost, every drink has a story, and every ending is earned — not handed out.</p><p>Start with Whiskey &amp; Secrets, free forever, then follow the series as it unfolds.</p>" ); ?>
      </div>
    </div>
    <?php wh_img( 'about_series_image', 'images/photos/map.jpeg', 'Whiskey Tango Foxtrot series map art', 'class="series-about__art"' ); ?>
  </div>

  <div class="wrap" style="margin-top:56px;">
    <p class="eyebrow" style="text-align:center;">Meet the Team</p>
    <div class="team-grid">
      <?php foreach ( wh_characters() as $wh_character ) { wh_render_character( $wh_character ); } ?>
    </div>
  </div>
</section>

<!-- Reading order -->
<section class="sec sec--cream sec--dashed-top">
  <div class="wrap">
    <p class="eyebrow">Reading order</p>
    <?php foreach ( wh_books( 'whiskey-tango-foxtrot' ) as $wh_i => $wh_book_post ) { wh_render_reading_order_card( $wh_book_post, 0 === $wh_i ); } ?>
  </div>
</section>

<!-- Reviews -->
<section class="sec sec--tight sec--cream2 sec--dashed-top">
  <div class="wrap sec--center">
    <p class="eyebrow" style="margin-bottom:32px;">What Readers Are Saying</p>
    <?php wh_render_reviews_carousel( wh_reviews_for_series( 'whiskey-tango-foxtrot' ) ); ?>
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
