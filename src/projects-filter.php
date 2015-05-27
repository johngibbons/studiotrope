<h2 class="detail dropdown-button title-text">Filter</h2>
<p id="filter-instructions">That's a lot of projects!  Click on what interests you below to narrow down the results.</p>
<form id="projects-filter" class="filter dropdown">
  <button id="filter-reset" disabled>Clear Filters</button>
  <?php get_template_part('projects-filter-part-categories'); ?>
  <?php get_template_part('projects-filter-part-tropers'); ?>
</form>
