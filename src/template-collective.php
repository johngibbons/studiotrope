<?php /* Template Name: The Collective Page Template */ get_header(); ?>
<?php get_template_part("contextual-module") ?>
<main role="main" id="the-collective" class="l-container-w-side">
  <?php if (have_posts()): while (have_posts()) : the_post(); ?>
    <div id="slides-container">
      <div id="collective">
        <h1 class="page-title">
          <svg class="icon icons-combined header-icon">
            <use xlink:href="#icons_combined"></use>
          </svg>
          <span class="text"><?php the_title(); ?></span>
        </h1>

        <p id="scrollInstr">scroll down to learn about us.</p>
        <h2 class="studiotrope-text is-toAnimate">Studiotrope:</h2>
        <p class="pronunciation is-toAnimate">| ˈst(y)o͞odēˌō | trōp |</p>
        <p class="definition is-toAnimate">• verb • the act of revealing latent beauty, or the inability to capture with photography.</p>
        <p class="definition is-toAnimate">• synonyms • shared intuition, transcendent, allusive, experiential, phenomenological</p>
        <div class="description">
          <p class="first is-toAnimate">
            Studiotrope Design Collective is organized around three main studios:</p>
          <span class="architecture-link slide-link studio-name is-toAnimate">Architecture</span>
          <span class="graphics-link studio-name slide-link is-toAnimate">Graphic Design</span>
          <span class="interiors-link studio-name slide-link is-toAnimate">Interior Design</span>
          <p class="second is-toAnimate">
            Click on any of the studios to learn more.
          </p>
        </div>
      </div>
      <div id="architecture" class="slide is-toAnimate">
        <h1 class="page-title">
          <svg class="icon icons-combined header-icon">
            <use xlink:href="#architecture_icon"></use>
          </svg>
          <span class="text">Architecture</span>
        </h1>
        <p>architecture content here.</p>
      </div>
      <div id="graphic-design" class="slide is-toAnimate">
        <h1 class="page-title">
          <svg class="icon icons-combined header-icon">
            <use xlink:href="#graphics_icon"></use>
          </svg>
          <span class="text">Graphic Design</span>
        </h1>
        <p>Graphic Design content goes here.</p>
      </div>
      <div id="interiors" class="slide is-toAnimate">
        <h1 class="page-title">
          <svg class="icon icons-combined header-icon">
            <use xlink:href="#interiors_icon"></use>
          </svg>
          <span class="text">Interior Design</span>
        </h1>
        <p>Interior Design content goes here.</p>
      </div>
    </div>
  <?php endwhile; ?>
  <?php else: ?>
    <article>
      <h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
    </article>
  <?php endif; ?>
</main>
<?php get_footer(); ?>
