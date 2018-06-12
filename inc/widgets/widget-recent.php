<?php
/**
 * Recent Posts with Thumbnail widget.
 *
 * @package    Highstake
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2018, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class Highstake_Recent_Widget extends WP_Widget {

	/**
	 * Sets up the widgets.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		// Set up the widget options.
		$widget_options = array(
			'classname'   => 'widget-highstake-recent posts-thumbnail-widget',
			'description' => esc_html__( 'Display recent posts with thumbnails.', 'highstake' )
		);

		// Create the widget.
		parent::__construct(
			'highstake-recent',                                   // $this->id_base
			esc_html__( '&raquo; Recent Posts Thumbnails', 'highstake' ), // $this->name
			$widget_options                                      // $this->widget_options
		);

	}

	/**
	 * Outputs the widget based on the arguments input through the widget controls.
	 *
	 * @since 1.0.0
	 */
	function widget( $args, $instance ) {
		extract( $args );

		// Output the theme's $before_widget wrapper.
		echo $before_widget;

		// If the title not empty, display it.
		if ( $instance['title'] ) {
			echo $before_title . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $after_title;
		}

		// Posts query arguments.
		$args = array(
			'post_type'      => 'post',
			'posts_per_page' => $instance['limit']
		);

		// The post query
		$recent = new WP_Query( $args );

		if ( $recent->have_posts() ) : ?>
			<ul>

				<?php while ( $recent->have_posts() ) : $recent->the_post(); ?>

					<li>
						<?php if ( has_post_thumbnail() ) : ?>
							<a class="thumbnail-link" href="<?php the_permalink(); ?>" rel="bookmark">
								<?php the_post_thumbnail( 'thumbnail', array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title() ) ) ); ?>
							</a>
						<?php endif; ?>
						<a class="post-title" href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
						<?php
							$category = get_the_category( get_the_ID() );
							if ( $category ) :
						?>
						<span class="cat-link">
							<a href="<?php echo esc_url( get_category_link( $category[0]->term_id ) ); ?>"><?php echo esc_attr( $category[0]->name ); ?></a>
						</span>
						<?php endif; // End if categories ?>
					</li>

				<?php endwhile; ?>

			</ul>
		<?php endif;

		// Reset the query.
		wp_reset_postdata();

		// Close the theme's widget wrapper.
		echo $after_widget;

	}

	/**
	 * Updates the widget control options for the particular instance of the widget.
	 *
	 * @since 1.0.0
	 */
	function update( $new_instance, $old_instance ) {

		$instance = $new_instance;
		$instance['title']     = strip_tags( $new_instance['title'] );
		$instance['limit']     = (int) $new_instance['limit'];

		return $instance;
	}

	/**
	 * Displays the widget control options in the Widgets admin screen.
	 *
	 * @since 1.0.0
	 */
	function form( $instance ) {

		// Default value.
		$defaults = array(
			'title'     => esc_html__( 'Recent Posts', 'highstake' ),
			'limit'     => 5
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
	?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">
				<?php esc_html_e( 'Title', 'highstake' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'limit' ); ?>">
				<?php esc_html_e( 'Number of posts to show', 'highstake' ); ?>
			</label>
			<input class="small-text" id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>" type="number" step="1" min="0" value="<?php echo (int)( $instance['limit'] ); ?>" />
		</p>

	<?php

	}

}
