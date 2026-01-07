<?php
/**
 * Header template - uses template-part for branding
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>
  <header class="site-header">
    <div class="container">
      <?php get_template_part( 'template-parts/header/site', 'branding' ); ?>
    </div>
  </header>

  <main id="site-content" role="main" class="container">

<?php
?>
