<?php if (have_posts()): while (have_posts()) : the_post(); ?>
  <h1 class="project-title">
    <span class="text"><?php the_title(); ?></span>
    <?php $studios = project_studios(); ?>
    <?php if ( in_array("architecture", $studios) ): ?>

      <?php if ( in_array("graphic-design", $studios) ): ?>

        <?php if ( in_array("interior-design", $studios) ): // all three studios?>
          <svg class="icon icons-combined header-icon">
            <use xlink:href="#icons_combined"></use>
          </svg>
          <?php return ?>

        <?php else: // Architecture + Graphics ?>

          <svg class="icon header-icon">
            <use xlink:href="#architecture_graphics_icon"></use>
          </svg>
          <?php return ?>

        <?php endif; ?>


      <?php elseif ( in_array("interior-design", $studios) ): // Architecture + Interiors ?>

        <svg class="icon header-icon">
          <use xlink:href="#architecture_interiors_icon"></use>
        </svg>

      <?php else: // Architecture only ?>

        <svg class="icon header-icon">
          <use xlink:href="#architecture_icon"></use>
        </svg>

      <?php endif; ?>

    <?php elseif ( in_array("graphic-design", $studios) ): ?>

      <?php if ( in_array("interior-design", $studios) ): // Graphics + Interiors ?>

        <svg class="icon header-icon">
          <use xlink:href="#interiors_graphics_icon"></use>
        </svg>

      <?php else: // Graphics Only?>

        <svg class="icon header-icon">
          <use xlink:href="#graphics_icon"></use>
        </svg>

      <?php endif; ?>

    <?php elseif ( in_array("interior-design", $studios) ): //Interiors only ?>

      <svg class="icon header-icon">
        <use xlink:href="#interiors_icon"></use>
      </svg>

    <?php endif; ?>
  </h1>

  <ul class="detail">
      <?php custom_taxonomies_terms_links(); // Project Details Links ?>
      <?php get_template_part('connected-tropers'); // Contributers ?>
  </ul>
  <p id="project-detail-description">
    <?php echo get_post_meta(get_the_ID(), "st_project_description", true); ?>
  </p>
  <?php get_template_part("prev-next-links"); ?>
<?php endwhile ?>
<?php endif ?>
