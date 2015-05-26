<?php get_header(); ?>
<main class="l-container-w-side" role="main">
  <section id="people-index">
    <h1><?php _e( 'People', 'html5blank' ); ?></h1>
    <?php get_template_part('loop-troper'); ?>
    <?php get_template_part('pagination'); ?>
  </section>
</main>
<?php get_template_part("contextual-module"); ?>
<?php get_footer(); ?>
