<?php get_header(); ?>
<?php get_template_part("contextual-module"); ?>
  <main class="l-container-w-side" role="main">
    <section id="filter-description"></section>
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
  </main>
<?php get_footer(); ?>
