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
      <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="no-underline">
        <?php the_post_thumbnail(array(500,500)); // Declare pixel size you need inside the array ?>
      </a>
    <?php endif; ?>
    <h2>
      <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
    </h2>
    <?php html5wp_excerpt('html5wp_index'); // Build your custom callback length in functions.php ?>
    <?php edit_post_link(); ?>
  </article>
<?php endwhile; ?>
  <div class="gap"></div>
  <div class="gap"></div>
<?php else: ?>
  <article>
    <h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
  </article>
<?php endif; ?>
