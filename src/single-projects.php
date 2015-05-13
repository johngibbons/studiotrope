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

					<div class="project-details l-full-bleed">
						<!-- post title -->
						<h1 class="project-title">
							<?php the_title(); ?>
						</h1>
						<!-- /post title -->

						<table class="detail">
							<tr>
								<td class="project-detail-label">Studio:</td>
								<td><?php the_terms( $post->ID, 'studio', '', ' / ' ); ?></td>
							</tr>
							<tr>
								<td class="project-detail-label">Project Type:</td>
								<td><?php the_terms( $post->ID, 'project_type', '', ' / ' ); ?></td>
							</tr>
							<tr>
								<td class="project-detail-label">Tags:</td>
								<td><?php the_tags( '', ' / ', ''); // Surrounded by spans ?></td>
							</tr>
							<?php
								// Find connected tropers
								$tropers = new WP_Query( array(
								  'connected_type' => 'projects_to_tropers',
								  'connected_items' => get_queried_object(),
								  'nopaging' => true,
								) );

								// Display connected tropers
								if ( $tropers->have_posts() ) :
									?>
								<tr>
									<td class="project-detail-label">Contributers:</td>
								</tr>
								<tr>
									<td>
										<?php while ( $tropers->have_posts() ) : $tropers->the_post(); ?>
									  	<a href="<?php the_permalink(); ?>" class="troper-thumb no-underline">
										  	<?php $avatar = get_field("st_profile_picture"); ?>
										  	<?php $thumb = $avatar["sizes"]["thumbnail"]; ?>
										  	<img src="<?php echo $thumb; ?>" alt="<?php echo $avatar['alt']; ?>" class="troper-avatar">
									  	</a>
										<?php endwhile; ?>
									</td>
								</tr>

									<?php 
									// Prevent weirdness
									wp_reset_postdata();

								endif;
							?>
						</table>

					</div>

					<div class="project-contents l-content-module l_full">

					<?php

						// check if the flexible content field has rows of data
						if( have_rows('flexible_project_content') ):

						     // loop through the rows of data
								$row_num = 0;
						    while ( have_rows('flexible_project_content') ) : the_row();
						  			$row_num++;
					        	$width = get_sub_field('st_content_width');

					        	if(get_sub_field('st_last')) {
					        		$last = "last";
					        	}
					        	else {
					        		$last = "";
					        	}

					        	switch (get_row_layout()) {
									    case "project_image":
								        $image = get_sub_field('st_image');

						        		?> <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="project-image l-content-module <?php echo "l_" . $width . " " . $last; ?>" data-content-id="<?php echo $row_num ?>"> 
								        <?php break;

									    case "project_description":
								        ?><p class="project-description l-content-module <?php echo "l_" . $width . " " . $last; ?>" data-content-id="<?php echo $row_num ?>"><?php the_sub_field('st_description'); ?></p>
								        <?php break;

									    case "project_testimonial":
								        ?><div class="project-testimonial l-content-module l-full-bleed <?php echo "l_" . $width . " " . $last; ?>" data-content-id="<?php echo $row_num ?>">
								        		<q><?php the_sub_field('st_testimonial'); ?></q>
								        		<span class="testimonial-source"><?php the_sub_field('st_testimonial_source'); ?></span>
								        	</div>
							        	<?php break;

							        case "project_video":
								        ?><div class="project-video l-content-module <?php echo "l_" . $width . " " . $last; ?>" data-content-id="<?php echo $row_num ?>"><?php the_sub_field('st_video'); ?></div>
							        	<?php break;
										}

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