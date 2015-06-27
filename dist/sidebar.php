<!-- sidebar -->
<?php if (have_posts()): while (have_posts()) : the_post(); ?>

  <h1 class="page-title">
    <?php the_title(); ?>
  </h1>

  <p class="description">
    <?php the_field("page_sidebar"); ?>
  </p>

<?php endwhile ?>
<?php endif ?>
<!-- /sidebar -->
