<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="site">

	<div class="wide-container">

		<header id="masthead" class="site-header">

			<div class="container">

				<?php highstake_site_branding(); ?>

				<?php if ( has_nav_menu ( 'primary' ) ) : ?>
					<nav class="main-navigation" id="site-navigation">
						<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'highstake' ); ?></button>
						<?php wp_nav_menu(
							array(
								'theme_location'  => 'primary',
								'menu_id'         => 'menu-primary-items',
								'menu_class'      => 'menu-primary-items'
							)
						); ?>
					</nav>
				<?php endif; ?>

				<button class="search-toggle button-primary">
					<i class="fa fa-search"></i>
				</button>

			</div>

		</header><!-- #masthead -->

		<?php get_template_part( 'partials/content', 'page-header' ); ?>

		<?php
			// Only show callout on home page
			if ( is_home() ) {

				// Get the data set in Customizer.
				$callout = get_theme_mod( 'highstake_callout_type', 'subscribe' );

				if ( $callout == 'subscribe' ) {
					get_template_part( 'partials/callout/content', 'subscribe' );
				} else {
					get_template_part( 'partials/callout/content', 'posts' );
				}

			}
		?>

		<div id="content" class="site-content">
