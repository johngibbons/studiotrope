<?php /* Template Name: The Collective Page Template */ get_header(); ?>
<?php get_template_part("contextual-module") ?>
<main id="the-collective" class="l-container-w-side" role="main"> 
  <?php if (have_posts()): while (have_posts()) : the_post(); ?>
    <div id="collective-heading">
      <h1 class="page-title">
        <span class="text"></span>
        <svg class="icon icons-combined header-icon">
          <use xlink:href="#icons_combined"></use>
        </svg>
      </h1>
      <p class="detail"></p>
    </div>
    <div id="spacing-fix"></div>
    <div id="fullpage">
      <div class="section is-hidden">

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
        <?php $flexible_content_type = "manifesto" ?>
        <?php include(locate_template('flexible-content.php')); ?>
      </div>

      <div class="section is-hidden">
        <?php $flexible_content_type = "voice" ?>
        <?php include(locate_template('flexible-content.php')); ?>
      </div>

      <?php $studios = array("architecture", "interiors", "graphics"); ?>
      <?php $slides = array("", "services", "people", "projects"); ?>

      <?php foreach ($studios as $studio) { ?>
        <?php foreach ($slides as $slide) { ?>

          <div class="section is-hidden">
            <?php if ($slide == ""): ?>
              <?php $flexible_content_type = $studio ?>
              <?php include(locate_template('flexible-content.php')); ?>
            <?php elseif ($slide == "services"): ?>
              <?php $flexible_content_type = $studio . "_" . $slide; ?>
              <?php include(locate_template('flexible-content.php')); ?>
            <?php elseif ($slide == "people"): ?>
              <?php if ($studio == "interiors") $studio = "interior-design"; ?>
              <?php if ($studio == "graphics") $studio = "graphic-design"; ?>
              <div id="people-index">
                <?php $args = array(
                  "posts_per_page" => -1,
                  "post_type" => "troper",
                  "studio" => $studio,
                  "post_status" => "publish",
                ); 

                $posts = get_posts( $args );
                include(locate_template('custom-loop.php'));
              ?>
            </div>
            <?php elseif ($slide == "projects"): ?>
              <?php if ($studio == "interiors") $studio = "interior-design"; ?>
              <?php if ($studio == "graphics") $studio = "graphic-design"; ?>
              <div id="projects-index">
                <?php $args = array(
                  "posts_per_page" => -1,
                  "post_type" => "project",
                  "studio" => $studio,
                  "post_status" => "publish",
                ); 

                $posts = get_posts( $args );
                include(locate_template('custom-loop.php'));
              ?>
            </div>
            <?php endif; ?>
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
