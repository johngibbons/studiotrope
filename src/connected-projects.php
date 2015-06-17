<?php 
  $projects = new WP_Query( array(
    'connected_type' => 'project_to_troper',
    'connected_items' => get_queried_object(),
    'nopaging' => true,
  ) );

  // Display connected tropers
  if ( $projects->have_posts() ) : ?>
    <li class="label">Worked On:</li>
    <?php while ( $projects->have_posts() ) : $projects->the_post(); ?>
    <a href="<?php the_permalink(); ?>" class="project">
      <li class="value">
        <?php the_title(); ?>
      </li>
    </a>
    <?php endwhile; ?>
<?php /* Prevent weirdness */ wp_reset_postdata(); endif; ?>
