<?php if (have_posts()): while (have_posts()) : the_post(); ?>

        <article id="troper-<?php the_ID(); ?>" <?php post_class(); ?>>

                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="no-underline">
                        <?php $avatar = get_field("st_profile_picture"); ?>
                <?php $thumb = $avatar["sizes"]["thumbnail"]; ?>
                <img src="<?php echo $thumb; ?>" alt="<?php echo $avatar['alt']; ?>" class="troper-avatar">
                </a>

                <h2 class="troper-name">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                </h2>

                <?php html5wp_excerpt('html5wp_index'); // Build your custom callback length in functions.php ?>

        </article>

<?php endwhile; ?>

  <div class="gap"></div>
  <div class="gap"></div>

<?php else: ?>

        <article>
                <h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
        </article>

<?php endif; ?>
