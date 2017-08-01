<?php
/**
 * The 'custom-text' customize control extends the WP_Customize_Control class.
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return NULL;
}

/**
 * Group Title customize control class.
 */
class Highstake_Custom_Text extends WP_Customize_Control {

	/**
	 * The type of customize control being rendered.
	 */
	public $type = 'custom-text';

	/**
	 * Displays the group-title on the customize screen.
	 */
	public function render_content() { ?>
		<div class="highstake-custom-text" style="margin-top: 1em; padding-top: 1em; border-top: 1px solid #ddd;">
			<?php if ( $this->label ) { ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php }
			if ( $this->description ) { ?>
				<span class="description customize-control-description"><?php echo $this->description; ?></span>
			<?php } ?>
		</div>
	<?php }

}
