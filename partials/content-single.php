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

		<time class="entry-date published" datetime="<?php echo esc_html( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

	</header>

	<?php if ( has_post_format( 'video' ) ) : ?>
		<div class="entry-format">
			<?php echo hybrid_media_grabber( array( 'type' => 'video', 'split_media' => true ) ); ?>
		</div>
	<?php elseif ( has_post_format( 'audio' ) ) : ?>
		<div class="entry-format">
			<?php echo hybrid_media_grabber( array( 'type' => 'audio', 'split_media' => true ) ); ?>
		</div>
	<?php elseif ( ! has_post_format( 'quote' ) ) : ?>
		<?php if ( has_post_thumbnail() ) : ?>
			<a class="thumbnail-link" href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'large', array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title() ) ) ); ?>
			</a>
		<?php endif; ?>
	<?php endif; ?>

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
					<a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>"><?php echo esc_attr( $tag->name ); ?></a>
				<?php endforeach; ?>
			</span>
		<?php endif; ?>

	</footer>

</article><!-- #post-## -->
