<?php
/**
 * Header template
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header class="site-header">
  <div class="container header-inner">
    <div class="site-branding">
      <?php
      if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
        the_custom_logo();
      } else {
        echo '<a class="site-title" href="' . esc_url( home_url('/') ) . '">' . get_bloginfo('name') . '</a>';
      }
      ?>
    </div>
    <nav class="site-nav">
      <?php
      wp_nav_menu( array(
        'theme_location' => 'primary',
        'container' => false,
        'menu_class' => 'main-menu',
      ) );
      ?>
      <button class="menu-toggle" aria-expanded="false"><?php _e( 'القائمة', 'aw-rtl-starter' ); ?></button>
    </nav>
  </div>
</header>
<main id="site-content" class="site-content">
