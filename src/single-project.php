<?php get_header(); ?>
<?php get_template_part("contextual-module"); ?>
<main class="l-container-w-side" role="main"> 
  <?php if (have_posts()): while (have_posts()) : the_post(); ?>
    <section id="project-<?php the_ID(); ?>" <?php post_class(""); ?>>
        <div id="voice-heading">
    <?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
      <?php $url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' ); ?>
      <?php $url = $url[0]; ?>
        <div class="featured-image" style="background-image: url( <?php echo $url ?> );"></div>
          <div class="overlay">
            <p class="project-voice"><span><?php echo get_post_meta(get_the_id(), "project_voice", true); ?></span></p>
          </div>
        </div>
      <?php $flexible_content_type = "project"; ?>
      <?php include(locate_template('flexible-content.php')); ?>
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
