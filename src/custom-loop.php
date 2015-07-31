<?php foreach( $posts as $post ):  setup_postdata( $post );?>
  <article id="post-<?php the_ID(); ?>" class="mix no-filter">
    <?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
      <?php $url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium' ); ?>
      <?php $url = $url[0]; ?>
      <a href="<?php the_permalink(); ?>">
        <h3 class="thumb-title"><?php echo the_title(); ?></h3>
        <span class="project-thumb" style="background-image: url( <?php echo $url ?> );"></span>
      </a>
    <?php else: ?>
      <a href="<?php the_permalink(); ?>">
        <?php $avatar = get_field("st_profile_picture"); ?>
        <?php $thumb = $avatar["sizes"]["thumbnail"]; ?>
        <img src="<?php echo $thumb; ?>" alt="<?php echo $avatar['alt']; ?>" class="troper-avatar">
        <p class="abbrev"><?php the_field("abbreviation"); ?></p>
        <p class="troper-name"><?php the_title(); ?></p>
      </a>
    <?php endif; ?>
  </article>
<?php endforeach; ?>
<?php wp_reset_postdata(); ?>
<div class="gap"></div>
<div class="gap"></div>
<div class="gap"></div>
