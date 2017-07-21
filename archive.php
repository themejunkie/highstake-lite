<?php get_header(); ?>

	<div class="container">

		<section id="primary" class="content-area">
			<main id="main" class="site-main">

				<?php if ( have_posts() ) : ?>

					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'partials/content', 'archive' ); ?>

					<?php endwhile; ?>

					<?php get_template_part( 'pagination' ); // Loads the pagination.php template  ?>

				<?php else : ?>

					<?php get_template_part( 'partials/content', 'none' ); ?>

				<?php endif; ?>

			</main><!-- #main -->
		</section><!-- #primary -->

		<?php get_sidebar(); ?>

	</div>

<?php get_footer(); ?>
