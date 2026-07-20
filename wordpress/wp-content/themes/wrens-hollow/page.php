<?php
/**
 * Generic Page fallback. Every existing page uses one of the specific
 * page-*.php templates (or front-page.php); this only renders for a brand-new
 * page created without picking a template — e.g. via Pages > Add New, before
 * assigning one. Prints the title and the block-editor content inside the
 * site's standard section wrapper so it looks at home with the rest of the
 * site rather than bare/unstyled.
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
