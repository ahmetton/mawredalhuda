<?php
/**
 * Single template for Portfolio custom post type
 */
get_header();
?>
<article class="single-portfolio">
  <?php while ( have_posts() ) : the_post(); ?>

    <header class="entry-header">
      <h1 class="entry-title"><?php the_title(); ?></h1>
    </header>

    <div class="entry-content">
      <?php if ( has_post_thumbnail() ) : ?>
        <div class="portfolio-featured">
          <?php the_post_thumbnail( 'large' ); ?>
        </div>
      <?php endif; ?>

      <div class="portfolio-description">
        <?php the_content(); ?>
      </div>

      <nav class="portfolio-meta">
        <a href="<?php echo esc_url( get_post_type_archive_link( 'portfolio' ) ); ?>"><?php esc_html_e( 'Back to portfolio', 'aw-rtl-starter' ); ?></a>
      </nav>

    </div>

  <?php endwhile; ?>
</article>

<?php get_footer(); ?>
