<?php get_header(); ?>
<?php get_template_part("contextual-module"); ?>
<main class="l-container-w-side animsition" data-animsition-in="fade-in-right-sm" role="main"> 
  <section id="people-index">
    <h1><?php _e( 'People', 'html5blank' ); ?></h1>
    <?php get_template_part('loop-troper'); ?>
    <?php get_template_part('pagination'); ?>
  </section>
</main>
<?php get_footer(); ?>
