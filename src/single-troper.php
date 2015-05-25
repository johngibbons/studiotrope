<?php get_header(); ?>

    <main role="main">
      <!-- section -->
      <section>

        <div class="l-container-w-side right last">
      <?php if (have_posts()): while (have_posts()) : the_post(); ?>

        <!-- article -->
        <article id="troper-<?php the_ID(); ?>" <?php post_class(); ?>>
          <?php $avatar = get_field("st_profile_picture"); ?>
          <?php $photo = $avatar["sizes"]["medium"]; ?>
          <?php if( !empty($avatar) ): ?>

          <?php endif; ?> 
          <img src="<?php echo $photo; ?>" alt="<?php echo $avatar['alt']; ?>" id="troper-profile-picture" class="troper-avatar">
          <!-- /post thumbnail -->

          <!-- post title -->
          <h1>
            <?php the_title(); ?>
          </h1>
          <h2><?php echo get_post_meta(get_the_id(), "st_job_title", true); ?>
</h2>
          <!-- /post title -->
          <p><?php the_terms( $post->ID, 'studio', '', ' / ' ); ?></p>
          <p><?php echo get_post_meta(get_the_id(), "st_email_address", true); ?>
</p>
          <p><?php echo get_post_meta(get_the_id(), "st_bio", true); ?>
</p>
        </article>
        <!-- /article -->

      <?php endwhile; ?>

      <?php else: ?>

        <!-- article -->
        <article>

          <h1><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>

        </article>
        <!-- /article -->

      <?php endif; ?>

        </div>
      </section>
    </main>

<?php get_template_part("contextual-module"); ?>
<?php get_footer(); ?>
