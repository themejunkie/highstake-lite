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
						<?php wp_nav_menu(
							array(
								'container_class' => 'menu-primary-container',
								'theme_location'  => 'primary',
								'menu_id'         => 'menu-primary-items',
								'menu_class'      => 'menu-primary-items'
							)
						); ?>
					</nav>
				<?php endif; ?>

				<button class="search-toggle button-primary">
					<i class="fa fa-search" aria-hidden="true"></i>
				</button>

			</div>

		</header><!-- #masthead -->

		<div class="searchbar">
			<div class="container">
				<form method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<input type="search" class="searchbar-field" placeholder="<?php echo esc_attr_x( 'Type keyword &hellip;', 'placeholder', 'highstake' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'highstake' ) ?>" />
				</form>
				<button class="search-close">
					<i class="fa fa-times-circle" aria-hidden="true"></i>
				</button>
			</div>
		</div>

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
