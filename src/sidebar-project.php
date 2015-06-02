<?php if (have_posts()): while (have_posts()) : the_post(); ?>
  <h1 class="project-title">
    <?php the_title(); ?>
  </h1>

  <ul class="detail">
      <?php custom_taxonomies_terms_links(); // Project Details Links ?>
      <?php get_template_part('connected-tropers'); // Contributers ?>
  </ul>
  <p id="project-detail-description">
    <?php echo get_post_meta(get_the_ID(), "st_project_description", true); ?>
  </p>
  <?php get_template_part("prev-next-links"); ?>
<?php endwhile ?>
<?php endif ?>
