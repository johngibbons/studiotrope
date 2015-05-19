<?php get_header(); ?>
  <main role="main"> 

    <?php if (have_posts()): while (have_posts()) : the_post(); ?>

      <section id="project-<?php the_ID(); ?>" <?php post_class(); ?>>

      <div class="l-container">
        <div class="project-details l-sidebar is-fixed">

          <h1 class="project-title">
            <?php the_title(); ?>
          </h1>

          <table class="detail">
            <tr>
              <td class="project-detail-label">Studio:</td>
              <td><?php the_terms( $post->ID, 'studio', '', ' / ' ); ?></td>
            </tr>
            <tr>
              <td class="project-detail-label">Project Type:</td>
              <td><?php the_terms( $post->ID, 'project_type', '', ' / ' ); ?></td>
            </tr>
            <tr>
              <td class="project-detail-label">Tags:</td>
              <td><?php the_tags( '', ' / ', ''); // Surrounded by spans ?></td>
            </tr>
<?php // Find connected tropers
$tropers = new WP_Query( array(
'connected_type' => 'project_to_troper',
'connected_items' => get_queried_object(),
'nopaging' => true,
) );

// Display connected tropers
if ( $tropers->have_posts() ) : ?>
            <tr>
              <td class="project-detail-label">Contributers:</td>
            </tr>
            <tr>
              <td colspan="2">
                <?php while ( $tropers->have_posts() ) : $tropers->the_post(); ?>
                  <a href="<?php the_permalink(); ?>" class="troper-thumb no-underline">
                    <?php $avatar = get_field("st_profile_picture"); ?>
                    <?php $thumb = $avatar["sizes"]["thumbnail"]; ?>
                    <img src="<?php echo $thumb; ?>" alt="<?php echo $avatar['alt']; ?>" class="troper-avatar">
                  </a>
                <?php endwhile; ?>
              </td>
            </tr>

<?php /* Prevent weirdness */ wp_reset_postdata(); endif; ?>
          </table>

          <p id="project-detail-description">
            <?php the_field("st_project_description") ?>
          </p>
        </div>

      <div class="project-contents l-container-w-side">
        <?php // check if the flexible content field has rows of data
        if( have_rows('flexible_project_content') ): // loop through the rows of data
          $row_num = 0;
          while ( have_rows('flexible_project_content') ) : the_row();
            $row_num++;
            $width = get_sub_field('st_content_width');
            if(get_sub_field('st_last')) {
              $last = "last";
            }
            else { $last = ""; }
              switch (get_row_layout()) {
                case "project_image":
                  $image = get_sub_field('st_image'); ?> 
                  <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="project-image l-content-module <?php echo "l_" . $width . " " . $last; ?>" data-content-id="<?php echo $row_num ?>"> 
            <?php break;
                case "description":?>
                  <p class="project-description l-content-module <?php echo "l_" . $width . " " . $last; ?>" data-content-id="<?php echo $row_num ?>"><?php the_sub_field('st_description'); ?></p>
                  <?php break;
                case "project_testimonial":?>
                  <div class="project-testimonial l-content-module l-full-bleed <?php echo "l_" . $width . " " . $last; ?>" data-content-id="<?php echo $row_num ?>">
                    <q><?php the_sub_field('st_testimonial'); ?></q>
                    <span class="testimonial-source"><?php the_sub_field('st_testimonial_source'); ?></span>
                  </div>
            <?php break;
                case "project_video": ?>
                  <div class="project-video video l-content-module <?php echo "l_" . $width . " " . $last; ?>" data-content-id="<?php echo $row_num ?>"><?php the_sub_field('st_video'); ?></div>
            <?php break;
}
            endwhile;
            else :
              // no layouts found
            endif; ?>
        </div>
      </section>
    <?php endwhile; ?>
    <?php else: ?>
      <section>
        <h1><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>
      </section>
    <?php endif; ?>
    </div>
  </main>
<?php get_footer(); ?>
