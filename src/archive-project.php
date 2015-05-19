<?php get_header(); ?>
  <div class="l-container">
    <main role="main">
      <h1><?php _e( 'All Projects', 'html5blank' ); ?></h1>
      <section id="projects">
        <form class="controls" id="projects-filter">
	  <?php // Find connected tropers (for all projects)
	    p2p_type( 'project_to_troper' )->each_connected( $wp_query );
	    if (have_posts()): while (have_posts()) : the_post();
	      $i = 0;
	      foreach ( $post->connected as $post ) : setup_postdata( $post );
	        $troper_ids[] = get_the_ID();
		$troper_names[get_the_ID()] = get_the_title();
		$i++;
	      endforeach;
	      $troper_ids = array_unique($troper_ids);
	      $troper_names = array_unique($troper_names);
	      wp_reset_postdata(); // set $post back to original post
	    endwhile;
	    endif;
            $term_list = '<fieldset class="single-filter">';
	    $i = 0;
	    foreach($troper_ids as $troper_id) {
	      $term_list .= '<div class="checkbox"><input type="checkbox" value=".troper-' . $troper_id . '" id=".troper-' . $troper_id . '"><label for=".troper-' . $troper_id . '">' . $troper_names[$troper_id] . '</label></div>';
	      $i++;
	    }
	    echo $term_list;
	    echo "</fieldset>";
	    $project_type_terms = st_get_tax("project_type");
	    $studio_terms = st_get_tax("studio");
	    $tags = st_get_tax("tags");
	    $filter_params = [$project_type_terms, $studio_terms, $tags];
	    foreach ($filter_params as $filter_param) {
	      if (! empty( $filter_param) && ! is_wp_error( $filter_param ) ) {
	        $term_list = '<fieldset class="single-filter">';
	        foreach ( $filter_param as $term ) {
		  $term_list .= '<div class="checkbox"><input type="checkbox" value=' . "." . $term->taxonomy . "-" . $term->slug . ' id=' . $term->taxonomy . "-" . $term->slug . '><label for=' . $term->taxonomy . "-" . $term->slug . '>' . $term->name . '</label></div>';
		}
	        echo $term_list;
	      }
	    echo "</fieldset>";
	    } ?>
	  <button id="filter-reset">Clear Filters</button>
	</form>
      </section>
      <section id="projects-index" class="container">
        <?php get_template_part('loop-project'); ?>
      </section>
      <section id="projects-navigation">
        <?php get_template_part('pagination'); ?>
      </section>
    </main>
  </div>
<?php get_footer(); ?>
