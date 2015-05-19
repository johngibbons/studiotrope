<?php /* Template Name: Home Page Template */ get_header(); ?>
<main role="main">
  <section id="home-hero" class="hero">
    <?php if (have_posts()): while (have_posts()) : the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <div id="home-video" class="l-full video">
            <iframe src="https://player.vimeo.com/video/7809605?autoplay=1&loop=1&title=0&byline=0&portrait=0" width="500" height="281" frameborder="0" volume="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
          </div>
          <?php $image = get_field('home_mobile_image'); ?>
          <div id="home-mobile-image" style="background-image: url(<?php echo $image["url"]; ?>)">
          </div>
      </article>
    <?php endwhile; ?>
    <?php else: ?>
      <article>
        <h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
      </article>
    <?php endif; ?>
    <div id="home-video-overlay">
      <img src="<?php echo get_template_directory_uri(); ?>/img/logo_white.svg" alt="Logo" class="logo-img">
      <p id="home-statement">
        every project is born from an idea.  studiotrope is the action which 
        gives life and significance to that idea.  want to know more?
      </p>
    </div>
  </section>
  <section id="home-studios-wrapper">
    <div id="home-architecture" class="home-studio">
     <h2>Architecture</h2> 
    </div>
    <div id="home-graphics" class="home-studio">
     <h2>Graphic Design</h2> 
    </div>
    <div id="home-interiors" class="home-studio">
     <h2>Interior Design</h2> 
    </div>
  </section>
</main>
<?php get_footer(); ?>
