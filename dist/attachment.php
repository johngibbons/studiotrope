<?php get_header(); ?>

  <main role="main">
    <!-- section -->
    <section>
      <?php if (have_posts()): while (have_posts()) : the_post(); ?>
      <div class="navigation"><p><?php posts_nav_link(); ?></p></div>
      <?php endwhile; ?>
      <?php endif; ?>
    </section>
  </main>

<?php get_footer(); ?>
