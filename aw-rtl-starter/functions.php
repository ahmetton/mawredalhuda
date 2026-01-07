<?php
/**
 * AW RTL Starter - functions.php
 * Basic setup: enqueue, theme support, CPTs, customizer, AJAX contact.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/* --- Setup theme supports and registers --- */
function aw_setup() {
    load_theme_textdomain( 'aw-rtl-starter', get_template_directory() . '/languages' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'gallery', 'caption' ) );
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'aw-rtl-starter' ),
        'footer'  => __( 'Footer Menu', 'aw-rtl-starter' ),
    ) );
}
add_action( 'after_setup_theme', 'aw_setup' );

/* --- Enqueue styles and scripts --- */
function aw_assets() {
    // Main style
    wp_enqueue_style( 'aw-style', get_stylesheet_uri(), array(), filemtime( get_template_directory() . '/style.css' ) );
    // Google Font (Arabic-friendly)
    wp_enqueue_style( 'aw-fonts', 'https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;700&display=swap', array(), null );
    // Main script
    wp_enqueue_script( 'aw-main', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), '1.0', true );
    wp_localize_script( 'aw-main', 'aw_ajax', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce( 'aw_contact_nonce' ),
    ) );
    // RTL support automatically: WordPress will load rtl.css if exists.
}
add_action( 'wp_enqueue_scripts', 'aw_assets' );

/* --- Register widget areas --- */
function aw_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Footer Widget', 'aw-rtl-starter' ),
        'id'            => 'footer-1',
        'before_widget' => '<div class="footer-widget %2$s'>',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ) );
}
add_action( 'widgets_init', 'aw_widgets_init' );

/* --- Register Custom Post Types: service and portfolio --- */
function aw_register_cpts() {
    // Services
    register_post_type( 'service', array(
        'labels' => array(
            'name' => __( 'الخدمات', 'aw-rtl-starter' ),
            'singular_name' => __( 'خدمة', 'aw-rtl-starter' ),
        ),
        'public' => true,
        'has_archive' => false,
        'show_in_rest' => true,
        'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'menu_icon' => 'dashicons-hammer',
    ) );
    // Portfolio
    register_post_type( 'portfolio', array(
        'labels' => array(
            'name' => __( 'الأعمال', 'aw-rtl-starter' ),
            'singular_name' => __( 'عمل', 'aw-rtl-starter' ),
        ),
        'public' => true,
        'has_archive' => true,
        'show_in_rest' => true,
        'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'menu_icon' => 'dashicons-portfolio',
    ) );
}
add_action( 'init', 'aw_register_cpts' );

/* --- Customizer: hero settings --- */
function aw_customize_register( $wp_customize ) {
    // Section
    $wp_customize->add_section( 'aw_hero_section', array(
        'title' => __( 'Hero (الصفحة الرئيسية)', 'aw-rtl-starter' ),
        'priority' => 20,
    ) );
    // Title
    $wp_customize->add_setting( 'aw_hero_title', array( 'default' => __( 'مرحبًا بك في موقعي', 'aw-rtl-starter' ) ) );
    $wp_customize->add_control( 'aw_hero_title', array(
        'label' => __( 'عنوان الهيرو', 'aw-rtl-starter' ),
        'section' => 'aw_hero_section',
        'type' => 'text',
    ) );
    // Subtitle
    $wp_customize->add_setting( 'aw_hero_subtitle', array( 'default' => __( 'نص تعريفي موجز عن الموقع أو الشركة', 'aw-rtl-starter' ) ) );
    $wp_customize->add_control( 'aw_hero_subtitle', array(
        'label' => __( 'النص الفرعي', 'aw-rtl-starter' ),
        'section' => 'aw_hero_section',
        'type' => 'textarea',
    ) );
    // Button text & URL
    $wp_customize->add_setting( 'aw_hero_button_text', array( 'default' => __( 'اتصل بنا', 'aw-rtl-starter' ) ) );
    $wp_customize->add_control( 'aw_hero_button_text', array(
        'label' => __( 'نص الزر', 'aw-rtl-starter' ),
        'section' => 'aw_hero_section',
    ) );
    $wp_customize->add_setting( 'aw_hero_button_url', array( 'default' => '#' ) );
    $wp_customize->add_control( 'aw_hero_button_url', array(
        'label' => __( 'رابط الزر', 'aw-rtl-starter' ),
        'section' => 'aw_hero_section',
        'type' => 'url',
    ) );
    // Hero image
    $wp_customize->add_setting( 'aw_hero_image' );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'aw_hero_image', array(
        'label' => __( 'صورة الهيرو', 'aw-rtl-starter' ),
        'section' => 'aw_hero_section',
    ) ) );
}
add_action( 'customize_register', 'aw_customize_register' );

/* --- AJAX contact handler --- */
function aw_contact_handler() {
    check_ajax_referer( 'aw_contact_nonce', 'nonce' );

    $name    = sanitize_text_field( $_POST['name'] ?? '' );
    $email   = sanitize_email( $_POST['email'] ?? '' );
    $message = sanitize_textarea_field( $_POST['message'] ?? '' );

    if ( empty( $name ) || empty( $email ) || empty( $message ) ) {
        wp_send_json_error( array( 'message' => __( 'جميع الحقول مطلوبة.', 'aw-rtl-starter' ) ) );
    }

    $to = get_option( 'admin_email' );
    $subject = sprintf( __( 'رسالة من %s عبر نموذج الموقع', 'aw-rtl-starter' ), $name );
    $body = "الاسم: $name\nالبريد: $email\n\nالرسالة:\n$message";
    $headers = array( 'Content-Type: text/plain; charset=UTF-8', "Reply-To: $name <$email>" );

    $sent = wp_mail( $to, $subject, $body, $headers );

    if ( $sent ) {
        wp_send_json_success( array( 'message' => __( 'تم إرسال الرسالة بنجاح. شكراً!', 'aw-rtl-starter' ) ) );
    } else {
        wp_send_json_error( array( 'message' => __( 'حدث خطأ أثناء الإرسال. تأكد من إعداد البريد (SMTP).', 'aw-rtl-starter' ) ) );
    }
}
add_action( 'wp_ajax_nopriv_aw_contact', 'aw_contact_handler' );
add_action( 'wp_ajax_aw_contact', 'aw_contact_handler' );

/* --- Tiny helper: excerpt length in Arabic --- */
function aw_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'aw_excerpt_length', 999 );

/* --- Load RTL stylesheet automatically (if exists) --- */
function aw_rtl_styles() {
    if ( is_rtl() ) {
        wp_enqueue_style( 'aw-rtl', get_template_directory_uri() . '/rtl.css', array( 'aw-style' ), filemtime( get_template_directory() . '/rtl.css' ) );
    }
}
add_action( 'wp_enqueue_scripts', 'aw_rtl_styles' );
?>
