<?php get_header(); ?>
  <h1><?php _e( 'All Projects', 'html5blank' ); ?></h1>
  <main role="main">
    <div class="l-container-w-side last">
      <section id="projects-index" class="container">
        <?php get_template_part('loop-project'); ?>
      </section>
      <section id="projects-navigation">
        <?php get_template_part('pagination'); ?>
      </section>
    </div>
  </main>
<?php get_template_part("contextual-module"); ?>
<?php get_footer(); ?>
