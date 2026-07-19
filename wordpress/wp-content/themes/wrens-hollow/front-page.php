<?php
/**
 * Template Name: Home
 */
$wh_nav_active = 'home';
get_header();
?>

<!-- Hero -->
<section class="hero-banner">
  <img class="hero-banner__img" src="<?php echo esc_url( get_template_directory_uri() . '/images/photos/ali-wren-header.jpg' ); ?>" alt="Ali Wren — Fantasy &amp; Dark Romance" width="1920" height="800">
  <div class="hero-banner__fade" aria-hidden="true"></div>
</section>
<section class="hero-cta">
  <div class="wrap sec--center wh-fade">
    <p class="eyebrow eyebrow--on-dark"><?php wh_the( 'home_hero_eyebrow', 'The Veiled Prophecy · Book 1' ); ?></p>
    <h1 class="hero-cta__title"><?php wh_the( 'home_hero_title', "She doesn't know who to trust." ); ?></h1>
    <p class="lede hero-cta__lede">Begin the fantasy series with <strong>Veilfall</strong> — the free first book readers can't put down.</p>
    <div class="hero-cta__actions">
      <a class="btn" href="<?php echo esc_url( home_url( '/the-veiled-prophecy/' ) ); ?>"><?php wh_the( 'home_hero_button', 'Start Reading Free →' ); ?></a>
    </div>
    <p class="trust-line hero-cta__trust"><?php wh_the( 'home_hero_trust', '★★★★★ · 200+ reviews · free forever' ); ?></p>
  </div>
</section>

<!-- Explore the books -->
<section class="sec" id="books">
  <div class="wrap">
    <p class="eyebrow"><?php wh_the( 'home_books_eyebrow', 'Explore the books' ); ?></p>
    <h2 class="h-lg"><?php wh_the( 'home_books_heading', 'Two worlds, one storyteller' ); ?></h2>
    <p class="lede" style="margin-top:12px;"><?php wh_the( 'home_books_lede', 'Fierce contemporary romance. Dark fae fantasy. Pick your escape.' ); ?></p>

    <div class="series-spotlight-grid">
      <a class="series-spotlight" href="<?php echo esc_url( wh_field( 'home_spot1_url', home_url( '/the-veiled-prophecy/' ) ) ); ?>">
        <div class="series-spotlight__cover ph-box">
          <?php wh_img( 'home_spot1_cover', 'images/covers/veilfall.jpg', 'The Veiled Prophecy book cover', 'style="width:100%;height:100%;object-fit:cover;object-position:top;border-radius:6px;"' ); ?>
        </div>
        <div class="series-spotlight__body">
          <p class="book-card__tag"><?php wh_the( 'home_spot1_tag', 'Fantasy · Kingdom of Sylvaeris' ); ?></p>
          <h3><?php wh_the( 'home_spot1_title', 'The Veiled Prophecy' ); ?></h3>
          <p class="txt"><?php wh_the( 'home_spot1_blurb', "She thought she was human. The fae realm knows better. Start Veralyn's story with Veilfall, free forever." ); ?></p>
          <span class="series-spotlight__link">Enter the Story <span aria-hidden="true">→</span></span>
        </div>
      </a>

      <a class="series-spotlight" href="<?php echo esc_url( wh_field( 'home_spot2_url', home_url( '/whiskey-tango-foxtrot/' ) ) ); ?>">
        <div class="series-spotlight__cover ph-box">
          <?php wh_img( 'home_spot2_cover', 'images/covers/whiskey-and-secrets.jpg', 'Whiskey Tango Foxtrot book cover', 'style="width:100%;height:100%;object-fit:cover;border-radius:6px;"' ); ?>
        </div>
        <div class="series-spotlight__body">
          <p class="book-card__tag"><?php wh_the( 'home_spot2_tag', 'Contemporary romance' ); ?></p>
          <h3><?php wh_the( 'home_spot2_title', 'Whiskey Tango Foxtrot' ); ?></h3>
          <p class="txt"><?php wh_the( 'home_spot2_blurb', "Whiskey & Secrets · Whiskey & Lies. Sharp banter, real heartbreak, and women who don't back down." ); ?></p>
          <span class="series-spotlight__link">Enter the Story <span aria-hidden="true">→</span></span>
        </div>
      </a>
    </div>
  </div>
</section>

<!-- Reviews -->
<section class="sec sec--tight sec--cream sec--dashed-top" id="reviews">
  <div class="wrap sec--center">
    <p class="eyebrow" style="margin-bottom:32px;">What Readers Are Saying</p>
    <?php wh_render_reviews_carousel( wh_reviews() ); ?>
  </div>
</section>

<!-- About teaser -->
<section class="sec sec--cream2 sec--dashed-top">
  <div class="wrap bio-row bio-row--sm">
    <div class="bio-teaser-content">
      <p class="eyebrow"><?php wh_the( 'home_about_eyebrow', 'Behind the pen' ); ?></p>
      <h3 class="h-md"><?php wh_the( 'home_about_heading', "Hi, I'm Ali Wren" ); ?></h3>
      <p class="pull-quote" style="margin:16px 0 22px;"><?php wh_the( 'home_about_quote', "Author, biological anthropologist, and proud Minnesota mom. I write romantic adventures that blend science, suspense, and heart — stories with fierce heroines, loyal heroes, and love that's never quite as simple as it seems." ); ?></p>
      <a class="btn btn--outline btn--sm" href="<?php echo esc_url( home_url( '/about/' ) ); ?>">Read more</a>
    </div>
    <div class="ph-box"><img src="<?php echo esc_url( get_template_directory_uri() . '/images/photos/book-signing-1.jpg' ); ?>" alt="Ali Wren at a book signing" style="width:100%;height:100%;object-fit:cover;border-radius:8px;"></div>
  </div>
</section>

<!-- Newsletter band -->
<section class="sec sec--tight sec--dark">
  <div class="wrap sec--center">
    <p class="eyebrow eyebrow--on-dark"><?php wh_the( 'home_news_eyebrow', 'Join the Hollow' ); ?></p>
    <h2 class="h-md" style="font-size:24px;"><?php wh_the( 'home_news_heading', 'Get bonus chapters + first look at new releases' ); ?></h2>
    <form class="newsletter-form" id="newsletterForm" style="margin-left:auto;margin-right:auto;">
      <input class="field" type="email" placeholder="your@email.com" required aria-label="Email address">
      <button class="btn" type="submit">Subscribe</button>
    </form>
    <p class="form-status" id="newsletterStatus"></p>
  </div>
</section>

<!-- On the horizon -->
<section class="sec sec--dashed-top">
  <div class="wrap">
    <p class="eyebrow"><?php wh_the( 'home_writing_eyebrow', 'On the horizon' ); ?></p>
    <h2 class="h-lg"><?php wh_the( 'home_writing_heading', 'Currently writing' ); ?></h2>

    <div class="horizon-grid">
      <?php foreach ( wh_projects_home() as $wh_project ) { wh_render_home_project_card( $wh_project ); } ?>
    </div>
  </div>
</section>

<!-- Events & appearances -->
<section class="sec sec--pink sec--dashed-top">
  <div class="wrap">
    <p class="eyebrow"><?php wh_the( 'home_events_eyebrow', 'Events & appearances' ); ?></p>
    <p class="lede"><?php wh_the( 'home_events_lede', 'Signings, book fairs & author events — where to find me next.' ); ?></p>

    <div class="events-teaser-grid">
      <div>
        <p class="eyebrow" style="margin-bottom:14px;">Upcoming</p>
        <?php $wh_home_upcoming = wh_events( 'upcoming' ); ?>
        <?php if ( $wh_home_upcoming ) : ?>
          <?php wh_render_event_card( $wh_home_upcoming[0] ); ?>
        <?php else : ?>
        <div class="card event-card">
          <div class="event-date event-date--tba">
            <div class="event-date__mon" style="color:var(--text-muted);">TBA</div>
          </div>
          <div>
            <h3>More dates TBD</h3>
            <p class="txt">New appearances are added throughout the year — check back soon.</p>
          </div>
        </div>
        <?php endif; ?>
      </div>

      <div>
        <p class="eyebrow" style="margin-bottom:14px;">Past events</p>
        <?php foreach ( array_slice( wh_events( 'past' ), 0, 2 ) as $wh_event ) { wh_render_event_card( $wh_event ); } ?>
      </div>
    </div>

    <div style="margin-top:32px;">
      <a class="btn btn--outline" href="<?php echo esc_url( home_url( '/events-appearances/' ) ); ?>">See all events &amp; appearances →</a>
    </div>
  </div>
</section>

<?php get_footer(); ?>
