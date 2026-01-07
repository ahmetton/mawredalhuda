<?php
/**
 * Site branding template part
 */
?>
<div class="site-branding">
  <div class="site-logo">
    <?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) :
      the_custom_logo();
    else: ?>
      <a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
      <p class="site-description"><?php bloginfo( 'description' ); ?></p>
    <?php endif; ?>
  </div>

  <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'aw-rtl-starter' ); ?></button>

  <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="Primary Menu">
    <?php
      wp_nav_menu( array(
        'theme_location' => 'primary',
        'menu_id' => 'primary-menu',
      ) );
    ?>
  </nav>
</div>
