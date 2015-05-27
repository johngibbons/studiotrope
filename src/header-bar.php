<header id="header-bar" role="banner">
  <div id="nav-open-overlay"></div>
  <button id="nav-toggle" class="lines-button x" type="button" role="button" data-label="nav-toggle">
    <span class="lines"></span>
  </button>
  <a href="<?php echo home_url(); ?>" class="logo">
    <img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="Logo" class="logo-img">
  </a>
  <?php get_template_part("nav-regular"); ?>
  <div id="header-search">
    <?php get_search_form(true); ?>
    <i class="fa fa-ellipsis-v close-btn"></i>
  </div>
</header>
