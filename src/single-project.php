<?php get_header(); ?>
<?php get_template_part("contextual-module"); ?>
<main class="l-container-w-side" role="main"> 
  <?php if (have_posts()): while (have_posts()) : the_post(); ?>
    <section id="project-<?php the_ID(); ?>" <?php post_class(""); ?>>
        <div id="voice-heading">
    <?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
      <?php $url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' )[0]; ?>
        <div class="featured-image" style="background-image: url( <?php echo $url ?> );"></div>
          <div class="overlay"></div>
          <p class="project-voice"><?php echo get_post_meta(get_the_id(), "project_voice", true); ?></p>
        </div>
      <?php get_template_part('project-flexible-content') ?>
    </section>
    <?php endif; ?>
  <?php endwhile; ?>
  <?php else: ?>
    <section>
      <h1><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>
    </section>
  <?php endif; ?>
</main>
<?php get_footer(); ?>
