<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">

		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'highstake' ),
				'after'  => '</div>',
			) );
		?>

	</div>

	<footer class="entry-footer">

		<?php
			$tags = get_the_tags();
			if ( $tags ) :
		?>
			<span class="tag-links">
				<?php foreach( $tags as $tag ) : ?>
					<a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>">#<?php echo esc_attr( $tag->name ); ?></a>
				<?php endforeach; ?>
			</span>
		<?php endif; ?>

		<?php highstake_social_share(); ?>

	</footer>

</article><!-- #post-## -->
