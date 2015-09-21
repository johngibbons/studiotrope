<?php /* Template Name: The Collective Page Template */ get_header(); ?>
<?php get_template_part("contextual-module"); ?>
<main id="the-collective" class="l-container-w-side" role="main"> 
  <?php if (have_posts()): while (have_posts()) : the_post(); ?>
    <section id="page-<?php the_ID(); ?>">
      <?php $flexible_content_type = "collective"; ?>
      <?php include(locate_template('flexible-content.php')); ?>
    </section>
  <?php endwhile; ?>
  <?php else: ?>
    <section>
      <h1><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>
    </section>
  <?php endif; ?>
</main>
<?php get_footer(); ?>
