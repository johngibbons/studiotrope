<p>
  <h1><?php _e( 'People (Tropers)', 'html5blank' ); ?></h1>
  <?php foreach($wp_query->query as $query_type => $query) {
    if ($query_type != "post_type") {
        $print_query = "<h2 class='query-text'>with <span class='category'>" . str_replace(array("_", "-"), " ", $query_type) . "</span> : <span class='value'>" . str_replace(array("_", "-"), " ", $query) . "</span></h2>";
        $print_query .= "<a href=" . get_post_type_archive_link( 'troper' ) . " class='all-tropers-link'>see all people</a>";
        echo $print_query;
    } else {
      the_field("tropers_text", "option");
    }
  } ?>
</p>

<div class="mobile-dropdown">
  <?php get_template_part("tropers-filter"); ?>
</div>
