<?php
// Get the customizer value.
$title = get_theme_mod( 'highstake_page_title', 1 );
$image = get_theme_mod( 'highstake_page_featured_image', 0 );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() && $image ) : ?>
		<a class="thumbnail-link" href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail( 'large', array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title() ) ) ); ?>
		</a>
	<?php endif; ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'highstake' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php edit_post_link( esc_html__( 'Edit', 'highstake' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer>' ); ?>

</article><!-- #post-## -->
