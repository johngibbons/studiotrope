<?php get_header(); ?>
  <main role="main">
    <h1 class="page-title mobile-control-bar l-wide l-left is-fixed-mobile title-text l-container-w-side last"><?php _e( 'All Projects', 'html5blank' ); ?></h1>
    <section id="projects-filter-container" class="mobile-control-bar l-sidebar l-narrow l-right is-fixed-mobile">
      <?php get_template_part("projects-filter"); ?>
    </section>
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
