<h2 class="detail dropdown-button title-text">Filter By Interest</h2>

<?php 
  // check if any tropers were returned
  if (any_of_post_type("troper")):
?>
    <p id="filter-instructions">
      <?php the_field("troper_filter_instructions", "option"); ?>
    </p>
    <form id="tropers-filter" class="filter dropdown">
      <button id="filter-reset" disabled>Clear Filters</button>
      <?php $filter_post_type = "troper"; ?>
      <?php include(locate_template('filter.php')); ?>
    </form>
<?php else: ?>
      <p>No results.  Please try again.</p>
<?php endif; ?>
