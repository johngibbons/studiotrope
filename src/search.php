<?php get_header(); ?>
<?php get_template_part("contextual-module"); ?>
<main class="l-container-w-side" role="main">
<?php if (any_of_post_type("project")): ?>
  <!-- section -->
  <section id="filter-description"></section>
  <div id="thumbnail-toggle" class="detail">
    <span id="toggle-images" class="toggle-option is-selected">show images</span> |
    <span id="toggle-voice" class="toggle-option">show voice</span>
  </div>
  <section id="projects-index" class="container">
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
<?php else: ?>
  <p>
    Sorry, no projects found.  Please try again.
  </p>
<?php endif; ?>
</main>

<?php get_footer(); ?>
