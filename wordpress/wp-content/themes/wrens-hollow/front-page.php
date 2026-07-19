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
    <p class="eyebrow eyebrow--on-dark">The Veiled Prophecy · Book 1</p>
    <h1 class="hero-cta__title">She doesn't know who to trust.</h1>
    <p class="lede hero-cta__lede">Begin the fantasy series with <strong>Veilfall</strong> — the free first book readers can't put down.</p>
    <div class="hero-cta__actions">
      <a class="btn" href="<?php echo esc_url( home_url( '/the-veiled-prophecy/' ) ); ?>">Start Reading Free →</a>
    </div>
    <p class="trust-line hero-cta__trust">★★★★★ · 200+ reviews · free forever</p>
  </div>
</section>

<!-- Explore the books -->
<section class="sec" id="books">
  <div class="wrap">
    <p class="eyebrow">Explore the books</p>
    <h2 class="h-lg">Two worlds, one storyteller</h2>
    <p class="lede" style="margin-top:12px;">Fierce contemporary romance. Dark fae fantasy. Pick your escape.</p>

    <div class="series-spotlight-grid">
      <a class="series-spotlight" href="<?php echo esc_url( home_url( '/the-veiled-prophecy/' ) ); ?>">
        <div class="series-spotlight__cover ph-box">
          <img src="<?php echo esc_url( get_template_directory_uri() . '/images/covers/veilfall.jpg' ); ?>" alt="Veilfall book cover" style="width:100%;height:100%;object-fit:cover;object-position:top;border-radius:6px;">
        </div>
        <div class="series-spotlight__body">
          <p class="book-card__tag">Fantasy · Kingdom of Sylvaeris</p>
          <h3>The Veiled Prophecy</h3>
          <p class="txt">She thought she was human. The fae realm knows better. Start Veralyn's story with Veilfall, free forever.</p>
          <span class="series-spotlight__link">Enter the Story <span aria-hidden="true">→</span></span>
        </div>
      </a>

      <a class="series-spotlight" href="<?php echo esc_url( home_url( '/whiskey-tango-foxtrot/' ) ); ?>">
        <div class="series-spotlight__cover ph-box">
          <img src="<?php echo esc_url( get_template_directory_uri() . '/images/covers/whiskey-and-secrets.jpg' ); ?>" alt="Whiskey &amp; Secrets book cover" style="width:100%;height:100%;object-fit:cover;border-radius:6px;">
        </div>
        <div class="series-spotlight__body">
          <p class="book-card__tag">Contemporary romance</p>
          <h3>Whiskey Tango Foxtrot</h3>
          <p class="txt">Whiskey &amp; Secrets · Whiskey &amp; Lies. Sharp banter, real heartbreak, and women who don't back down.</p>
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
    <div class="reviews-carousel">
      <div class="reviews-carousel__track">
        <div class="reviews-carousel__set">
          <div class="card review-card">
            <p class="stars">★★★★★</p>
            <p class="txt">"Couldn't put it down — the tension is unreal."</p>
            <p class="source">— Goodreads</p>
          </div>
          <div class="card review-card">
            <p class="stars">★★★★★</p>
            <p class="txt">"Fierce women and swoony romance. More please!"</p>
            <p class="source">— Amazon</p>
          </div>
          <div class="card review-card">
            <p class="stars">★★★★★</p>
            <p class="txt">"Veilfall is the fae fantasy I didn't know I needed. That ending!"</p>
            <p class="source">— NetGalley</p>
          </div>
          <div class="card review-card">
            <p class="stars">★★★★★</p>
            <p class="txt">"Whiskey Tango Foxtrot had me laughing one page and crying the next."</p>
            <p class="source">— BookBub</p>
          </div>
          <div class="card review-card">
            <p class="stars">★★★★★</p>
            <p class="txt">"Ali Wren writes heroines who don't wait to be saved."</p>
            <p class="source">— @reads.with.casey, TikTok</p>
          </div>
          <div class="card review-card">
            <p class="stars">★★★★★</p>
            <p class="txt">"Whiskey &amp; Secrets had the perfect amount of banter and heartbreak."</p>
            <p class="source">— Instagram</p>
          </div>
        </div>
        <div class="reviews-carousel__set" aria-hidden="true">
          <div class="card review-card">
            <p class="stars">★★★★★</p>
            <p class="txt">"Couldn't put it down — the tension is unreal."</p>
            <p class="source">— Goodreads</p>
          </div>
          <div class="card review-card">
            <p class="stars">★★★★★</p>
            <p class="txt">"Fierce women and swoony romance. More please!"</p>
            <p class="source">— Amazon</p>
          </div>
          <div class="card review-card">
            <p class="stars">★★★★★</p>
            <p class="txt">"Veilfall is the fae fantasy I didn't know I needed. That ending!"</p>
            <p class="source">— NetGalley</p>
          </div>
          <div class="card review-card">
            <p class="stars">★★★★★</p>
            <p class="txt">"Whiskey Tango Foxtrot had me laughing one page and crying the next."</p>
            <p class="source">— BookBub</p>
          </div>
          <div class="card review-card">
            <p class="stars">★★★★★</p>
            <p class="txt">"Ali Wren writes heroines who don't wait to be saved."</p>
            <p class="source">— @reads.with.casey, TikTok</p>
          </div>
          <div class="card review-card">
            <p class="stars">★★★★★</p>
            <p class="txt">"Whiskey &amp; Secrets had the perfect amount of banter and heartbreak."</p>
            <p class="source">— Instagram</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- About teaser -->
<section class="sec sec--cream2 sec--dashed-top">
  <div class="wrap bio-row bio-row--sm">
    <div class="bio-teaser-content">
      <p class="eyebrow">Behind the pen</p>
      <h3 class="h-md">Hi, I'm Ali Wren</h3>
      <p class="pull-quote" style="margin:16px 0 22px;">Author, biological anthropologist, and proud Minnesota mom. I write romantic adventures that blend science, suspense, and heart — stories with fierce heroines, loyal heroes, and love that's never quite as simple as it seems.</p>
      <a class="btn btn--outline btn--sm" href="<?php echo esc_url( home_url( '/about/' ) ); ?>">Read more</a>
    </div>
    <div class="ph-box"><img src="<?php echo esc_url( get_template_directory_uri() . '/images/photos/book-signing-1.jpg' ); ?>" alt="Ali Wren at a book signing" style="width:100%;height:100%;object-fit:cover;border-radius:8px;"></div>
  </div>
</section>

<!-- Newsletter band -->
<section class="sec sec--tight sec--dark">
  <div class="wrap sec--center">
    <p class="eyebrow eyebrow--on-dark">Join the Hollow</p>
    <h2 class="h-md" style="font-size:24px;">Get bonus chapters + first look at new releases</h2>
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
    <p class="eyebrow">On the horizon</p>
    <h2 class="h-lg">Currently writing</h2>

    <div class="horizon-grid">
      <a class="card horizon-card" href="<?php echo esc_url( home_url( '/on-the-horizon/' ) ); ?>">
        <p class="roadmap__status">In progress</p>
        <h3>Veilbound</h3>
        <p class="book-card__tag" style="color:var(--text-muted);">Book 2 · The Veiled Prophecy · Fae Fantasy Romance</p>
        <p class="txt">Vera's magic is fully awakening — and so is the prophecy counting down her remaining time. The next chapter in the Kingdom of Sylvaeris saga picks up right where Veilfall leaves off.</p>
        <div class="horizon-card__progress">
          <div class="progress-track"><div class="progress-fill" style="width:62%"></div></div>
          <span class="horizon-card__progress-label">Draft in progress · Coming Fall 2026</span>
        </div>
        <span class="series-spotlight__link">See what else is coming <span aria-hidden="true">→</span></span>
      </a>

      <a class="card horizon-card" href="<?php echo esc_url( home_url( '/on-the-horizon/' ) ); ?>">
        <p class="roadmap__status">In progress</p>
        <h3>His Northern Fixation <span style="font-weight:400;font-style:italic;color:var(--text-muted);font-size:.6em;">working title</span></h3>
        <p class="book-card__tag" style="color:var(--text-muted);">Standalone · Northfall Syndicate · Romantic Suspense</p>
        <p class="txt">Axel Halvik moved to Minnesota to protect his brother and take down his father's criminal empire — until Allyce, a single mother with a stalker closing in, becomes the one thing he can't walk away from.</p>
        <div class="horizon-card__progress">
          <div class="progress-track"><div class="progress-fill" style="width:30%"></div></div>
          <span class="horizon-card__progress-label">Early chapters · Northfall Syndicate series</span>
        </div>
        <span class="series-spotlight__link">See what else is coming <span aria-hidden="true">→</span></span>
      </a>
    </div>
  </div>
</section>

<!-- Events & appearances -->
<section class="sec sec--pink sec--dashed-top">
  <div class="wrap">
    <p class="eyebrow">Events &amp; appearances</p>
    <p class="lede">Signings, book fairs &amp; author events — where to find me next.</p>

    <div class="events-teaser-grid">
      <div>
        <p class="eyebrow" style="margin-bottom:14px;">Upcoming</p>
        <div class="card event-card">
          <div class="event-date event-date--tba">
            <div class="event-date__mon" style="color:var(--text-muted);">TBA</div>
          </div>
          <div>
            <h3>More dates TBD</h3>
            <p class="txt">New appearances are added throughout the year — check back soon.</p>
          </div>
        </div>
      </div>

      <div>
        <p class="eyebrow" style="margin-bottom:14px;">Past events</p>
        <div class="card event-card">
          <div class="event-date">
            <div class="event-date__day">11</div>
            <div class="event-date__mon">JUL</div>
          </div>
          <div>
            <h3>The Summer's Best Book Fair for Grown Ups</h3>
            <p class="txt">📍 The Grandstand, Falcon Heights, MN · 11am–7pm</p>
          </div>
        </div>
        <div class="card event-card">
          <div class="event-date">
            <div class="event-date__day">28</div>
            <div class="event-date__mon">JUN</div>
          </div>
          <div>
            <h3>Booked It! At the Brewery</h3>
            <p class="txt">📍 Sunken Ship Brewery Company, Princeton, MN · 11am–4pm</p>
          </div>
        </div>
      </div>
    </div>

    <div style="margin-top:32px;">
      <a class="btn btn--outline" href="<?php echo esc_url( home_url( '/events-appearances/' ) ); ?>">See all events &amp; appearances →</a>
    </div>
  </div>
</section>

<?php get_footer(); ?>
