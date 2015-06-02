<?php // Find connected tropers (for all projects)
  p2p_type( 'project_to_troper' )->each_connected( $wp_query );
  if (have_posts()): while (have_posts()) : the_post();
    foreach ( $post->connected as $post ) : setup_postdata( $post );
      $troper_ids[] = get_the_ID();
      $troper_names[get_the_ID()] = get_the_title();
    endforeach;
    $troper_ids = array_unique($troper_ids);
    $troper_names = array_unique($troper_names);
    wp_reset_postdata(); // set $post back to original post
  endwhile;
  endif;
  $term_list = '<fieldset class="single-filter">';
  $term_list .= '<legend class="detail dropdown-sublist-title">
    Contributers</legend><div class="dropdown-sublist">';
  foreach($troper_ids as $troper_id) {
    $term_list .= '<div class="checkbox-wrapper"><input type="checkbox" value=".troper-'.
      $troper_id . '" id=".troper-' . $troper_id . '"><label for=".troper-' .
      $troper_id . '" class="detail"><i class="fa fa-square-o"></i>' . $troper_names[$troper_id] . '</label></div>';
  }
  echo $term_list;
  echo "</div>";
  echo "</fieldset>";
?>
