<?php
/**
 * Footer template
 */
?>
</main><!-- #site-content -->

<footer class="site-footer">
  <div class="container footer-inner">
    <div class="footer-widgets">
      <?php if ( is_active_sidebar( 'footer-1' ) ) { dynamic_sidebar( 'footer-1' ); } else { ?>
      <div class="footer-widget">
        <h4><?php _e( 'نبذة', 'aw-rtl-starter' ); ?></h4>
        <p><?php _e( 'أضف ويدجيت هنا من المظهر → الأدوات', 'aw-rtl-starter' ); ?></p>
      </div>
      <?php } ?>
    </div>
    <div class="site-info">
      <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?> — <?php _e( 'جميع الحقوق محفوظة', 'aw-rtl-starter' ); ?></p>
      <?php
      wp_nav_menu( array(
        'theme_location' => 'footer',
        'container' => false,
        'menu_class' => 'footer-menu',
      ) );
      ?>
    </div>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
