<?php get_header(); ?>

	<div class="container">

		<div id="primary" class="content-area">
			<main id="main" class="site-main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'partials/content', 'single' ); ?>

					<?php highstake_post_author_box(); // Display the author box. ?>

					<?php highstake_related_posts(); // Display the related posts. ?>

					<?php
						// Get data set in customizer
						$comment = get_theme_mod( 'highstake_post_comment', 1 );

						// Check if comment enable on customizer
						if ( $comment ) :
							// If enable and comments are open or we have at least one comment, load up the comment template
							if ( comments_open() || '0' != get_comments_number() ) :
								comments_template();
							endif;
						endif;
					?>

					<?php get_template_part( 'pagination' ); // Loads the pagination.php template  ?>

				<?php endwhile; // end of the loop. ?>

			</main><!-- #main -->
		</div><!-- #primary -->

		<?php get_sidebar(); ?>

	</div>

<?php get_footer(); ?>
