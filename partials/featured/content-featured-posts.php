<?php
// Get the customizer data
$number = get_theme_mod( 'highstake_featured_posts_number', 3 );

// Get the tag id
$name = get_theme_mod( 'highstake_featured_posts_tag', 'featured' );
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
$query = apply_filters( 'highstake_featured_posts_args', $query );

$featured = new WP_Query( $query );
?>

<?php if ( $featured->have_posts() ) : ?>

	<div class="featured featured-posts owl-carousel owl-theme">

		<?php while ( $featured->have_posts() ) : $featured->the_post(); ?>

			<div <?php post_class(); ?>>

				<div class="post-thumbnail thumbnail">
					<?php if ( has_post_thumbnail() ) : ?>
						<a class="thumbnail-link" href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'highstake-featured-image', array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title() ) ) ); ?>
							<span class="overlay"></span>
						</a>
					<?php endif; ?>

					<?php
						$category = get_the_category( get_the_ID() );
						if ( $category ) :
					?>
						<span class="cat-links">
							<a href="<?php echo esc_url( get_category_link( $category[0]->term_id ) ); ?>"><?php echo esc_attr( $category[0]->name ); ?></a>
						</span>
					<?php endif; // End if category ?>

				</div>

				<div class="featured-content">

					<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

					<div class="featured-meta entry-meta">
						<?php // featured_entry_meta(); ?>
					</div>

				</div>

			</div>

		<?php endwhile; ?>

	</div>

<?php endif; wp_reset_postdata(); ?>
