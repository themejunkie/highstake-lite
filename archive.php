<?php get_header(); ?>

	<div class="container">

		<section id="primary" class="content-area">
			<main id="main" class="site-main">

				<?php if ( have_posts() ) : ?>

					<?php while ( have_posts() ) : the_post(); ?>

						<?php if ( $wp_query->current_post == 0 && !is_paged() ) : ?>
							<?php get_template_part( 'partials/post/content', get_post_format() ); ?>
						<?php else : ?>
							<?php get_template_part( 'partials/content', 'archive' ); ?>
						<?php endif; ?>

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
