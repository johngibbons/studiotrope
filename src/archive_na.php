<?php get_header(); ?>

  <?php get_template_part("contextual-module"); ?>
  <main class="l-container-w-side" role="main">
    <!-- section -->
    <section>

      <h1><?php _e( 'Archives', 'html5blank' ); ?></h1>

      <?php get_template_part('loop-project'); ?>
      <?php get_template_part('loop-troper'); ?>
      <?php get_template_part('loop'); ?>

      <?php get_template_part('pagination'); ?>

    </section>
    <!-- /section -->
  </main>

<?php get_footer(); ?>
