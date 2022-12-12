<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->

<head>

  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!--[if IE 9]>
    <link href="https://cdn.jsdelivr.net/gh/coliff/bootstrap-ie8/css/bootstrap-ie9.min.css" rel="stylesheet">
  <![endif]-->
  <!--[if lte IE 8]>
    <link href="https://cdn.jsdelivr.net/gh/coliff/bootstrap-ie8/css/bootstrap-ie8.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/g/html5shiv@3.7.3"></script>
  <![endif]-->

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="wrap">
  <header id="header">
    <section class="container">
      <div class="row">
        <div class="col-12">
          <a href="<?php echo home_url(); ?>" class="header-logo"><img src="<?php bloginfo('template_directory'); ?>/images/logo.svg"/></a>
          <?php wp_nav_menu( array('theme_location' => 'main-menu', 'container' => 'nav','container_class' => 'main-menu d-none d-lg-block','walker' => new megaMenu())); ?>
          <a class="d-inline-block d-lg-none navToggle" data-bs-toggle="offcanvas" href="#offcanvasMobileMenu" role="button" aria-controls="offcanvasMobileMenu"><i class="fa-solid fa-bars"></i></a>
        </div>
      </div>
    </section>
  </header>

  <!-- Mobile Nav -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasMobileMenu" aria-labelledby="offcanvasMobileMenuLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasMobileMenuLabel"><img src="<?php bloginfo('template_directory'); ?>/images/logo.svg"/></h5>
      <button type="button" class="text-reset" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-light fa-xmark"></i></button>
    </div>
    <div class="offcanvas-body" id="mobileNav">
      <?php wp_nav_menu( array('theme_location' => 'main-menu', 'container' => 'nav', 'container_class' => 'mobile-main-menu ')); ?>
    </div>
  </div>
  <!-- end Mobile Nav -->
