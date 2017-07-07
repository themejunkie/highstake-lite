<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">

		<?php if ( 'post' == get_post_type() ) : ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( esc_html__( ', ', 'highstake' ) );
				if ( $categories_list && highstake_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php echo $categories_list; ?>
			</span>
			<i class="fa fa-circle"></i>
			<?php endif; // End if categories ?>
		<?php endif; ?>

		<time class="entry-date published entry-side" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>

		<?php highstake_get_post_format_link_url(); ?>

	</header>

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>

</article><!-- #post-## -->
