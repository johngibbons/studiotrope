<?php if (have_posts()): while (have_posts()) : the_post(); ?>

		<?php if ( get_post_type() == "tropers" ) :?>
			<article id="troper-<?php the_ID(); ?>" <?php post_class(); ?>>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="no-underline">
					<?php $avatar = get_field("st_profile_picture"); ?>
			  	<?php $thumb = $avatar["sizes"]["thumbnail"]; ?>
			  	<img src="<?php echo $thumb; ?>" alt="<?php echo $avatar['alt']; ?>" class="troper-avatar">
				</a>
		<?php endif; ?>

		<?php if ( get_post_type() == "projects" ) :?>
			<article id="project-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="no-underline">
						<?php the_post_thumbnail(array(120,120)); // Declare pixel size you need inside the array ?>
					</a>
				<?php endif; ?>
		<?php endif; ?>

		<!-- post title -->
		<h2>
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
		</h2>
		<!-- /post title -->

		<!-- post details -->
		<span class="date">
			<time datetime="<?php the_time('Y-m-d'); ?> <?php the_time('H:i'); ?>">
				<?php the_date(); ?> <?php the_time(); ?>
			</time>
		</span>
		<!-- /post details -->

		<?php html5wp_excerpt('html5wp_index'); // Build your custom callback length in functions.php ?>

		<?php edit_post_link(); ?>

	</article>
	<!-- /article -->

<?php endwhile; ?>

<?php else: ?>

	<!-- article -->
	<article>
		<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
	</article>
	<!-- /article -->

<?php endif; ?>
