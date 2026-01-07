<?php
/**
 * Footer template - uses template-part for footer widgets
 */
?>
  </main><!-- #site-content -->

  <footer class="site-footer">
    <div class="container">
      <?php get_template_part( 'template-parts/footer/footer', 'widgets' ); ?>
      <div class="align-center" style="margin-top:1rem;">
        <small>&copy; <?php echo date_i18n( get_option( 'date_format' ) ); ?> <?php bloginfo( 'name' ); ?></small>
      </div>
    </div>
  </footer>

<?php wp_footer(); ?>
</body>
</html>
