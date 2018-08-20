<?php
// Get the customizer data
$number = get_theme_mod( 'highstake_lite_featured_posts_number', 3 );

// Get the tag id
$name = get_theme_mod( 'highstake_lite_featured_posts_tag', 'featured' );
if ( $name ) {
	$term = get_term_by( 'name', $name, 'post_tag' );
}

// Main post query
$query = array(
	'post_type'           => 'post',
	'posts_per_page'      => absint( $number ),
	'ignore_sticky_posts' => 1
);

// Get the sticky post ids
$sticky = get_option( 'sticky_posts' );

// Adds the custom arguments to the main query
if ( $term ) {
	$query['tag_id'] = $term->term_id;
} else {
	$query['post__in'] = $sticky;
}

// Allow dev to filter the query.
$query = apply_filters( 'highstake_lite_featured_posts_args', $query );

$featured = new WP_Query( $query );
?>

<?php if ( $featured->have_posts() ) : ?>

	<div class="featured featured-posts owl-carousel owl-theme">

		<?php while ( $featured->have_posts() ) : $featured->the_post(); ?>

			<?php $img = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'highstake-featured-image' ); ?>

			<div data-jarallax data-speed="0.2" <?php post_class( 'page-header jarallax' ); ?> style="background-image: url(<?php echo esc_url( $img[0] ) ?>)">
				<div class="container">

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

					<?php the_title( sprintf( '<h2 class="page-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

					<?php highstake_lite_post_meta(); ?>

				</div>
			</div>

		<?php endwhile; ?>

	</div>

<?php endif; wp_reset_postdata(); ?>
