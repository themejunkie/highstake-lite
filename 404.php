<?php get_header(); ?>

	<div class="container">

		<div id="primary" class="content-area">
			<main id="main" class="site-main">

				<section class="error-404 not-found">

					<div class="page-content">
						<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'highstake-lite' ); ?></p>
						<ul>
							<li><a href="javascript: history.go(-1);"><?php esc_html_e( 'Go to Previous Page', 'highstake-lite' ) ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Go to Home Page', 'highstake-lite' ) ?></a></li>
						</ul>
					</div><!-- .page-content -->
				</section><!-- .error-404 -->

			</main><!-- #main -->
		</div><!-- #primary -->

		<?php get_sidebar(); ?>

	</div>
<?php get_footer(); ?>
