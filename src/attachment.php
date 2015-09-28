<?php get_header(); ?>
<?php get_template_part("contextual-module"); ?>
  <main class="l-container-w-side" role="main">
    <!-- section -->
    <section>
      <?php if (have_posts()): while (have_posts()) : the_post(); 
        $imgattr = array(
          'alt' => trim( strip_tags( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) ),
        );
        $url = wp_get_attachment_image_src( $post->ID, "original", $imgattr );
        $url = $url[0]; ?>
        <img src = <?php echo $url; ?>>
      <?php endwhile; ?>
      <?php endif; ?>
    </section>
  </main>

<?php get_footer(); ?>
