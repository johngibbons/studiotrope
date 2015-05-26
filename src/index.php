<?php get_header(); ?>

  <main class="l-container-w-side" role="main">
    <!-- section -->
    <section>

      <h1><?php _e( 'Latest Posts', 'html5blank' ); ?></h1>

      <?php get_template_part('loop'); ?>

      <?php get_template_part('pagination'); ?>

    </section>
    <!-- /section -->
  </main>

<?php get_template_part("contextual-module"); ?>

<?php get_footer(); ?>
