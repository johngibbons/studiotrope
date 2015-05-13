<?php if (have_posts()): while (have_posts()) : the_post(); ?>

	<!-- article -->
	<article id="troper-<?php the_ID(); ?>" <?php post_class(); ?>>

		<!-- post thumbnail -->
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="no-underline">
			<?php $avatar = get_field("st_profile_picture"); ?>
	  	<?php $thumb = $avatar["sizes"]["thumbnail"]; ?>
	  	<img src="<?php echo $thumb; ?>" alt="<?php echo $avatar['alt']; ?>" class="troper-avatar">
		</a>
		<!-- /post thumbnail -->

		<!-- post title -->
		<h2>
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
		</h2>
		<!-- /post title -->

		<!-- post details -->

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