<?php
// Get the customizer data.
$layout = get_theme_mod( 'highstake_lite_blog_layouts', '2c-l' );

get_header(); ?>

	<div class="container">

		<div id="primary" class="content-area">
			<main id="main" class="site-main">

				<?php if ( have_posts() ) : ?>

					<?php while ( have_posts() ) : the_post(); ?>

						<?php if (
							$layout == '2c-l-l' ||
							$layout == '2c-r-l' ||
							$layout == '1c-l' ||
							$layout == '1c-n-l'
						) : ?>
							<?php if ( $wp_query->current_post == 0 && !is_paged() ) : ?>
								<?php get_template_part( 'partials/post/content', get_post_format() ); ?>
							<?php else : ?>
								<?php get_template_part( 'partials/content', 'archive' ); ?>
							<?php endif; ?>
						<?php else : ?>
							<?php get_template_part( 'partials/post/content', get_post_format() ); ?>
						<?php endif; ?>

					<?php endwhile; ?>

					<?php get_template_part( 'pagination' ); // Loads the pagination.php template  ?>

				<?php else : ?>

					<?php get_template_part( 'partials/content', 'none' ); ?>

				<?php endif; ?>

			</main><!-- #main -->
		</div><!-- #primary -->

		<?php get_sidebar(); ?>

	</div><!-- .container -->

<?php get_footer(); ?>
