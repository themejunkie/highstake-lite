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

	<header id="masthead" class="site-header">

		<div class="site-branding">
			<?php highstake_site_branding(); ?>
		</div>

		<div class="header-search">
			<form id="searchform" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<input type="search" name="s" id="s" placeholder="<?php echo esc_attr_x( 'Search for...', 'placeholder', 'highstake' ) ?>" autocomplete="off" value="<?php echo esc_attr( get_search_query() ); ?>">
				<button type="submit" id="search-submit" class="fa fa-search"></button>
			</form>
		</div><!-- .header-search -->

	</header><!-- #masthead -->

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

	<div id="content" class="site-content">
