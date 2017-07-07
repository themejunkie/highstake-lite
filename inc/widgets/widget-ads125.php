<?php
/**
 * Ads 125x125 widget.
 *
 * @package    Highstake
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class Highstake_Ads125_Widget extends WP_Widget {

	/**
	 * Sets up the widgets.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		// Set up the widget options.
		$widget_options = array(
			'classname'   => 'widget_125',
			'description' => esc_html__( 'Easily to display any type of ad.', 'highstake' )
		);

		// Create the widget.
		parent::__construct(
			'highstake-ad125',                                  // $this->id_base
			esc_html__( '&raquo; Advertisement 125x125', 'highstake' ), // $this->name
			$widget_options                                  // $this->widget_options
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

			// Display the ad banner.
			if ( $instance['ad_code1'] ) {
				echo stripslashes( $instance['ad_code1'] );
			}

			if ( $instance['ad_code2'] ) {
				echo '<span class="img-right">' . stripslashes( $instance['ad_code2'] ) . '</span>';
			}

			if ( $instance['ad_code3'] ) {
				echo stripslashes( $instance['ad_code3'] );
			}

			if ( $instance['ad_code4'] ) {
				echo '<span class="img-right">' . stripslashes( $instance['ad_code4'] ) . '</span>';
			}

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

		$instance['title']    = strip_tags( $new_instance['title'] );
		$instance['ad_code1'] = stripslashes( $new_instance['ad_code1'] );
		$instance['ad_code2'] = stripslashes( $new_instance['ad_code2'] );
		$instance['ad_code3'] = stripslashes( $new_instance['ad_code3'] );
		$instance['ad_code4'] = stripslashes( $new_instance['ad_code4'] );

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
			'title'    => esc_html__( 'Advertisement', 'highstake' ),
			'ad_code1' => '',
			'ad_code2' => '',
			'ad_code3' => '',
			'ad_code4' => '',
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
	?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">
				<?php esc_html_e( 'Title:', 'highstake' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'ad_code1' ); ?>">
				<?php esc_html_e( 'Ad Code 1:', 'highstake' ); ?>
			</label>
			<textarea class="widefat" name="<?php echo $this->get_field_name( 'ad_code1' ); ?>" id="<?php echo $this->get_field_id( 'ad_code1' ); ?>" cols="30" rows="6"><?php echo stripslashes( $instance['ad_code1'] ); ?></textarea>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'ad_code2' ); ?>">
				<?php esc_html_e( 'Ad Code 2:', 'highstake' ); ?>
			</label>
			<textarea class="widefat" name="<?php echo $this->get_field_name( 'ad_code2' ); ?>" id="<?php echo $this->get_field_id( 'ad_code2' ); ?>" cols="30" rows="6"><?php echo stripslashes( $instance['ad_code2'] ); ?></textarea>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'ad_code3' ); ?>">
				<?php esc_html_e( 'Ad Code 3:', 'highstake' ); ?>
			</label>
			<textarea class="widefat" name="<?php echo $this->get_field_name( 'ad_code3' ); ?>" id="<?php echo $this->get_field_id( 'ad_code3' ); ?>" cols="30" rows="6"><?php echo stripslashes( $instance['ad_code3'] ); ?></textarea>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'ad_code4' ); ?>">
				<?php esc_html_e( 'Ad Code 4:', 'highstake' ); ?>
			</label>
			<textarea class="widefat" name="<?php echo $this->get_field_name( 'ad_code4' ); ?>" id="<?php echo $this->get_field_id( 'ad_code4' ); ?>" cols="30" rows="6"><?php echo stripslashes( $instance['ad_code4'] ); ?></textarea>
		</p>

	<?php

	}

}
