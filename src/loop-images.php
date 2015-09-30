<?php
  if (have_posts()): while (have_posts()) : the_post();
 // define attributes for image display
    if($post->post_type === "attachment") :
      $imgattr = array(
        'alt' => trim( strip_tags( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) ),
      );
      $url = wp_get_attachment_image_src( $post->ID, "small", $imgattr );
      $url = $url[0]; ?>
      <div class="image mix">
        <a href ="<?php echo get_attachment_link(); ?>" rel="lightbox">
          <div class="image-thumb lazy" data-original="<?php echo $url; ?>" style ="background-color: #eee;"></div>
        </a>
      </div>
<?php endif;
  endwhile;
  endif;
?>
<div class="gap"></div>
<div class="gap"></div>
<div class="gap"></div>
