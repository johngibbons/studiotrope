<h1><?php _e( 'Search Results', 'html5blank' ); ?></h1>
  <?php foreach($wp_query->query as $query_type => $query) {
      $print_query = "<h2 class='query-text'>matching: " . "</span><span class='value'>" . '"' . $query . '"</span></h2>';
      echo $print_query;
  } ?>
<div class="mobile-dropdown">
  <?php get_template_part("projects-filter"); ?>
</div>
