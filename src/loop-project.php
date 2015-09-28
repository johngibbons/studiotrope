<?php if ($wp_query->posts) { $projects = $wp_query->posts; } ?>

<?php if ($projects): ?>
  <?php foreach($projects as $project): ?>
    <?php global $post; ?>
    <?php $post = $project; ?>
    <?php setup_postdata( $post ); ?>
    <?php if(get_post_type(get_the_ID()) === "project") : ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class("mix"); ?>>
        <?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
          <?php $url = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'small' ); ?>
          <?php $url = $url[0]; ?>
          <a href="<?php the_permalink(); ?>">
            <h3 class="thumb-title"><?php echo the_title(); ?></h3>
            <span class="project-voice-thumb is-hidden"><span><?php echo get_post_meta(get_the_id(), "project_voice", true); ?></span></span>
            <span class="project-thumb lazy" data-original="<?php echo $url ?>" style="background-color: #eee;"></span>
          </a>
        <?php endif; ?>
      </article>
    <?php endif; ?>
  <?php endforeach; ?>
<?php else: ?>
  <article>
    <h2><?php _e( 'No results. Please try again.', 'html5blank' ); ?></h2>
  </article>
<?php endif; ?>
