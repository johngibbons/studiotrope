<?php

    // Get All Project Taxonomies
    $taxonomies = get_object_taxonomies( $filter_post_type, 'objects' );

    // Don't Show Tags in Filter
    if (array_key_exists("project_tag", $taxonomies)) {
      unset($taxonomies["project_tag"]);
    } elseif (array_key_exists("post_tag")) {
      unset($taxonomies["post_tag"]);
    }

    // If this is an archive page, don't show filter for the Taxonomy which is
    // being queried, since the query is already filtering
    foreach($wp_query->query as $query_taxonomy => $query_term) {
      unset($taxonomies[$query_taxonomy]);
    }

  if (have_posts()): while (have_posts()) : the_post();


    // Get the terms that apply to the results of the query only
    foreach ( $taxonomies as $taxonomy_slug => $taxonomy ){
      $params = get_the_terms($post->ID, $taxonomy_slug);    
      $taxonomy_names[] = $taxonomy_slug;
      if (!empty($params) && !is_wp_error($params) ) {
        foreach ( $params as $param ) {
          $taxonomy_values[$taxonomy_slug][] = $param;
        }
      }
    }
  endwhile;
  endif;

  if (isset($taxonomy_values)) {

    foreach($taxonomy_values as $taxonomy_name => $value) {
      foreach($value as $term) {
        $tax_term_ids[$taxonomy_name][] = $term->term_id;
      }
    }

    foreach($tax_term_ids as $taxonomy => $term_ids) {
      sort($term_ids);
      $query_project_term_ids[$taxonomy] = array_values(array_unique($term_ids));
      foreach($query_project_term_ids[$taxonomy] as $term_id) {
        $term = get_term($term_id, $taxonomy);
        $available_params[$taxonomy][$term->slug] = $term;
      }
    }


    foreach ($available_params as $taxonomy => $filter_param) {

      $term_list = '<fieldset class="single-filter">';
      $taxonomy_title = str_replace('_', ' ', $taxonomy);
      $term_list .= '<legend class="detail dropdown-sublist-title">' .
      $taxonomy_title . '</legend><div class="dropdown-sublist">';

      foreach ( $filter_param as $term ) {

        $term_list .= '<div class="checkbox-wrapper"><input type="checkbox" value=' .
          "." . $term->taxonomy . "-" . $term->slug . ' id=' . $term->taxonomy .
          "-" . $term->slug . '><label for=' . $term->taxonomy . "-" .
          $term->slug . ' class="detail"><i class="fa fa-square-o"></i>' . $term->name . '</label></div>';

      }

      echo $term_list;
      echo "</div>";
      echo "</fieldset>";

    }

  }
?>
