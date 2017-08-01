<?php $shortcode = get_theme_mod( 'highstake_featured_custom' ); ?>
<?php if ( $shortcode ) : ?>
	<div class="featured featured-custom">
		<?php echo do_shortcode( wp_kses_post( $shortcode ) ); ?>
	</div>
<?php endif; ?>
