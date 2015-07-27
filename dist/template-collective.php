<?php /* Template Name: The Collective Page Template */ get_header(); ?>
<?php get_template_part("contextual-module") ?>
<main id="the-collective" class="l-container-w-side animsition" data-animsition-in="fade-in-right-sm" role="main"> 
  <?php if (have_posts()): while (have_posts()) : the_post(); ?>
    <div id="fullpage">
      <div class="section is-hidden">
        <h1 class="page-title">
          <span class="text"><?php the_title(); ?></span>
          <svg class="icon icons-combined header-icon">
            <use xlink:href="#icons_combined"></use>
          </svg>
        </h1>

        <h2 class="studiotrope-text">studiotrope:</h2>
        <p class="pronunciation">| ˈst(y)o͞odēˌō | trōp |</p>
        <p class="definition">• verb • the act of revealing latent beauty, or the inability to capture with photography.</p>
        <p class="definition">• synonyms • shared intuition, transcendent, allusive, experiential, phenomenological</p>
        <div class="description">
          <p class="first">
            studiotrope design collective is organized around three main studios:</p>
          <a href="#architecture">
            <span class="architecture-link slide-link studio-name">Architecture</span>
          </a>
          <a href="#interiors">
            <span class="interiors-link studio-name slide-link">Interior Design</span>
          </a>
          <a href="#graphics">
            <span class="graphics-link studio-name slide-link">Graphic Design</span>
          </a>
        </div>

        <p id="scrollInstr">
          click on any of the studios or scroll down to learn more about us. 
          <i class="fa fa-arrow-circle-o-down"></i>
        </p>

      </div>

      <div class="section is-hidden">
        <div class="heading">
          <h1 class="page-title">
            <span class="text">Manifesto</span>
            <svg class="icon icons-combined header-icon">
              <use xlink:href="#icons_combined"></use>
            </svg>
          </h1>
        </div>
        <?php $flexible_content_type = "manifesto" ?>
        <?php include(locate_template('flexible-content.php')); ?>
      </div>

      <div class="section is-hidden">
        <div class="heading">
          <h1 class="page-title">
            <span class="text">Voice</span>
            <svg class="icon icons-combined header-icon">
              <use xlink:href="#icons_combined"></use>
            </svg>
          </h1>
        </div>
        <?php $flexible_content_type = "voice" ?>
        <?php include(locate_template('flexible-content.php')); ?>
      </div>

      <?php $studios = array("architecture", "interiors", "graphics"); ?>
      <?php $slides = array("", "services"); ?>

      <?php foreach ($studios as $studio) { ?>
        <?php foreach ($slides as $slide) { ?>

          <div class="section is-hidden">
            <div class="heading">
              <h1 class="page-title">
                <?php if ( $studio == "architecture" ): ?>
                  <svg class="icon icons-combined header-icon">
                    <use xlink:href="#architecture_icon"></use>
                  </svg>
                  <span class="text">Architecture</span>
                <?php elseif ( $studio == "interiors" ): ?>
                  <svg class="icon icons-combined header-icon">
                    <use xlink:href="#interiors_icon"></use>
                  </svg>
                  <span class="text">Interior Design</span>
                <?php elseif ( $studio == "graphics" ): ?>
                  <svg class="icon icons-combined header-icon">
                    <use xlink:href="#graphics_icon"></use>
                  </svg>
                  <span class="text">Graphic Design</span>
                <?php endif; ?>
              </h1>
              <p class="detail"><?php echo $slide ?></p>
            </div>
            <?php if ($slide == ""): ?>
              <?php $flexible_content_type = $studio ?>
            <?php else: ?>
              <?php $flexible_content_type = $studio . "_" . $slide; ?>
            <?php endif; ?>
            <?php include(locate_template('flexible-content.php')); ?>
          </div>

        <?php }
      } ?>

  <?php endwhile; ?>
  <?php else: ?>
    <article>
      <h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
    </article>
  <?php endif; ?>
</main>
<?php get_footer(); ?>
