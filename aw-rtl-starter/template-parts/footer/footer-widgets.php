<?php
/**
 * Footer widgets template part
 */
?>
<div class="footer-widgets">
  <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
    <?php dynamic_sidebar( 'footer-1' ); ?>
  <?php else : ?>
    <div class="footer-widget">
      <h4 class="widget-title"><?php esc_html_e( 'About', 'aw-rtl-starter' ); ?></h4>
      <p><?php esc_html_e( 'Add widgets to the footer widget area from the Customizer.', 'aw-rtl-starter' ); ?></p>
    </div>
  <?php endif; ?>
</div>
