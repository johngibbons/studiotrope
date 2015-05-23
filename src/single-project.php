<?php get_header(); ?>
  <main role="main"> 

    <?php if (have_posts()): while (have_posts()) : the_post(); ?>

      <section id="project-<?php the_ID(); ?>" <?php post_class(""); ?>>

      <div class="project-details l-sidebar">
        <h1 class="project-title">
          <?php the_title(); ?>
        </h1>

        <ul class="detail">
            <?php get_template_part('project-details'); ?>
            <?php get_template_part('connected-tropers'); ?>
        </ul>
        <p id="project-detail-description">
          <?php echo get_post_meta(get_the_ID(), "st_project_description", true); ?>
        </p>
      </div>

      <div class="project-contents l-container-w-side">
        <?php get_template_part('project-flexible-content') ?>
      </div>
      </section>
    <?php endwhile; ?>
    <?php else: ?>
      <section>
        <h1><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>
      </section>
    <?php endif; ?>
  </main>
<?php get_footer(); ?>
