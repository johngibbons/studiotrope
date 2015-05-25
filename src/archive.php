<?php get_header(); ?>
<?php get_template_part("contextual-module"); ?>

  <main role="main">
    <!-- section -->
    <section>

      <h1><?php _e( 'Archives', 'html5blank' ); ?></h1>

      <?php get_template_part('loop'); ?>

      <?php get_template_part('pagination'); ?>

    </section>
    <!-- /section -->
  </main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
