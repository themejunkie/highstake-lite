<?php
// Get the customizer data
$title = get_theme_mod( 'highstake_lite_callout_posts_title', 'Editor\'s Choice' );

// Main post query
$query = array(
	'post_type'           => 'post',
	'posts_per_page'      => 4,
	'ignore_sticky_posts' => 1
);

// Get the tag id
$name = get_theme_mod( 'highstake_lite_callout_posts_tag', 'editor choice' );
if ( $name ) {
	$term = get_term_by( 'name', $name, 'post_tag' );

	// Adds the custom arguments to the main query
	if ( $term ) {
		$query['tag_id'] = $term->term_id;
	}
}

// Allow dev to filter the query.
$query = apply_filters( 'highstake_lite_callout_posts_args', $query );

$callout = new WP_Query( $query );
?>

<?php if ( $callout->have_posts() ) : ?>

	<div class="callout callout-posts posts-in-grid">
		<div class="container">

			<h3 class="callout-posts-title posts-in-grid-title"><?php echo esc_attr( $title ); ?></h3>

			<ul>
				<?php while ( $callout->have_posts() ) : $callout->the_post(); ?>
					<li>
						<?php if ( has_post_thumbnail() ) : ?>
							<a class="thumbnail-link" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'highstake-posts-in-grid', array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title() ) ) ); ?></a>
						<?php endif; ?>
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
					</li>
				<?php endwhile; ?>
			</ul>

		</div>
	</div>

<?php endif; wp_reset_postdata(); ?>
