<?php get_header(); ?>
<?php if (have_posts()): while (have_posts()) : the_post(); ?>
  <div class="l-sidebar">
    <?php get_template_part("header-items"); ?>
    <?php get_template_part("sidebar_selector"); ?>
  </div>
  <main role="main"> 
      <section id="project-<?php the_ID(); ?>" <?php post_class(""); ?>>
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
