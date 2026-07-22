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
    <p class="eyebrow"><?php wh_the( 'books_eyebrow', 'The Books' ); ?></p>
    <h1 class="h-lg"><?php wh_the( 'books_title', 'Fierce women. Brilliant love. Stories with heart.' ); ?></h1>
    <p class="lede" style="margin-top:12px;"><?php wh_the( 'books_lede', 'Every book Ali has written, organized by series. Pick a title below to read more' ); ?> — each one has its own page, and signed copies are in the <a href="<?php echo esc_url( function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' ) ); ?>" style="color:var(--plum);font-weight:700;">shop</a>.</p>
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
      <?php foreach ( wh_books( 'whiskey-tango-foxtrot' ) as $wh_book_post ) { wh_render_book_showcase( $wh_book_post ); } ?>
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
      <?php foreach ( wh_books( 'veiled-prophecy' ) as $wh_book_post ) { wh_render_book_showcase( $wh_book_post ); } ?>
    </div>
  </div>
</section>

<section class="sec sec--center">
  <div class="wrap">
    <p class="txt" style="margin:0;">Prefer your e-reader? <a href="https://www.amazon.com/s?k=ali+wren+author" target="_blank" rel="noopener" style="color:var(--plum);font-weight:700;">Find every title on Amazon →</a></p>
  </div>
</section>

<?php get_footer(); ?>
