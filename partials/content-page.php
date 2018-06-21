<?php
// Get the customizer value.
$title = get_theme_mod( 'highstake_page_title', 1 );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="page-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'highstake-lite' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php edit_post_link( esc_html__( 'Edit', 'highstake-lite' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer>' ); ?>

</article><!-- #post-## -->
