
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
  endif;
?>
