<?php
/**
 * Theme functions and definitions - aw-rtl-starter (enhanced)
 */

if ( ! function_exists( 'aw_rtl_starter_setup' ) ) :
  function aw_rtl_starter_setup() {
    /* Make theme available for translation */
    load_theme_textdomain( 'aw-rtl-starter', get_template_directory() . '/languages' );

    /* Add support for post thumbnails */
    add_theme_support( 'post-thumbnails' );

    /* Title tag */
    add_theme_support( 'title-tag' );

    /* Register menu */
    register_nav_menus( array(
      'primary' => __( 'Primary Menu', 'aw-rtl-starter' ),
    ) );
  }
endif;
add_action( 'after_setup_theme', 'aw_rtl_starter_setup' );

/**
 * Enqueue styles and scripts and add inline CSS variables from Customizer
 */
function aw_rtl_starter_enqueue_assets(){
  $theme = wp_get_theme();
  wp_enqueue_style( 'aw-rtl-starter-style', get_template_directory_uri() . '/assets/css/style.css', array(), $theme->get( 'Version' ) );

  // Get color options from customizer
  $primary = get_theme_mod( 'aw_primary_color', '#0d6efd' );
  $accent  = get_theme_mod( 'aw_accent_color', '#6610f2' );
  $bg      = get_theme_mod( 'aw_background_color', '#ffffff' );

  $custom_css =  ":root{ --color-primary: " . esc_attr( $primary ) . "; --color-accent: " . esc_attr( $accent ) . "; --color-bg: " . esc_attr( $bg ) . "; }";
  wp_add_inline_style( 'aw-rtl-starter-style', $custom_css );

  wp_enqueue_script( 'aw-rtl-starter-main', get_template_directory_uri() . '/assets/js/main.js', array(), $theme->get( 'Version' ), true );
}
add_action( 'wp_enqueue_scripts', 'aw_rtl_starter_enqueue_assets' );

/**
 * Customizer: add color controls
 */
function aw_rtl_starter_customize_register( $wp_customize ){
  // Colors section
  $wp_customize->add_section( 'aw_colors', array(
    'title' => __( 'Theme Colors', 'aw-rtl-starter' ),
    'priority' => 30,
  ) );

  // Primary color
  $wp_customize->add_setting( 'aw_primary_color', array(
    'default' => '#0d6efd',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'refresh',
  ) );
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'aw_primary_color_control', array(
    'label' => __( 'Primary Color', 'aw-rtl-starter' ),
    'section' => 'aw_colors',
    'settings' => 'aw_primary_color',
  ) ) );

  // Accent color
  $wp_customize->add_setting( 'aw_accent_color', array(
    'default' => '#6610f2',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'refresh',
  ) );
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'aw_accent_color_control', array(
    'label' => __( 'Accent Color', 'aw-rtl-starter' ),
    'section' => 'aw_colors',
    'settings' => 'aw_accent_color',
  ) ) );

  // Background color
  $wp_customize->add_setting( 'aw_background_color', array(
    'default' => '#ffffff',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'refresh',
  ) );
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'aw_background_color_control', array(
    'label' => __( 'Background Color', 'aw-rtl-starter' ),
    'section' => 'aw_colors',
    'settings' => 'aw_background_color',
  ) ) );
}
add_action( 'customize_register', 'aw_rtl_starter_customize_register' );

/**
 * Register widget areas (footer)
 */
function aw_rtl_starter_widgets_init(){
  register_sidebar( array(
    'name' => __( 'Footer Widget Area', 'aw-rtl-starter' ),
    'id' => 'footer-1',
    'description' => __( 'Widgets for the footer area', 'aw-rtl-starter' ),
    'before_widget' => '<div class="footer-widget">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4 class="widget-title">',
    'after_title'   => '</h4>',
  ) );
}
add_action( 'widgets_init', 'aw_rtl_starter_widgets_init' );

?>
