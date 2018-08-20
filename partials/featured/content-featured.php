<?php
// Get the data set in customizer
$img  = get_theme_mod( 'highstake_lite_featured_default_img' );
$text = get_theme_mod( 'highstake_lite_featured_default_text' );

if ( $img ) : ?>

	<?php $img_src = wp_get_attachment_image_src( absint( $img ), 'full' ); ?>
	<div data-jarallax data-speed="0.2" class="featured featured-default jarallax" style="background-image: url(<?php echo esc_url( $img_src[0] ); ?>);">

		<div class="container">
			<?php if ( $text ) : ?>
				<div class="featured-default-text">
					<?php echo wp_kses_post( $text ); ?>
				</div>
			<?php endif; ?>
		</div>

	</div>

<?php endif; ?>
