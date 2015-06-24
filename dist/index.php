<?php get_header(); ?>
<?php get_template_part("contextual-module"); ?>
<main class="l-container-w-side animsition" data-animsition-in="fade-in-right-sm" role="main">
<?php 
  // check if any projects were returned
  if (any_of_post_type("project")):
?>
    <section id="filter-description"><?php the_field("filter_description", "option"); ?></section>
    <div id="thumbnail-toggle" class="detail">
      <span id="toggle-images" class="toggle-option is-selected">show images</span> |
      <span id="toggle-voice" class="toggle-option">show voice</span>
    </div>
    <section id="projects-index" class="container">
      <?php get_template_part('loop-project'); ?>
    </section>
    <section id="projects-navigation">
      <?php get_template_part('pagination'); ?>
    </section>
  <?php else: ?>
    <p>No projects found.  Please try again.</p>
  <?php endif; ?>
</main>
<?php get_footer(); ?>
