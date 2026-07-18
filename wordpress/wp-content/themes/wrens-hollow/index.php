<?php
/**
 * Fallback template (required by WordPress). Every page on this site uses a
 * more specific template (front-page.php, page-*.php, archive-product.php);
 * this only renders if a page exists without one of those.
 */
$wh_nav_active = '';
get_header();
?>

<section class="sec">
  <div class="wrap">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <h1 class="h-lg"><?php the_title(); ?></h1>
      <div class="txt"><?php the_content(); ?></div>
    <?php endwhile; endif; ?>
  </div>
</section>

<?php get_footer(); ?>
