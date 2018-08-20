		</div><!-- #content -->

		<footer id="colophon" class="site-footer">

			<?php if ( has_nav_menu ( 'social' ) ) : ?>
				<div class="social-links">
					<div class="container">
							<?php wp_nav_menu(
								array(
									'theme_location'  => 'social',
									'link_before'     => '<span class="social-name">',
									'link_after'      => '</span>',
									'depth'           => 1,
									'container'       => '',
								)
							); ?>
					</div>
				</div>
			<?php endif; ?>

			<?php
				$footer_content = get_theme_mod( 'highstake_lite_footer_content', 'logo' );
				$logo_id        = get_theme_mod( 'highstake_lite_footer_logo' );
				$custom         = get_theme_mod( 'highstake_lite_footer_custom_content' );
			?>
			<?php if ( $footer_content != 'disable' ) : ?>
				<div class="footer-custom-content">
					<div class="container">

						<?php if ( $footer_content == 'logo' && !empty( $logo_id ) ) : ?>
							<?php echo wp_get_attachment_image( absint( $logo_id ), 'full' ); ?>
						<?php endif;?>

						<?php if ( $footer_content == 'custom' ) : ?>
							<?php echo wp_kses_post( $custom ); ?>
						<?php endif;?>

					</div>
				</div>
			<?php endif; ?>

			<div class="site-info">
				<div class="container">

					<div class="info-left">
						<?php highstake_lite_footer_text(); ?>
					</div>

					<div class="info-right">
						<a class="to-top" href="#page"><?php esc_html_e( 'Back to top', 'highstake-lite' ); ?><i class="fa fa-chevron-up" aria-hidden="true"></i></a>
					</div>

				</div>
			</div><!-- .site-info -->

		</footer><!-- #colophon -->

	</div><!-- .wide-container -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
