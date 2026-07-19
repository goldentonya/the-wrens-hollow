<?php
/**
 * Template Name: Books
 *
 * The library / showcase page: every title Ali has written, purely for
 * browsing. No prices, no add-to-cart — that lives on the Shop page
 * (archive-product.php) and on each book's own page.
 */
$wh_nav_active = 'books';
get_header();
?>

<section class="sec sec--pink">
  <div class="wrap">
    <p class="eyebrow">The Books</p>
    <h1 class="h-lg">Fierce women. Brilliant love. Stories with heart.</h1>
    <p class="lede" style="margin-top:12px;">Every book Ali has written, organized by series. Pick a title below to read more — each one has its own page, and signed copies are in the <a href="<?php echo esc_url( function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' ) ); ?>" style="color:var(--plum);font-weight:700;">shop</a>.</p>
  </div>
</section>

<section class="sec sec--dashed-top">
  <div class="wrap">
    <a class="series-block-link" href="<?php echo esc_url( home_url( '/whiskey-tango-foxtrot/' ) ); ?>">
      <p class="eyebrow">Series · Contemporary romance</p>
      <h2 class="h-md">Whiskey Tango Foxtrot <span class="series-block-link__arrow" aria-hidden="true">→</span></h2>
    </a>
    <p class="txt" style="max-width:600px;margin-bottom:24px;">Sharp banter, real heartbreak, and women who don't back down.</p>

    <div class="book-list">
      <div class="card book-showcase">
        <div class="ph-box"><img src="<?php echo esc_url( get_template_directory_uri() . '/images/covers/whiskey-and-secrets.jpg' ); ?>" alt="Whiskey &amp; Secrets book cover" style="width:100%;height:100%;object-fit:cover;border-radius:6px;"></div>
        <div class="book-showcase__body">
          <p class="book-card__tag">Book 1 · Available now</p>
          <h3>Whiskey &amp; Secrets</h3>
          <p class="txt">Some secrets are worth the hangover. Fierce, funny, unforgettable contemporary romance — sharp banter, real heartbreak, and a heroine who doesn't back down.</p>
          <a class="btn" href="<?php echo esc_url( home_url( '/whiskey-and-secrets/' ) ); ?>">View this book →</a>
        </div>
      </div>
      <div class="card book-showcase">
        <div class="ph-box"><img src="<?php echo esc_url( get_template_directory_uri() . '/images/covers/whiskey-and-lies.jpg' ); ?>" alt="Whiskey &amp; Lies book cover" style="width:100%;height:100%;object-fit:cover;border-radius:6px;"></div>
        <div class="book-showcase__body">
          <p class="book-card__tag">Book 2 · Available now</p>
          <h3>Whiskey &amp; Lies</h3>
          <p class="txt">Every relationship has a few secrets. Hers might be unforgivable. Includes bonus chapters for readers who finish the book.</p>
          <a class="btn" href="<?php echo esc_url( home_url( '/whiskey-and-lies/' ) ); ?>">View this book →</a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="sec sec--cream sec--dashed-top">
  <div class="wrap">
    <a class="series-block-link" href="<?php echo esc_url( home_url( '/the-veiled-prophecy/' ) ); ?>">
      <p class="eyebrow">Series · Fantasy · Kingdom of Sylvaeris</p>
      <h2 class="h-md">The Veiled Prophecy <span class="series-block-link__arrow" aria-hidden="true">→</span></h2>
    </a>
    <p class="txt" style="max-width:600px;margin-bottom:24px;">A world of secrets, prophecy, and dangerous love.</p>

    <div class="book-list">
      <div class="card book-showcase">
        <div class="ph-box"><img src="<?php echo esc_url( get_template_directory_uri() . '/images/covers/veilfall.jpg' ); ?>" alt="Veilfall book cover" style="width:100%;height:100%;object-fit:cover;object-position:top;border-radius:6px;"></div>
        <div class="book-showcase__body">
          <p class="book-card__tag">Book 1 · Free</p>
          <h3>Veilfall</h3>
          <p class="txt">She thought she was human. The fae realm knows better. Start Veralyn's story with this dark fae fantasy romance.</p>
          <a class="btn" href="<?php echo esc_url( home_url( '/veilfall/' ) ); ?>">View this book →</a>
        </div>
      </div>
      <div class="card book-showcase">
        <div class="ph-box"><img src="<?php echo esc_url( get_template_directory_uri() . '/images/covers/veilbound.jpg' ); ?>" alt="Veilbound book cover" style="width:100%;height:100%;object-fit:cover;border-radius:6px;"></div>
        <div class="book-showcase__body">
          <p class="book-card__tag">Book 2 · Coming soon</p>
          <h3>Veilbound</h3>
          <p class="txt">The next chapter in the Kingdom of Sylvaeris saga — the fate of the kingdom, and her heart, hangs in the balance.</p>
          <a class="btn" href="<?php echo esc_url( home_url( '/veilbound/' ) ); ?>">View this book →</a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="sec sec--center">
  <div class="wrap">
    <p class="txt" style="margin:0;">Prefer your e-reader? <a href="https://www.amazon.com/s?k=ali+wren+author" target="_blank" rel="noopener" style="color:var(--plum);font-weight:700;">Find every title on Amazon →</a></p>
  </div>
</section>

<?php get_footer(); ?>
