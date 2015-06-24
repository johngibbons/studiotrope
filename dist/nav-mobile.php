<nav id="nav-mobile" role="navigation">
  <div id="nav-contents">
    <a href="<?php echo home_url(); ?>" id="nav-logo" class="no-underline">
      <img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="Logo" class="logo-img">
    </a>
    <?php get_search_form(true); ?>
    <?php html5blank_nav(); ?>
    <div id="nav-social">
      <?php if (get_field("facebook_link", "option")): ?>
        <a href="<?php the_field("facebook_link", "option"); ?>" target="_blank">
          <i class="fa fa-facebook-official"></i>
        </a>
      <?php endif; ?>
      <?php if (get_field("instagram_link", "option")): ?>
        <a href="<?php the_field("instagram_link", "option"); ?>" target="_blank">
          <i class="fa fa-instagram"></i>
        </a>
      <?php endif; ?>
      <?php if (get_field("twitter_link", "option")): ?>
        <a href="<?php the_field("twitter_link", "option"); ?>" target="_blank">
          <i class="fa fa-twitter-square"></i>
        </a>
      <?php endif; ?>
    </div>

  </div>
</nav>
