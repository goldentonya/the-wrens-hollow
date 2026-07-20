</main>

<footer class="site-footer">
  <div class="wrap">
    <div class="footer-grid">
      <div class="footer-brand">
        <a class="footer-brand__link" href="<?php echo esc_url( home_url( '/' ) ); ?>">
          <img class="footer-mark" src="<?php echo esc_url( wh_logo_url() ); ?>" alt="Ali Wren logo" width="700" height="290">
          <span class="footer-brand__word">
            <span class="footer-brand__title">THE WREN'S HOLLOW</span>
            <span class="footer-brand__sub">Ali Wren &middot; Author</span>
          </span>
        </a>
        <p class="footer-tagline"><?php echo esc_html( wh_footer_tagline() ); ?></p>
      </div>

      <div class="footer-col">
        <h3 class="footer-col__title">Explore</h3>
        <nav class="footer-links">
          <?php
          wp_nav_menu(
          	array(
          		'theme_location' => 'footer',
          		'container'      => false,
          		'items_wrap'     => '%3$s',
          		'walker'         => new Wrens_Hollow_Footer_Walker(),
          		'fallback_cb'    => 'wrens_hollow_footer_nav_fallback',
          	)
          );
          ?>
        </nav>
      </div>

      <div class="footer-col">
        <h3 class="footer-col__title">Follow</h3>
        <div class="soc soc--icons soc--dark">
          <a href="<?php echo esc_url( wh_social( 'facebook' ) ); ?>" target="_blank" rel="noopener" aria-label="Facebook">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M22 12.06C22 6.5 17.52 2 12 2S2 6.5 2 12.06c0 5.02 3.66 9.18 8.44 9.94v-7.03H7.9v-2.91h2.54V9.85c0-2.51 1.49-3.9 3.77-3.9 1.09 0 2.24.2 2.24.2v2.46H15.2c-1.24 0-1.63.77-1.63 1.56v1.89h2.78l-.44 2.91h-2.34V22c4.78-.76 8.44-4.92 8.44-9.94Z"/></svg>
            <span class="sr-only">Facebook</span>
          </a>
          <a href="<?php echo esc_url( wh_social( 'instagram' ) ); ?>" target="_blank" rel="noopener" aria-label="Instagram">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2c2.72 0 3.06.01 4.12.06 1.06.05 1.79.22 2.43.47.66.26 1.22.6 1.77 1.15.55.55.9 1.11 1.15 1.77.25.64.42 1.37.47 2.43.05 1.06.06 1.4.06 4.12s-.01 3.06-.06 4.12c-.05 1.06-.22 1.79-.47 2.43a4.9 4.9 0 0 1-1.15 1.77 4.9 4.9 0 0 1-1.77 1.15c-.64.25-1.37.42-2.43.47-1.06.05-1.4.06-4.12.06s-3.06-.01-4.12-.06c-1.06-.05-1.79-.22-2.43-.47a4.9 4.9 0 0 1-1.77-1.15 4.9 4.9 0 0 1-1.15-1.77c-.25-.64-.42-1.37-.47-2.43C2.01 15.06 2 14.72 2 12s.01-3.06.06-4.12c.05-1.06.22-1.79.47-2.43.26-.66.6-1.22 1.15-1.77A4.9 4.9 0 0 1 5.45.53C6.09.28 6.82.11 7.88.06 8.94.01 9.28 0 12 0Zm0 5a5 5 0 1 0 0 10 5 5 0 0 0 0-10Zm0 8.2a3.2 3.2 0 1 1 0-6.4 3.2 3.2 0 0 1 0 6.4Zm5.2-8.4a1.17 1.17 0 1 0 0-2.34 1.17 1.17 0 0 0 0 2.34Z"/></svg>
            <span class="sr-only">Instagram</span>
          </a>
          <a href="<?php echo esc_url( wh_social( 'tiktok' ) ); ?>" target="_blank" rel="noopener" aria-label="TikTok">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M16.6 5.82c-.9-.98-1.4-2.26-1.4-3.57h-3.15v13.7c0 1.55-1.26 2.8-2.8 2.8a2.8 2.8 0 0 1-2.8-2.8 2.8 2.8 0 0 1 2.8-2.8c.29 0 .57.04.83.13V9.94a6.02 6.02 0 0 0-.83-.06 6 6 0 0 0-6 6 6 6 0 0 0 6 6 6 6 0 0 0 6-6V8.98a8.3 8.3 0 0 0 4.85 1.56V7.4a4.8 4.8 0 0 1-3.5-1.58Z"/></svg>
            <span class="sr-only">TikTok</span>
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
    </div>

    <div class="footer-bottom">
      <p>&copy; <?php echo esc_html( date( 'Y' ) ); ?> Ali Wren. All rights reserved.</p>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
