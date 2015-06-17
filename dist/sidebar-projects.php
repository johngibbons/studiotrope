<h1><?php _e( 'Projects', 'html5blank' ); ?></h1>
  <?php foreach($wp_query->query as $query_type => $query) {
    if ($query_type != "post_type") {
      if ($query_type == "s") {
        $print_query = "<h2 class='query-text'>matching: " . "</span><span class='value'>" . '"' . $query . '"</span></h2>';
        $print_query .= "<a href=" . get_post_type_archive_link( 'project' ) . " class='all-projects-link'>see all projects</a>";
        echo $print_query;

      } else {
        $print_query = "<h2 class='query-text'>with <span class='category'>" . str_replace("_", " ", $query_type) . "</span> : <span class='value'>" . $query . "</span></h2>";
        $print_query .= "<a href=" . get_post_type_archive_link( 'project' ) . " class='all-projects-link'>see all projects</a>";
        echo $print_query;
      }
    }
  } ?>
<div class="mobile-dropdown">
  <?php get_template_part("projects-filter"); ?>
</div>
