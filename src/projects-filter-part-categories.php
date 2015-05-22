<?php
  $taxonomies = get_object_taxonomies( 'project', 'objects' );
  unset($taxonomies["post_tag"]);
  foreach ( $taxonomies as $taxonomy_slug => $taxonomy ){
    $filter_params[] = st_get_tax($taxonomy_slug);
  }
  foreach ($filter_params as $filter_param) {

    if (! empty( $filter_param) && ! is_wp_error( $filter_param ) ) {

      $term_list = '<fieldset class="single-filter">';
      $taxonomy_title = $filter_param[0]->taxonomy;
      $taxonomy_title = str_replace('_', ' ', $taxonomy_title);
      $term_list .= '<legend class="detail dropdown-sublist-title">' .
        $taxonomy_title . '</legend><div class="dropdown-sublist">';

      foreach ( $filter_param as $term ) {

        $term_list .= '<div class="checkbox"><input type="checkbox" value=' .
          "." . $term->taxonomy . "-" . $term->slug . ' id=' . $term->taxonomy .
          "-" . $term->slug . '><label for=' . $term->taxonomy . "-" .
          $term->slug . ' class="detail">' . $term->name . '</label></div>';

      }

      echo $term_list;
      echo "</div>";
      echo "</fieldset>";

    }
  }
?>
