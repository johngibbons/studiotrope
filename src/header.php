<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' : '; } ?><?php bloginfo('name'); ?></title>

    <link href="//www.google-analytics.com" rel="dns-prefetch">
    <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
    <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php bloginfo('description'); ?>">

    <?php wp_head(); ?>
    <script>
      conditionizr.config({
        assets: '<?php echo get_template_directory_uri(); ?>',
        tests: {}
      });
    </script>
  </head>
  <body <?php body_class(); ?>>
    <div id="view">
    <nav class="nav" role="navigation">
      <div id="nav-contents">
        <a href="<?php echo home_url(); ?>" id="nav-logo" class="no-underline">
          <img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="Logo" class="logo-img">
        </a>
        <?php html5blank_nav(); ?>
     </div>
        <div id="nav-social">
          <i class="fa fa-facebook"></i>
          <i class="fa fa-instagram"></i>
          <i class="fa fa-twitter"></i>
        </div>
    </nav>

    <header class="header clear top-fixed transition-container" role="banner">
      <button class="lines-button x arrow-left" type="button" role="button" aria-label="Toggle Navigation">
        <span class="lines"></span>
      </button>
      <div class="logo">
        <a href="<?php echo home_url(); ?>" class="no-underline">
          <img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="Logo" class="logo-img">
        </a>
      </div>
    </header>

    <div class="l-wrapper transition-container">
