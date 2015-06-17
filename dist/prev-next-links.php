<div id="prev-next-links">
 <?php $prev_post = get_adjacent_post( false, '', true ); ?>
 <?php if ( is_a( $prev_post, 'WP_Post' ) ) { ?>
  <a href="<?php echo get_permalink( $prev_post->ID ); ?>" class="prev-link">
    <i class="fa fa-angle-left"></i>
    <span class="prev-next-text">
      <?php echo get_the_title( $prev_post->ID ); ?>
    </span>
  </a>
 <?php } ?>
 <?php $next_post = get_adjacent_post( false, '', false ); ?>
 <?php if ( is_a( $next_post, 'WP_Post' ) ) { ?>
  <a href="<?php echo get_permalink( $next_post->ID ); ?>" class="next-link">
    <span class="prev-next-text">
      <?php echo get_the_title( $next_post->ID ); ?>
    </span>
    <i class="fa fa-angle-right"></i>
  </a>
 <?php } ?>
</div>
