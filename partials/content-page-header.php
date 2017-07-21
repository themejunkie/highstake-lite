<?php if ( is_home() ) : ?>
	<?php get_template_part( 'partials/featured/content', 'featured' ); ?>
<?php endif; ?>

<?php if ( is_archive() ) : ?>
	<div class="page-header">
		<div class="container">
			<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="page-description">', '</div>' );
			?>
		</div>
	</div><!-- .page-header -->
<?php endif; ?>

<?php if ( is_search() ) : ?>
	<div class="page-header">
		<div class="container">
			<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'highstake' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		</div>
	</div><!-- .page-header -->
<?php endif; ?>

<?php if ( is_404() ) : ?>
	<div class="page-header">
		<div class="container">
			<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'highstake' ); ?></h1>
		</div>
	</div><!-- .page-header -->
<?php endif; ?>

<?php if ( is_page() || is_single() ) : ?>
	<div data-jarallax='{"speed": 0.4}' class="page-header jarallax">
		<div class="container">

			<?php if ( 'post' == get_post_type() ) : ?>
				<?php
					$category = get_the_category( get_the_ID() );
					if ( $category ) :
				?>
				<span class="cat-link">
					<a href="<?php echo esc_url( get_category_link( $category[0]->term_id ) ); ?>"><?php echo esc_attr( $category[0]->name ); ?></a>
				</span>
				<?php endif; // End if categories ?>
			<?php endif; ?>

			<h1 class="page-title"><?php the_title(); ?></h1>

			<?php if ( 'post' == get_post_type() ) : ?>
				<?php highstake_post_meta(); ?>
			<?php endif; ?>

		</div>
	</div><!-- .page-header -->
<?php endif; ?>
