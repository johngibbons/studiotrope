<?php if (have_posts()): while (have_posts()) : the_post(); ?>

<?php if($post->post_type === "post") : ?>
  <article>
    <!-- post title -->
    <h2>
      <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
    </h2>
    <!-- /post title -->

    <!-- post details -->
    <span class="date">
      <time datetime="<?php the_time('Y-m-d'); ?> <?php the_time('H:i'); ?>">
        <?php the_date(); ?> <?php the_time(); ?>
      </time>
    </span>
    <!-- /post details -->

    <?php html5wp_excerpt('html5wp_index'); // Build your custom callback length in functions.php ?>

    <?php edit_post_link(); ?>

  </article>
  <!-- /article -->

<?php endif; ?>
<?php endwhile; ?>

<?php else: ?>

  <!-- article -->
  <article>
    <h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
  </article>
  <!-- /article -->

<?php endif; ?>
