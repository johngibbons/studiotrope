<?php get_header(); ?>
  <main class="l-container-w-side" role="main">
    <section id="filter-description"></section>
    <section id="projects-index" class="container">
      <?php get_template_part('loop-project'); ?>
    </section>
    <section id="projects-navigation">
      <?php get_template_part('pagination'); ?>
    </section>
  </main>
<?php get_template_part("contextual-module"); ?>
<?php get_footer(); ?>
