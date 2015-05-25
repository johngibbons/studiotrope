<?php get_header(); ?>
<?php get_template_part("sub_header"); ?>
<?php get_template_part("contextual_module"); ?>
<div class="l-container">
  <main role="main">
    <!-- section -->
    <section id="projects-results">
<?php print_r($wp_query); ?>
      <h1><?php echo sprintf( __( '%s Projects matching ', 'html5blank' ), $wp_query->found_posts ); echo get_search_query(); ?></h1>
      <?php get_template_part('loop-project'); ?>
    </section>
    <!-- /section -->
    <!-- section -->
    <section id="tropers-results">
      <h1><?php echo sprintf( __( '%s Tropers matching ', 'html5blank' ), $wp_query->found_posts ); echo get_search_query(); ?></h1>
      <?php get_template_part('loop-troper'); ?>
    </section>
    <!-- /section -->
    <!-- section -->
    <section id="blog-results">
      <h1><?php echo sprintf( __( '%s Blog Posts matching ', 'html5blank' ), $wp_query->found_posts ); echo get_search_query(); ?></h1>
      <?php get_template_part('loop'); ?>
    </section>
    <!-- /section -->
  </main>
</div>

<?php get_footer(); ?>
