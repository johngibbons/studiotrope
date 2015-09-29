<?php get_header(); ?>
<?php get_template_part("contextual-module"); ?>
<main class="l-container-w-side" role="main">
<?php foreach($wp_query->query as $query_type => $query) {
  if (any_of_post_type("project") || any_of_post_type("attachment")): ?>
    <?php if (any_of_post_type("attachment")): ?>

      <section id="images-results">
        <h2>Images matching <span class="value">"<?php echo $query ?>"</span>: </h2>
        <?php get_template_part('loop-images'); ?>
      </section>

      <?php get_attachment_parents(); ?>

    <?php endif; ?>

    <?php if ( any_of_post_type("project") ): ?>

      <?php if ( is_tax() ) : ?>
        <h2>Projects matching <span class="value">"<?php echo $query ?>"</span>: </h2>
      <?php endif; ?>
      <!-- section -->
      <section id="filter-description"></section>
      <div id="thumbnail-toggle" class="detail">
        <span id="toggle-images" class="toggle-option is-selected">show images</span> |
        <span id="toggle-voice" class="toggle-option">show voice</span>
        <i class="fa fa-question-circle">
          <div class="tooltip">
            <p id="voice-description">
            <?php the_field("voice_description_short", "option"); ?> <a href="<?php the_field("voice_link", "option"); ?>"><br><br>Learn More</a>
            </p>
          </div>
        </i>
      </div>


      <section id="projects-index" class="container">
        <?php get_template_part('loop-project'); ?>
        <div class="gap"></div>
        <div class="gap"></div>
        <div class="gap"></div>
      </section>

    <?php endif; ?>
  <?php else: ?>
    <p>
      Sorry, no results matched your search.  Please try again.
    </p>
  <?php endif; ?>
<?php } ?>
</main>
<?php get_footer(); ?>
