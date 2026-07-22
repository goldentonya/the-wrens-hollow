<?php
/**
 * Template Name: About
 */
$wh_nav_active = 'about';
get_header();
?>

<section class="sec sec--pink">
  <div class="wrap bio-row">
    <div class="ph-box"><?php wh_img( 'about_portrait', 'images/photos/ali-wren-portrait.jpg', 'Ali Wren author portrait', 'style="width:260px;height:346px;object-fit:cover;border-radius:8px;"' ); ?></div>
    <div>
      <p class="eyebrow">Behind the pen</p>
      <p class="bio-greeting">
        <?php wh_the( 'about_greeting', 'Welcome!' ); ?>
        <svg class="bio-greeting__swash" viewBox="0 0 160 14" aria-hidden="true"><path d="M2 9c20-10 40-10 60-2s40 8 60-2 30-5 34 1" /></svg>
      </p>
      <h1 class="h-lg bio-name"><?php wh_the( 'about_name', "I'm Ali Wren" ); ?></h1>
      <p class="txt" style="margin-top:6px;"><?php wh_the( 'about_tagline', 'Indie author · Minnesota · romance & fantasy.' ); ?></p>
    </div>
  </div>
</section>

<section class="sec">
  <div class="wrap about-columns">
    <aside class="about-columns__aside">
      <div class="aside-card">
        <h3><?php wh_the_page_field( 'facts_heading', 'A few things about me' ); ?></h3>
        <div class="aside-card__facts">
          <?php foreach ( wh_facts() as $wh_fact ) { wh_render_fact( $wh_fact ); } ?>
        </div>
      </div>
      <div class="aside-card">
        <h3>Follow along</h3>
        <div class="soc soc--light soc--icons">
          <a href="<?php echo esc_url( wh_social( 'facebook' ) ); ?>" target="_blank" rel="noopener" aria-label="Facebook">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M22 12.06C22 6.5 17.52 2 12 2S2 6.5 2 12.06c0 5.02 3.66 9.18 8.44 9.94v-7.03H7.9v-2.91h2.54V9.85c0-2.51 1.49-3.9 3.77-3.9 1.09 0 2.24.2 2.24.2v2.46H15.2c-1.24 0-1.63.77-1.63 1.56v1.89h2.78l-.44 2.91h-2.34V22c4.78-.76 8.44-4.92 8.44-9.94Z"/></svg>
            <span class="sr-only">Facebook</span>
          </a>
          <a href="<?php echo esc_url( wh_social( 'tiktok' ) ); ?>" target="_blank" rel="noopener" aria-label="TikTok">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M16.6 5.82c-.9-.98-1.4-2.26-1.4-3.57h-3.15v13.7c0 1.55-1.26 2.8-2.8 2.8a2.8 2.8 0 0 1-2.8-2.8 2.8 2.8 0 0 1 2.8-2.8c.29 0 .57.04.83.13V9.94a6.02 6.02 0 0 0-.83-.06 6 6 0 0 0-6 6 6 6 0 0 0 6 6 6 6 0 0 0 6-6V8.98a8.3 8.3 0 0 0 4.85 1.56V7.4a4.8 4.8 0 0 1-3.5-1.58Z"/></svg>
            <span class="sr-only">TikTok</span>
          </a>
          <a href="<?php echo esc_url( wh_social( 'instagram' ) ); ?>" target="_blank" rel="noopener" aria-label="Instagram">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2c-2.72 0-3.06.01-4.12.06-1.06.05-1.79.22-2.43.47-.66.26-1.22.6-1.77 1.16-.56.55-.9 1.11-1.16 1.77-.25.64-.42 1.37-.47 2.43C2 8.94 2 9.28 2 12s.01 3.06.06 4.12c.05 1.06.22 1.79.47 2.43.26.66.6 1.22 1.16 1.77.55.56 1.11.9 1.77 1.16.64.25 1.37.42 2.43.47C8.94 22 9.28 22 12 22s3.06-.01 4.12-.06c1.06-.05 1.79-.22 2.43-.47.66-.26 1.22-.6 1.77-1.16.56-.55.9-1.11 1.16-1.77.25-.64.42-1.37.47-2.43.05-1.06.06-1.4.06-4.12s-.01-3.06-.06-4.12c-.05-1.06-.22-1.79-.47-2.43a4.9 4.9 0 0 0-1.16-1.77 4.9 4.9 0 0 0-1.77-1.16c-.64-.25-1.37-.42-2.43-.47C15.06 2.01 14.72 2 12 2Zm0 1.8c2.67 0 2.99.01 4.04.06.98.04 1.5.2 1.86.34.47.18.8.4 1.15.75.35.35.57.68.75 1.15.14.36.3.88.34 1.86.05 1.05.06 1.37.06 4.04s-.01 2.99-.06 4.04c-.04.98-.2 1.5-.34 1.86-.18.47-.4.8-.75 1.15-.35.35-.68.57-1.15.75-.36.14-.88.3-1.86.34-1.05.05-1.37.06-4.04.06s-2.99-.01-4.04-.06c-.98-.04-1.5-.2-1.86-.34a3.1 3.1 0 0 1-1.15-.75 3.1 3.1 0 0 1-.75-1.15c-.14-.36-.3-.88-.34-1.86C3.81 14.99 3.8 14.67 3.8 12s.01-2.99.06-4.04c.04-.98.2-1.5.34-1.86.18-.47.4-.8.75-1.15.35-.35.68-.57 1.15-.75.36-.14.88-.3 1.86-.34C9.01 3.81 9.33 3.8 12 3.8Zm0 3.15a5.05 5.05 0 1 0 0 10.1 5.05 5.05 0 0 0 0-10.1Zm0 8.33a3.28 3.28 0 1 1 0-6.56 3.28 3.28 0 0 1 0 6.56Zm5.24-8.53a1.18 1.18 0 1 1-2.36 0 1.18 1.18 0 0 1 2.36 0Z"/></svg>
            <span class="sr-only">Instagram</span>
          </a>
          <a href="<?php echo esc_url( wh_social( 'goodreads' ) ); ?>" target="_blank" rel="noopener" aria-label="Goodreads">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3c-2.5-1.5-5.5-1.5-8 0v15.5c2.5-1.5 5.5-1.5 8 0V3Zm0 0c2.5-1.5 5.5-1.5 8 0v15.5c-2.5-1.5-5.5-1.5-8 0V3Z"/></svg>
            <span class="sr-only">Goodreads</span>
          </a>
          <a href="<?php echo esc_url( wh_social( 'amazon' ) ); ?>" target="_blank" rel="noopener" aria-label="Amazon">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M7 4a5 5 0 0 1 10 0h2a1 1 0 0 1 1 .96l1 14A2 2 0 0 1 19 21H5a2 2 0 0 1-2-2.04l1-14A1 1 0 0 1 5 4h2Zm2 0h6a3 3 0 0 0-6 0ZM6.96 6 6.07 19h11.86L17.04 6H15v2a1 1 0 0 1-2 0V6h-2v2a1 1 0 0 1-2 0V6H6.96Z"/></svg>
            <span class="sr-only">Amazon</span>
          </a>
        </div>
      </div>
    </aside>
    <div>
      <div class="wh-rte"><?php wh_wysiwyg( 'bio_intro', wh_default( 'field_wh_ab_bio_intro' ) ); ?></div>
      <p class="pull-quote"><?php wh_the( 'bio_pullquote', wh_default( 'field_wh_ab_bio_pullquote' ) ); ?></p>
      <div class="wh-rte"><?php wh_wysiwyg( 'bio_more', wh_default( 'field_wh_ab_bio_more' ) ); ?></div>
    </div>
  </div>
</section>

<section class="sec sec--cream sec--dashed-top">
  <div class="wrap sec--center">
    <p class="eyebrow"><?php wh_the_page_field( 'journey_eyebrow', 'My Journey' ); ?></p>
    <h2 class="h-lg"><?php wh_the_page_field( 'journey_heading', 'The Road So Far' ); ?></h2>
  </div>
  <div class="wrap">
    <div class="timeline">
      <?php
      $wh_milestones = wh_milestones();
      foreach ( $wh_milestones as $wh_i => $wh_milestone ) {
        wh_render_milestone( $wh_milestone, $wh_i );
      }
      ?>
    </div>
  </div>
</section>

<section class="sec sec--cream2">
  <div class="wrap grid-2 contact-grid">
    <div>
      <p class="eyebrow"><?php wh_the( 'connect_eyebrow', 'Join the Hollow' ); ?></p>
      <h2 class="h-lg" style="color:var(--plum-deep);"><?php wh_the( 'connect_heading', "Let's Stay Connected" ); ?></h2>
      <p class="txt" style="margin-top:14px;"><?php wh_the( 'connect_body', 'Love strong heroines, slow-burn romance, and a little bit of danger? Sign up for my newsletter and get bonus chapters plus first look at new releases, behind-the-scenes peeks, character deep-dives, and updates straight to your inbox.' ); ?></p>
      <form class="newsletter-form" id="newsletterForm">
        <input class="field" type="email" placeholder="your@email.com" required aria-label="Email address">
        <button class="btn" type="submit">Subscribe</button>
      </form>
      <p class="form-status" id="newsletterStatus"></p>
      <p class="form-note">Free. No spam. Unsubscribe anytime.</p>
    </div>
    <div>
      <p class="eyebrow"><?php wh_the( 'hello_eyebrow', 'Say hello' ); ?></p>
      <h2 class="h-lg" style="color:var(--plum-deep);"><?php wh_the( 'hello_heading', "I'd Love to Hear from You!" ); ?></h2>
      <p class="txt" style="margin-top:14px;"><?php wh_the( 'hello_body', "Whether you're a fellow reader, a book club, a blogger, or just curious about my writing—drop a note below!" ); ?></p>
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
    </div>
  </div>
</section>

<?php get_footer(); ?>
