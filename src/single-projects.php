<?php get_header(); ?>

	<div class="l-container">

		<main role="main">
		<!-- section -->
		<section>

		<?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<!-- post thumbnail -->
				<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php the_post_thumbnail(); // Fullsize image for the single post ?>
					</a>
				<?php endif; ?>
				<!-- /post thumbnail -->

				<!-- post title -->
				<h1>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
				</h1>
				<!-- /post title -->

				<?php the_content(); // Dynamic Content ?>

				<p><?php the_terms( $post->ID, 'studio', '<span class="term_name">Studio: </span>', ' / ' ); ?></p>

				<p><?php the_terms( $post->ID, 'project_type', '<span class="term_name">Project Type: </span>', ' / ' ); ?></p>

				<?php the_tags( __( '<span class="term_name">Tags: </span>', 'html5blank' ), ', ', '<br>'); // Separated by commas with a line break at the end ?>

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