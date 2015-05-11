<?php get_header(); ?>

	<div class="l-container">

		<main role="main">
			<!-- section -->
			<section>

				<h1><?php _e( 'All Projects', 'html5blank' ); ?></h1>

				<?php get_template_part('loop-projects'); ?>

				<?php get_template_part('pagination'); ?>

			</section>
			<!-- /section -->
		</main>

	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>