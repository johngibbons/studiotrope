<?php get_header(); ?>

    <?php get_template_part("contextual-module"); ?>
<main class="l-container-w-side" role="main"> 
      <!-- section -->
      <section>

      <?php if (have_posts()): while (have_posts()) : the_post(); ?>

        <!-- article -->
        <article id="troper-<?php the_ID(); ?>" <?php post_class(); ?>>
          <?php $avatar = get_field("st_profile_picture"); ?>
          <?php $photo = $avatar["sizes"]["medium"]; ?>
          <?php if( !empty($avatar) ): ?>

          <?php endif; ?> 
          <img src="<?php echo $photo; ?>" alt="<?php echo $avatar['alt']; ?>" id="troper-profile-picture">
          <!-- /post thumbnail -->

          <div id="troper-profile-info">
            <!-- post title -->
            <h1>
              <?php the_title(); ?>
            </h1>
            <a href="mailto:<?php echo get_post_meta(get_the_id(), "st_email_address", true); ?>" class="email">
              <?php echo get_post_meta(get_the_id(), "st_email_address", true); ?>
            </a>
            <h2>
              <?php echo get_post_meta(get_the_id(), "st_job_title", true); ?>
            </h2>
            <!-- /post title -->
            <p class="detail"><?php the_terms( $post->ID, 'studio', '', ' / ' ); ?></p>
            <p><?php echo get_post_meta(get_the_id(), "st_bio", true); ?>
  </p>
          </div>
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

      </section>
    </main>

<?php get_footer(); ?>
