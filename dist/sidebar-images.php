<h1><?php _e( 'Images', 'html5blank' ); ?></h1>
  <?php foreach($wp_query->query as $query_type => $query) {
    if ($query_type != "post_type") {
      if ($query_type == "s") {
        $print_query = "<h2 class='query-text'>matching: " . "</span><span class='value'>" . '"' . $query . '"</span></h2>';
        echo $print_query;
      } else {
        $print_query = "<h2 class='query-text'>with <span class='category'>" . str_replace(array("_", "-"), " ", $query_type) . "</span> : <span class='value'>" . str_replace(array("_", "-"), " ", $query) . "</span></h2>";
        echo $print_query;
      }
    }
  } ?>
