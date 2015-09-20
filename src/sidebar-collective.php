<?php $ancestors = get_post_ancestors($post); ?>

<?php if ($ancestors): ?>
  <?php $parent = $ancestors[0]; ?>
  <?php $parent_slug = get_post($parent)->post_name; ?>
  <?php $parent_title = get_post($parent)->post_title; ?>
<?php else: ?>
  <?php $parent_slug = ""; ?>
<?php endif; ?>
<?php
  $children = get_pages('child_of='.$post->ID);
?>

<div class="mobile-dropdown transition-container">
  <div id="collective-heading">
    <h1 class="page-title">
      <?php if( count( $children ) != 0 ): ?>
        <span class="text"><?php the_title(); ?></span>
      <?php else: ?>
        <span class="text"><?php echo $parent_title; ?></span>
      <?php endif; ?>
        <svg class="icon header-icon">
      <?php if(is_page("architecture")||$parent_slug=="architecture"): ?>
          <use xlink:href="#architecture_icon"></use>
      <?php elseif(is_page("interior-design")||$parent_slug=="interior-design"): ?>
          <use xlink:href="#interiors_icon"></use>
      <?php elseif(is_page("graphic-design")||$parent_slug=="graphic-design"): ?>
          <use xlink:href="#graphics_icon"></use>
      <?php elseif(is_page("the-collective")||$parent_slug=="the-collective"): ?>
          <use xlink:href="#icons_combined"></use>
      <?php endif; ?>
        </svg>
    </h1>
    <?php if( count( $children ) == 0 ): ?>
      <p class="detail"><?php the_title(); ?></p>
    <?php endif; ?>
  </div>
  <h2 class="detail dropdown-button title-text">Section</h2>
  <?php the_collective_nav(); ?>
</div>
