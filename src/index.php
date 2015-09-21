<?php get_header(); ?>
<?php get_template_part("contextual-module"); ?>
<main class="l-container-w-side" role="main">
<?php 
  // check if any projects were returned
  if (any_of_post_type("project")):
?>
    <section id="filter-description"><?php the_field("filter_description", "option"); ?></section>
    <div id="thumbnail-toggle" class="detail">
      <span id="toggle-images" class="toggle-option is-selected">images</span> |
      <span id="toggle-voice" class="toggle-option">voices</span>
      <i class="fa fa-question-circle">
        <div class="tooltip">
          <p id="voice-description">
        <?php the_field("voice_description_short", "option"); ?> <a href="<?php echo get_permalink( get_page_by_path( 'the-collective/voice' ) ); ?>"><br><br>Learn More</a>
          </p>
        </div>
      </i>
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
