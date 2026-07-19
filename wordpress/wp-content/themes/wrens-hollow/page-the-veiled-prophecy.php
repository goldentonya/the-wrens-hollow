<?php
/**
 * Template Name: The Veiled Prophecy
 */
$wh_nav_active = 'read-free';
get_header();

$wh_vf_id = function_exists( 'wc_get_product_id_by_sku' ) ? wc_get_product_id_by_sku( 'veilfall-paperback' ) : 0;
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
    <div class="card book-showcase book-showcase--featured">
      <div class="ph-box"><img src="<?php echo esc_url( get_template_directory_uri() . '/images/covers/veilfall.jpg' ); ?>" alt="Veilfall book cover" style="width:100%;height:100%;object-fit:cover;object-position:top;border-radius:6px;"></div>
      <div class="book-showcase__body">
        <p class="book-card__tag">Book 1 · First chapters free</p>
        <h3>Veilfall</h3>
        <p class="txt">She was hidden in the human realm to stay safe. But magic has a way of finding what was never meant to be forgotten. When Veralyn's parents are killed, she learns the truth — she's fae, and bound to a prophecy that could alter the fate of Sylvaeris, forcing her into the dangerous halls of Auravale Academy.</p>
        <a class="btn btn--sm" href="<?php echo esc_url( home_url( '/veilfall/' ) ); ?>">Start reading free →</a>
        <a class="btn btn--outline btn--sm" href="<?php echo esc_url( $wh_vf_id ? get_permalink( $wh_vf_id ) : ( function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) . '#veilfall' : home_url( '/shop/#veilfall' ) ) ); ?>" style="margin-left:8px;">Buy book →</a>
      </div>
    </div>
    <div class="card book-showcase">
      <div class="ph-box"><img src="<?php echo esc_url( get_template_directory_uri() . '/images/covers/veilbound.jpg' ); ?>" alt="Veilbound book cover" style="width:100%;height:100%;object-fit:cover;border-radius:6px;"></div>
      <div class="book-showcase__body">
        <p class="book-card__tag">Book 2 · Coming soon</p>
        <h3>Veilbound</h3>
        <p class="txt">Vera's magic is fully awakening, revealing gifts tied to the first Fae Queen herself — and unexpected connections to a vampire and a wolf shifter she was never meant to meet. With Caelum bound to her by a fated mate bond she keeps resisting, Vera must decide whether protecting her heart is worth losing everything else.</p>
        <button class="btn btn--sm" type="button" data-notify="Veilbound">Notify me on release</button>
        <a class="btn btn--outline btn--sm" href="<?php echo esc_url( home_url( '/veilbound/' ) ); ?>" style="margin-left:8px;">Learn more →</a>
      </div>
    </div>
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
<section class="sec sec--tight sec--pink sec--dashed-top">
  <div class="wrap sec--center">
    <p class="eyebrow">Join the Hollow</p>
    <h2 class="h-md" style="color:var(--plum-deep);">Get bonus chapters + first look at new releases</h2>
    <form class="newsletter-form" id="newsletterForm" style="margin-left:auto;margin-right:auto;">
      <input class="field" type="email" placeholder="your@email.com" required aria-label="Email address">
      <button class="btn" type="submit">Notify me</button>
    </form>
    <p class="form-status" id="newsletterStatus"></p>
  </div>
</section>

<?php get_footer(); ?>
