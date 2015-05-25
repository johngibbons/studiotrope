<?php get_header(); ?>
<div class="l-sidebar">
  <?php get_template_part("header-items"); ?>
  <?php get_template_part("sidebar_selector"); ?>
</div>

  <main role="main">
    <h1 class="page-title mobile-control-bar l-wide l-left is-fixed-mobile title-text l-container-w-side last"><?php _e( 'All Projects', 'html5blank' ); ?></h1>
    <div class="l-container-w-side last">
      <section id="projects-index" class="container">
        <?php get_template_part('loop-project'); ?>
      </section>
      <section id="projects-navigation">
        <?php get_template_part('pagination'); ?>
      </section>
    </div>
  </main>
<?php get_footer(); ?>
