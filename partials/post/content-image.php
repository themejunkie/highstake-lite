<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="format-image-inner">

		<?php if ( has_post_thumbnail() ) : ?>
			<a class="thumbnail-link" href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'highstake-post-featured-image', array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title() ) ) ); ?>
				<i class="fa fa-camera" aria-hidden="true"></i>
			</a>
		<?php endif; ?>

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

			<?php highstake_lite_post_meta(); ?>

		</header>

	</div>

</article><!-- #post-## -->
