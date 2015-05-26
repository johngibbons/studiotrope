<?php // Find connected tropers
  $tropers = new WP_Query( array(
  'connected_type' => 'project_to_troper',
  'connected_items' => get_queried_object(),
  'nopaging' => true,
  ) );

  // Display connected tropers
  if ( $tropers->have_posts() ) : ?>
    <li class="label">Contributers:</li>
    <li class="value">
      <?php while ( $tropers->have_posts() ) : $tropers->the_post(); ?>
        <a href="<?php the_permalink(); ?>" class="troper-thumb no-underline">
          <?php $avatar = get_field("st_profile_picture"); ?>
          <?php $thumb = $avatar["sizes"]["thumbnail"]; ?>
          <img src="<?php echo $thumb; ?>" alt="<?php echo $avatar['alt']; ?>" class="troper-avatar">
        </a>
      <?php endwhile; ?>
    </li>
<?php /* Prevent weirdness */ wp_reset_postdata(); endif; ?>
