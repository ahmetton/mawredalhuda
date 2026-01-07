<?php
/**
 * Archive template for Portfolio custom post type
 */
get_header();
?>
<article class="archive-portfolio">
  <header class="archive-header">
    <h1 class="archive-title"><?php post_type_archive_title(); ?></h1>
  </header>

  <section class="portfolio-grid">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class('portfolio-item'); ?> >
        <?php if ( has_post_thumbnail() ) : ?>
          <a class="portfolio-link" href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail( 'medium', array( 'class' => 'portfolio-thumb' ) ); ?>
          </a>
        <?php endif; ?>
        <div class="portfolio-content">
          <h2 class="portfolio-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
          <div class="portfolio-excerpt"><?php the_excerpt(); ?></div>
        </div>
      </article>
    <?php endwhile; else: ?>
      <p><?php esc_html_e( 'No portfolio items found.', 'aw-rtl-starter' ); ?></p>
    <?php endif; wp_reset_postdata(); ?>
  </section>

</article>

<?php get_footer(); ?>
