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
			<?php endif; // End if categories ?>
		<?php endif; ?>

		<time class="entry-date published" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>

		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

	</header>

	<?php $video = hybrid_media_grabber( array( 'type' => 'video', 'split_media' => true ) ); ?>
	<?php if ( $video ) :  ?>
		<div class="entry-format"><?php echo $video; ?></div>
	<?php elseif ( has_post_thumbnail() ) : ?>
		<a class="thumbnail-link" href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail( 'large', array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title() ) ) ); ?>
		</a>
	<?php endif; ?>

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>

	<span class="more-link-wrapper">
		<a href="<?php the_permalink(); ?>" class="more-link"><?php esc_html_e( 'Continue Reading', 'highstake' ); ?></a>
	</span>

</article><!-- #post-## -->
