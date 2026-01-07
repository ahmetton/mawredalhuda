<?php
/**
 * Single post template (works for blog posts and CPTs)
 */
get_header();
if ( have_posts() ) :
  while ( have_posts() ) : the_post(); ?>
    <article <?php post_class(); ?>>
      <header class="entry-header">
        <h1><?php the_title(); ?></h1>
        <div class="entry-meta"><?php the_date(); ?></div>
      </header>
      <div class="entry-content"><?php the_content(); ?></div>
      <footer class="entry-footer">
        <?php the_tags(); ?>
      </footer>
    </article>
  <?php endwhile;
endif;
get_footer();
