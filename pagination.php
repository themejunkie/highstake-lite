<?php if ( is_home() || is_archive() || is_search() ) : // If viewing the blog, an archive, or search results. ?>

	<?php
		$type = get_theme_mod( 'highstake_posts_pagination', 'number' );
		if ( $type == 'number' ) :
	?>
		<?php the_posts_pagination(); ?>
	<?php else :
		global $wp_query;
		if ( $wp_query->max_num_pages > 1 ) : ?>
			<nav class="navigation pagination traditional-pagination" role="navigation">
				<h2 class="screen-reader-text"><?php esc_html_e( 'Posts navigation', 'highstake' ) ?></h2>
				<div class="nav-previous next"><?php next_posts_link( esc_html__( 'Older posts &raquo;', 'highstake' ) ); ?></div>
				<div class="nav-next prev"><?php previous_posts_link( esc_html__( '&laquo; Newer posts', 'highstake' ) ); ?></div>
			</nav>
		<?php endif; ?>
	<?php endif; ?>

<?php endif; ?>
