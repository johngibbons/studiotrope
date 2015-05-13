<?php get_header(); ?>

	<div class="l-container">

		<main role="main">
			<!-- section -->
			<section>

			<?php if (have_posts()): while (have_posts()) : the_post(); ?>

				<!-- article -->
				<article id="troper-<?php the_ID(); ?>" <?php post_class(); ?>>

					<!-- post thumbnail -->
					<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							<?php the_post_thumbnail(); // Fullsize image for the single post ?>
						</a>
					<?php endif; ?>

					<?php $avatar = get_field("st_profile_picture"); ?>
					<?php $photo = $avatar["sizes"]["medium"]; ?>
					<?php if( !empty($avatar) ): ?>

					<?php endif; ?> 
			  	<img src="<?php echo $photo; ?>" alt="<?php echo $avatar['alt']; ?>" class="troper-avatar">
					<!-- /post thumbnail -->

					<!-- post title -->
					<h1>
						<?php the_title(); ?>
					</h1>
					<!-- /post title -->
					<p><?php the_terms( $post->ID, 'studio', '', ' / ' ); ?></p>
					<p><?php the_field("st_email_address"); ?></p>
					<p><?php the_field("st_bio"); ?></p>

					<p><?php _e( 'Categorised in: ', 'html5blank' ); the_category(', '); // Separated by commas ?></p>

					<p><?php _e( 'This post was written by ', 'html5blank' ); the_author(); ?></p>

					<?php edit_post_link(); // Always handy to have Edit Post Links available ?>

					<?php comments_template(); ?>

				</article>
				<!-- /article -->

			<?php endwhile; ?>

			<?php else: ?>

				<!-- article -->
				<article>

					<h1><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>

				</article>
				<!-- /article -->

			<?php endif; ?>

			</section>
			<!-- /section -->
		</main>
	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>