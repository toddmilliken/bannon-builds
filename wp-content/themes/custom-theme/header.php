<?php header('X-UA-Compatible: IE=edge,chrome=1'); ?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="designer" content="Todd Milliken" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title><?php wp_title(); ?></title>
	<link rel="stylesheet" href="<?php echo esc_url( get_stylesheet_uri() ); ?>" type="text/css" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<header class="site-head">
		<div class="inner">
			
			<?php Custom_Parts::get_site_logo(); ?>					
			
			<a href="javascript:;" class="mob-menu">
				<div></div>
				<span class="menu-text">Menu</span>
			</a>
			
			<nav class="site-navigation">
				<?php wp_nav_menu('container=&container_class=&menu_class=main-menu clearfix&theme_location=main-menu&fallback_cb=false');?>
				<?php wp_nav_menu('container=&container_class=&menu_class=utility-menu clearfix&theme_location=utility-menu&fallback_cb=false');?>
			</nav>

		</div>
	</header>