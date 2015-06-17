<h2 class="detail dropdown-button title-text">Filter</h2>

<?php 
  // check if any projects were returned
  if (any_of_post_type("project")):
?>
    <p id="filter-instructions">
      <?php the_field("filter_instructions", "option"); ?>
    </p>
    <form id="projects-filter" class="filter dropdown">
      <button id="filter-reset" disabled>Clear Filters</button>
      <?php $filter_post_type = "project"; ?>
      <?php include(locate_template('filter.php')); ?>
      <?php get_template_part('projects-filter-part-tropers'); ?>
    </form>
<?php else: ?>
      <p>No results.  Please try again.</p>
<?php endif; ?>
