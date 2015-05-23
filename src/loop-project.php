<?php if (have_posts()): while (have_posts()) : the_post(); ?>
  <?php $i = 0;
  foreach ( $post->connected as $post ) : setup_postdata( $post );
    $troper_ids[$i] = "troper-" . get_the_ID();
    $i++;
  endforeach;
  $troper_ids[] = "mix";
  wp_reset_postdata(); // set $post back to original post ?>
  <article id="post-<?php the_ID(); ?>" <?php post_class($troper_ids); ?>>
    <?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
<?php $url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium' )[0]; ?>
<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"
  class="no-underline">
  <div class="project-thumb" style="background-image: url( <?php echo $url ?> );"></div>
      </a>
    <?php endif; ?>
  <div class="sdc-icons-container">
    <svg class="sdc-icons">
      <svg class="icon architecture-icon" width="33.33%" height="33.33%">
        <use xlink:href="#architecture_icon"></use>
      </svg>
      <svg class="icon graphics-icon" width="33.33%" height="33.33%">
        <use xlink:href="#graphics_icon"></use>
      </svg>
      <svg class="icon interiors-icon" width="33.33%" height="33.33%">
        <use xlink:href="#interiors_icon"></use>
      </svg>
    </svg>
  </div>
  </article>
<?php endwhile; ?>
  <div class="gap"></div>
  <div class="gap"></div>
  <div class="gap"></div>
<?php else: ?>
  <article>
    <h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
  </article>
<?php endif; ?>
