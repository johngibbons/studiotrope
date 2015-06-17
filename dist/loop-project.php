<?php p2p_type( 'project_to_troper' )->each_connected( $wp_query ); ?>
<?php if (have_posts()): while (have_posts()) : the_post(); ?>
<?php if($post->post_type === "project") : ?>
  <?php
  $troper_ids = [];
  foreach ( $post->connected as $post ) : setup_postdata( $post );
    $troper_ids[] = "troper-" . get_the_ID();
  endforeach;
  $troper_ids[] = "mix";
  wp_reset_postdata(); // set $post back to original post ?>
  <article id="post-<?php the_ID(); ?>" <?php post_class($troper_ids); ?>>
    <?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
      <?php $url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium' )[0]; ?>
      <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="no-underline">
        <h3 class="thumb-title"><?php echo the_title(); ?></h3>
        <span class="project-voice-thumb is-hidden"><span><?php echo get_post_meta(get_the_id(), "project_voice", true); ?></span></span>
        <span class="project-thumb" style="background-image: url( <?php echo $url ?> );"></span>
      </a>
    <?php endif; ?>
  </article>
  <?php endif; ?>
<?php endwhile; ?>
  <div class="gap"></div>
  <div class="gap"></div>
  <div class="gap"></div>
<?php else: ?>
  <article>
    <h2><?php _e( 'No results. Please try again.', 'html5blank' ); ?></h2>
  </article>
<?php endif; ?>
