<?php /* Template Name: Home Page Template */ get_header(); ?>
<main role="main">
  <section id="home-hero" class="hero">
    <?php if (have_posts()): while (have_posts()) : the_post(); ?>
          <div id="home-video" class="l-full video">
            <iframe src="https://player.vimeo.com/video/7809605?autoplay=1&loop=1&title=0&byline=0&portrait=0" width="500" height="281" frameborder="0" volume="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
          </div>
          <?php $image = get_field('home_mobile_image'); ?>
          <div id="home-mobile-image" style="background-image: url(<?php echo $image["url"]; ?>)">
          </div>
    <?php endwhile; ?>
    <?php else: ?>
      <article>
        <h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
      </article>
    <?php endif; ?>
    <div id="home-video-overlay">
      <img src="<?php echo get_template_directory_uri(); ?>/img/logo_white.svg" alt="Logo" class="logo-img">
      <p id="home-statement">
        <?php the_field("home_statement") ?>
      </p>
      <?php $page = get_page_by_title("The Collective"); ?>
      <a href="<?php echo get_page_link($page->ID); ?>">
        <button class="cta-home underline-btn">
          <span class="btn-text">Learn About The Collective</span>
        </button>
      </a>
      <a href="<?php echo get_post_type_archive_link("project"); ?>">
        <button class="cta-home underline-btn">
          <span class="btn-text">See Our Work</span>
        </button>
      </a>
    </div>
  </section>
</main>
<?php get_footer(); ?>
