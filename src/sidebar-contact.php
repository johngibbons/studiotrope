<div class="mobile-dropdown">
  <h2 class="detail dropdown-button title-text">Contact Someone Directly</h2>
  <ul id="people-list" class="detail dropdown">

<?php global $post ?>
<?php $args = array(
  "post_type" => "troper",
  "posts_per_page" => -1,
); ?>
<?php $tropers = get_posts( $args ); ?>
<?php foreach ( $tropers as $post ) : setup_postdata( $post ); ?>
  <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="no-underline">
    <li><?php the_title(); ?></p>
  </a>

<?php endforeach; ?>
<?php wp_reset_postdata(); ?>

  </ul>
</div>
