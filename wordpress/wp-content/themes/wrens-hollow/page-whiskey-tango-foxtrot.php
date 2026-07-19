<?php
/**
 * Template Name: Whiskey Tango Foxtrot
 */
$wh_nav_active = 'wtf';
get_header();

$wh_ws_id = function_exists( 'wc_get_product_id_by_sku' ) ? wc_get_product_id_by_sku( 'whiskey-and-secrets-signed' ) : 0;
$wh_wl_id = function_exists( 'wc_get_product_id_by_sku' ) ? wc_get_product_id_by_sku( 'whiskey-and-lies-signed' ) : 0;
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
  <img class="hero-banner__img" src="<?php echo esc_url( get_template_directory_uri() . '/images/photos/shadowlink.png' ); ?>" alt="Whiskey Tango Foxtrot series art" width="1536" height="1024">
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
    <img class="series-about__art" src="<?php echo esc_url( get_template_directory_uri() . '/images/photos/map.jpeg' ); ?>" alt="Whiskey Tango Foxtrot series map art">
  </div>

  <div class="wrap" style="margin-top:56px;">
    <p class="eyebrow" style="text-align:center;">Meet the Team</p>
    <div class="team-grid">
      <div class="team-card">
        <div class="team-card__badge"><img src="<?php echo esc_url( get_template_directory_uri() . '/images/team/wraith.png' ); ?>" alt="Wraith emblem"></div>
        <h3>Wade "Wraith" Blakely</h3>
        <p class="txt">Team leader. Quiet, deadly, and protective. A force in the field with a guarded heart.</p>
      </div>
      <div class="team-card">
        <div class="team-card__badge"><img src="<?php echo esc_url( get_template_directory_uri() . '/images/team/glitch.png' ); ?>" alt="Glitch emblem"></div>
        <h3>Jake "Glitch" Thompson</h3>
        <p class="txt">Communications expert. Brilliant with tech, haunted by his past, loyal to the end.</p>
      </div>
      <div class="team-card">
        <div class="team-card__badge"><img src="<?php echo esc_url( get_template_directory_uri() . '/images/team/reaper.png' ); ?>" alt="Reaper emblem"></div>
        <h3>Simon "Reaper" Miller</h3>
        <p class="txt">Second-in-command. Lethal and strategic, but with a sarcastic streak and unmatched loyalty.</p>
      </div>
      <div class="team-card">
        <div class="team-card__badge"><img src="<?php echo esc_url( get_template_directory_uri() . '/images/team/sparta.png' ); ?>" alt="Sparta emblem"></div>
        <h3>Shawn "Sparta" Jackson</h3>
        <p class="txt">Operations specialist. Keeps the team focused, carries ancient wisdom, and has a plan for everything.</p>
      </div>
      <div class="team-card">
        <div class="team-card__badge"><img src="<?php echo esc_url( get_template_directory_uri() . '/images/team/magellan.png' ); ?>" alt="Magellan emblem"></div>
        <h3>Joel "Magellan" Ramirez</h3>
        <p class="txt">Weapons and logistics. Strength, charm, and a heart as steady as his aim.</p>
      </div>
      <div class="team-card">
        <div class="team-card__badge"><img src="<?php echo esc_url( get_template_directory_uri() . '/images/team/stitches.png' ); ?>" alt="Stitches emblem"></div>
        <h3>Nick "Stitches" Davies</h3>
        <p class="txt">Medic. Calm under pressure, a healer who's seen too much.</p>
      </div>
      <div class="team-card">
        <div class="team-card__badge"><img src="<?php echo esc_url( get_template_directory_uri() . '/images/team/ghost.png' ); ?>" alt="Ghost emblem"></div>
        <h3>Jackson "Ghost" Lewis</h3>
        <p class="txt">Intel. Silent, calculating, and often underestimated.</p>
      </div>
    </div>
  </div>
</section>

<!-- Reading order -->
<section class="sec sec--cream sec--dashed-top">
  <div class="wrap">
    <p class="eyebrow">Reading order</p>
    <div class="card book-showcase book-showcase--featured">
      <div class="ph-box"><img src="<?php echo esc_url( get_template_directory_uri() . '/images/covers/whiskey-and-secrets.jpg' ); ?>" alt="Whiskey &amp; Secrets book cover" style="width:100%;height:100%;object-fit:cover;border-radius:6px;"></div>
      <div class="book-showcase__body">
        <p class="book-card__tag">Book 1 · First chapters free</p>
        <h3>Whiskey &amp; Secrets</h3>
        <p class="txt">When biological anthropology grad student Sarah leads a research expedition into the Amazon, she never expects to need military protection — least of all from Wade "Wraith" Blakely, the stoic former Green Beret assigned to keep her team safe. When one of them goes missing, secrets buried in the jungle, and in Sarah's past, start to surface.</p>
        <a class="btn btn--sm" href="<?php echo esc_url( home_url( '/whiskey-and-secrets/' ) ); ?>">Start reading free →</a>
        <a class="btn btn--outline btn--sm" href="<?php echo esc_url( $wh_ws_id ? get_permalink( $wh_ws_id ) : ( function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) . '#whiskey-and-secrets' : home_url( '/shop/#whiskey-and-secrets' ) ) ); ?>" style="margin-left:8px;">Buy book →</a>
      </div>
    </div>
    <div class="card book-showcase">
      <div class="ph-box"><img src="<?php echo esc_url( get_template_directory_uri() . '/images/covers/whiskey-and-lies.jpg' ); ?>" alt="Whiskey &amp; Lies book cover" style="width:100%;height:100%;object-fit:cover;border-radius:6px;"></div>
      <div class="book-showcase__body">
        <p class="book-card__tag">Book 2 · Free</p>
        <h3>Whiskey &amp; Lies</h3>
        <p class="txt">Jake "Glitch" Thompson came home from the military carrying more scars than he admits. Fallon Moore has always been the steady one — until Jake becomes the exception to every rule she swore by. As shadows from Fallon's past close in fast, Jake must decide if he's willing to fight through her ghosts to build the life they could have together.</p>
        <a class="btn btn--sm" href="<?php echo esc_url( home_url( '/whiskey-and-lies/' ) ); ?>">Start reading free →</a>
        <a class="btn btn--outline btn--sm" href="<?php echo esc_url( $wh_wl_id ? get_permalink( $wh_wl_id ) : ( function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) . '#whiskey-and-lies' : home_url( '/shop/#whiskey-and-lies' ) ) ); ?>" style="margin-left:8px;">Buy book →</a>
      </div>
    </div>
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
