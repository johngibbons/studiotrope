<?php get_header(); ?>

	<div class="l-container">

		<main role="main">
			<!-- section -->
			<?php if (have_posts()): while (have_posts()) : the_post(); ?>
				<section id="project-<?php the_ID(); ?>" <?php post_class(); ?>>

					<!-- post thumbnail -->
					<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
						<div class="project-featured-image">
							<?php the_post_thumbnail(); // Fullsize image for the single post ?>
						</div>
					<?php endif; ?>
					<!-- /post thumbnail -->

					<div class="project-details">
						<!-- post title -->
						<h1 class="project-title">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
						</h1>
						<!-- /post title -->

						<p class="project-detail"><?php the_terms( $post->ID, 'studio', '<span class="project-detail-label">Studio: </span>', ' / ' ); ?></p>

						<p class="project-detail"><?php the_terms( $post->ID, 'project_type', '<span class="project-detail-label">Project Type: </span>', ' / ' ); ?></p>

						<p class="project-detail"><?php the_tags( __( '<span class="project-detail-label">Tags: </span>', 'html5blank' ), ', ', '<br>'); // Separated by commas with a line break at the end ?></p>

					</div>

					<div class="project-contents">

					<?php

						// check if the flexible content field has rows of data
						if( have_rows('flexible_project_content') ):

						     // loop through the rows of data
						    while ( have_rows('flexible_project_content') ) : the_row();

					        	$width = get_sub_field('st_content_width');

					        	if(get_sub_field('st_last')) {
					        		$last = "last";
					        	};

						        if( get_row_layout() == 'project_image' ):

						        	$image = get_sub_field('st_image');

							        		?> <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="<?php echo "l_" . $width . " " . $last; ?>"> 
							        		
	        		<?php elseif( get_row_layout() == 'project_description' ): 

						        	?><p class="project-description <?php echo "l_" . $width . " " . $last; ?>"><?php the_sub_field('st_description'); ?></p>

			        <?php elseif( get_row_layout() == 'project_testimonial' ): ?> 

						        	<p class="testimonial <?php echo "l_" . $width . " " . $last; ?>"><?php the_sub_field('st_testimonial'); ?></p>

						        	<?php

						        endif;

						    endwhile;

						else :

						    // no layouts found

						endif;

					?>

					</div>

				</section>

			<?php endwhile; ?>

			<?php else: ?>

				<!-- article -->
				<section>

					<h1><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>

				</section>
				<!-- /article -->

			<?php endif; ?>
			<!-- /section -->
		</main>

	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>