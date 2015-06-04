
<?php // check if the flexible content field has rows of data
  if( have_rows('flexible_content_' . $flexible_content_type ) ): // loop through the rows of data
    $row_num = 0;
    while ( have_rows('flexible_content_' . $flexible_content_type) ) : the_row();

      $row_num++;

      if(get_sub_field("width")) {
        $width = get_sub_field('width');
      } else { $width = ""; }

      if(get_sub_field("last")) {
        $last = "last";
      } else { $last = ""; }

      switch (get_row_layout()) {
        case "image":
          if(get_sub_field('image')):
            $image = get_sub_field('image'); ?> 
            <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="flexible-image l-content-module <?php echo "l_" . $width . " " . $last; ?>" data-content-id="<?php echo $row_num ?>"> 
    <?php break;
          endif;
        case "text":?>
          <?php if(get_sub_field("text")): ?>
            <p class="flexible-text l-content-module <?php echo "l_" . $width . " " . $last; ?>" data-content-id="<?php echo $row_num ?>"><?php the_sub_field('text'); ?></p>
          <?php endif; ?>
          <?php break;
        case "emphasis":?>
          <?php if(the_sub_field("emphasis")): ?>
            <div class="emphasis l-content-module l-full-bleed <?php echo "l_" . $width . " " . $last; ?>" data-content-id="<?php echo $row_num ?>">
              <q><?php the_sub_field('emphasis'); ?></q>
              <?php if (the_sub_field("source")): ?>
              <span class="source"><?php the_sub_field('source'); ?></span>
            <?php endif; ?>
          </div>
          <?php endif; ?>
    <?php break;
        case "video": ?>
          <?php if(get_sub_field("video")): ?>
            <div class="flexible-video video l-content-module <?php echo "l_" . $width . " " . $last; ?>" data-content-id="<?php echo $row_num ?>"><?php the_sub_field('video'); ?></div>
          <?php endif; ?>
    <?php break;
}
    endwhile;
  else :
    // no layouts found
  endif;
?>
