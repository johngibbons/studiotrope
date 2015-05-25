<?php get_header(); ?>
<main role="main"> 
  <?php if (have_posts()): while (have_posts()) : the_post(); ?>
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
<?php get_template_part("contextual-module"); ?>
<?php get_footer(); ?>
