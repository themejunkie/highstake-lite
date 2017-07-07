<?php
/**
 * Feedburner widget.
 *
 * @package    Highstake
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2017, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class Highstake_Feedburner_Widget extends WP_Widget {

	/**
	 * Sets up the widgets.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		// Set up the widget options.
		$widget_options = array(
			'classname'   => 'widget-highstake-feedburner subscribe-widget',
			'description' => esc_html__( 'FeedBurner email subscription.', 'highstake' )
		);

		// Create the widget.
		parent::__construct(
			'highstake-feedburner',                  // $this->id_base
			esc_html__( '&raquo; Feedburner', 'highstake' ), // $this->name
			$widget_options                         // $this->widget_options
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

		// Display the form.
		if ( $instance['feed_id'] ) { ?>
			<form class="form-subscribe" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo strip_tags( $instance['feed_id'] ); ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520'); return true">
				<?php if ( $instance['before'] ) { ?>
					<p class="help-block"><?php echo stripslashes( $instance['before'] ); ?></p>
				<?php } ?>
				<input type="text" name="email" placeholder="<?php esc_attr_e( 'Enter your email', 'highstake' ); ?>">
				<input type="hidden" value="<?php echo strip_tags( $instance['feed_id'] ); ?>" name="uri">
				<input type="hidden" value="<?php echo strip_tags( $instance['feed_id'] ); ?>" name="title">
				<input type="hidden" name="loc" value="en_US">
				<button class="btn" type="submit" name="submit"><?php echo esc_attr( $instance['button_text'] ); ?></button>
			</form>
		<?php
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

		$instance['title']       = strip_tags( $new_instance['title'] );
		$instance['before']      = stripslashes( $new_instance['before'] );
		$instance['feed_id']     = strip_tags( $new_instance['feed_id'] );
		$instance['button_text'] = strip_tags( $new_instance['button_text'] );

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
			'title'   => esc_html__( 'Get Updates', 'highstake' ),
			'before'  => esc_html__( 'Subscribe to our newsletter to receive breaking news by email.', 'highstake' ),
			'feed_id' => '',
			'button_text' => esc_html__( 'Subscribe', 'highstake' )
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
			<label for="<?php echo $this->get_field_id( 'before' ); ?>">
				<?php esc_html_e( 'HTML or Text before form:', 'highstake' ); ?>
			</label>
			<textarea class="widefat" name="<?php echo $this->get_field_name( 'before' ); ?>" id="<?php echo $this->get_field_id( 'before' ); ?>" cols="30" rows="6"><?php echo stripslashes( $instance['before'] ); ?></textarea>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'feed_id' ); ?>">
				<?php esc_html_e( 'Feedburner ID:', 'highstake' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'feed_id' ); ?>" name="<?php echo $this->get_field_name( 'feed_id' ); ?>" value="<?php echo esc_attr( $instance['feed_id'] ); ?>" placeholder="<?php echo esc_attr( 'ThemeJunkie' ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'button_text' ); ?>">
				<?php esc_html_e( 'Button Text', 'highstake' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'button_text' ); ?>" name="<?php echo $this->get_field_name( 'button_text' ); ?>" value="<?php echo esc_attr( $instance['button_text'] ); ?>" placeholder="<?php echo esc_attr( 'Subscribe' ); ?>" />
		</p>

	<?php

	}

}
