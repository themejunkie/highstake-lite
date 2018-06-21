<?php
// Return early if no widget found.
if ( ! is_active_sidebar( 'primary' ) ) {
	return;
}

// Return early if user uses 1 column layout.
if ( in_array( get_theme_mod( 'theme_layout' ), array( '1c', '1c-n' ) ) ) {
	return;
}
?>

<div id="secondary" class="widget-area" aria-label="<?php echo esc_attr_x( 'Primary Sidebar', 'Sidebar aria label', 'highstake-lite' ); ?>">
	<?php dynamic_sidebar( 'primary' ); ?>
</div><!-- #secondary -->
