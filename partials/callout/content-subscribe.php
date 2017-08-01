<?php
// Get the data set in Customizer.
$title     = get_theme_mod( 'highstake_subscribe_title' );
$subtitle  = get_theme_mod( 'highstake_subscribe_subtitle' );
$shortcode = get_theme_mod( 'highstake_subscribe_shortcode' );

// Only show if has shortcode
if ( !$shortcode ) {
	return;
}
?>

<div class="subscribe-box">
	<div class="container">

			<div class="subscribe-icon"><i class="fa fa-line-chart" aria-hidden="true"></i></div>

			<div class="subscribe-form-wrapper">

				<?php if ( $title ) : ?>
					<h2 class="subscribe-title"><?php echo esc_attr( $title) ?></h2>
				<?php endif; ?>

				<?php if ( $subtitle ) : ?>
					<p class="subscribe-subtitle"><?php echo esc_attr( $subtitle) ?></p>
				<?php endif; ?>

				<?php if ( $shortcode ) : ?>
					<?php echo do_shortcode( esc_attr( $shortcode ) ); ?>
				<?php endif; ?>

			</div>

	</div>
</div>
