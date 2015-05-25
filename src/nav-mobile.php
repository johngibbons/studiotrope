<nav id="nav-mobile" role="navigation">
  <div id="nav-contents">
    <a href="<?php echo home_url(); ?>" id="nav-logo" class="no-underline">
      <img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="Logo" class="logo-img">
    </a>
    <?php get_search_form(true); ?>
    <?php html5blank_nav(); ?>
    <div id="nav-social">
      <i class="fa fa-facebook"></i>
      <i class="fa fa-instagram"></i>
      <i class="fa fa-twitter"></i>
    </div>
  </div>
</nav>
