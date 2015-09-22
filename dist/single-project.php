<?php get_header(); ?>
<?php get_template_part("contextual-module"); ?>
<main class="l-container-w-side" role="main"> 
  <?php if (have_posts()): while (have_posts()) : the_post(); ?>
    <section id="project-<?php the_ID(); ?>" <?php post_class(""); ?>>
        <div id="voice-heading">
    <?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
      <?php $url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' ); ?>
      <?php $url = $url[0]; ?>
        <img src="<?php echo $url; ?>" class="featured-image">
          <div class="overlay">
            <p class="project-voice"><span><?php echo get_post_meta(get_the_id(), "project_voice", true); ?></span></p>
          </div>
        </div>
      <div class="js-filter detail">
        <p class="filter-text">Filter content by studio: </p>
        <form action="">
          <label class="js-link selected"><input type="radio" name="studio" value="all" checked>all</label>
          <?php $studios = project_studios(); ?>
          <?php foreach ( $studios as $studio ): ?>
            <label class="js-link"><input type="radio" name="studio" value="<?php echo $studio ?>"><?php echo $studio ?></label>
          <?php endforeach; ?>
        </form>
      </div>
      <?php $flexible_content_type = "project"; ?>
      <?php include(locate_template('flexible-content.php')); ?>
      <div class="js-filter detail">
        <p class="filter-text">Filter content by studio: </p>
        <form action="">
          <label class="js-link selected"><input type="radio" name="studio" value="all" checked>all</label>
          <?php $studios = project_studios(); ?>
          <?php foreach ( $studios as $studio ): ?>
            <label class="js-link"><input type="radio" name="studio" value="<?php echo $studio ?>"><?php echo $studio ?></label>
          <?php endforeach; ?>
        </form>
      </div>
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
