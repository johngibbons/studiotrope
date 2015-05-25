<?php get_header(); ?>
<div class="l-container">
  <main role="main">
    <section id="people-index">
      <h1><?php _e( 'People', 'html5blank' ); ?></h1>
      <?php get_template_part('loop-troper'); ?>
      <?php get_template_part('pagination'); ?>
    </section>
  </main>
</div>
<?php get_template_part("contextual-module"); ?>
<?php get_footer(); ?>
