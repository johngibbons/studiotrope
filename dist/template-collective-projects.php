<?php /* Template Name: The Collective Page - Projects Template */ get_header(); ?>
<?php get_template_part("contextual-module"); ?>
<main id="the-collective" class="l-container-w-side" role="main"> 
  <?php if (have_posts()): while (have_posts()) : the_post(); ?>
    <section id="page-<?php the_ID(); ?>">
      <div id="projects-index">
        <?php if($post->post_parent == 0) return '';
        $post_data = get_post($post->post_parent);
        $studio = $post_data->post_name;
        $args = array(
          "posts_per_page" => -1,
          "post_type" => "project",
          "studio" => $studio,
          "post_status" => "publish",
        ); 
        $posts = get_posts( $args );
        include(locate_template('custom-loop.php'));
        ?>
      </div>
    </section>
  <?php endwhile; ?>
  <?php else: ?>
    <section>
      <h1><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>
    </section>
  <?php endif; ?>
</main>
<?php get_footer(); ?>
