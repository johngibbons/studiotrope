<?php get_header(); ?>
<?php get_template_part("contextual-module"); ?>
<main class="l-container-w-side animsition" data-animsition-in="fade-in-right-sm" role="main"> 
  <section id="filter-description"><?php the_field("troper_filter_description", "option"); ?></section>
  <section id="people-index">
    <?php get_template_part('loop-troper'); ?>
    <?php get_template_part('pagination'); ?>
  </section>
</main>
<?php get_footer(); ?>
