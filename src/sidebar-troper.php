<div class="mobile-dropdown transition-container">
  <h2 class="detail label">Other Tropers</h1>

  <?php
    $type = 'troper';
    $args=array(
      'post_type' => $type,
      'post_status' => 'publish',
      'posts_per_page' => -1
    );

    $my_query = null;
    $my_query = new WP_Query($args);
    if( $my_query->have_posts() ) {
      while ($my_query->have_posts()) : $my_query->the_post(); 
  ?>
        <p class="detail">
          <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
        </p>
  <?php
  endwhile;
  }
  wp_reset_query();  // Restore global post data stomped by the_post().
  ?>
  <?php get_template_part("prev-next-links"); ?>
</div>
