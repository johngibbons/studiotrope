<header class="header clear top-fixed transition-container" role="banner">
  <button class="lines-button x arrow-left" type="button" role="button" aria-label="Toggle Navigation">
    <span class="lines"></span>
  </button>
  <div class="logo">
    <a href="<?php echo home_url(); ?>" class="no-underline">
      <img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="Logo" class="logo-img">
    </a>
  </div>
  <div id="header-search">
    <?php get_search_form(true); ?>
    <i class="fa fa-ellipsis-v close-btn"></i>
  </div>
</header>
