<p>
  <h1><?php _e( 'People (Tropers)', 'html5blank' ); ?></h1>
  <?php the_field("tropers_text", "option"); ?>
</p>

<div class="mobile-dropdown">
  <?php get_template_part("tropers-filter"); ?>
</div>
