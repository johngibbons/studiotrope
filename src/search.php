<?php get_header(); ?>
<?php get_template_part("contextual-module"); ?>
<main class="l-container-w-side" role="main">
  <!-- section -->
  <section id="projects-results">
    <?php get_template_part('loop-project'); ?>
  </section>
  <!-- /section -->
  <!-- section -->
  <section id="tropers-results">
    <?php get_template_part('loop-troper'); ?>
  </section>
  <!-- /section -->
  <!-- section -->
  <section id="blog-results">
    <?php get_template_part('loop'); ?>
  </section>
  <!-- /section -->
</main>

<?php get_footer(); ?>
