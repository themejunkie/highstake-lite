<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<a class="thumbnail-link" href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail( 'large', array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title() ) ) ); ?>
			<span class="quote-content">
				<i class="fa fa-quote-left"></i>
				<span class="quote"><?php the_excerpt(); ?></span>
				<span class="author"><?php the_title(); ?></span>
			</span>
		</a>
	<?php endif; ?>

</article><!-- #post-## -->
