<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">

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

		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php highstake_post_meta(); ?>

	</header>

	<?php echo highstake_get_format_gallery(); ?>

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>

	<span class="more-link-wrapper">
		<a href="<?php the_permalink(); ?>" class="more-link button"><?php esc_html_e( 'Read More', 'highstake' ); ?></a>
	</span>

	<?php highstake_social_share(); ?>

</article><!-- #post-## -->
