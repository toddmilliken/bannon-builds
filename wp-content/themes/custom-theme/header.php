<?php header('X-UA-Compatible: IE=edge,chrome=1'); ?>
<!DOCTYPE html>
<?php if ( is_front_page() ) : ?>
<html class="no-js home" <?php language_attributes(); ?>>
<?php else : ?>
<html class="no-js" <?php language_attributes(); ?>>
<?php endif; ?>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="designer" content="Todd Milliken" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title><?php wp_title(); ?></title>
	<link rel="stylesheet" href="<?php echo esc_url( get_stylesheet_uri() ); ?>" type="text/css" />
	<?php if ( Custom_Blog::is_blog() ) : ?>
		<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-559f161845f5584b" async="async"></script>
	<?php endif; ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div class="outer-wrap">	
		<nav class="site-navigation">
			<?php wp_nav_menu('container=&menu_class=main-menu clearfix&theme_location=main-menu&fallback_cb=false');?>
			<?php Custom_Parts::get_site_search_form(); ?>
		</nav>		
		<div class="site-wrap">
			<header class="site-head">
				<div class="inner">
					<?php Custom_Parts::get_site_logo(); ?>					
					<a href="javascript:;" class="mob-menu">
						<div></div>
					</a>
					<div class="header-cta"><?php the_field('opts_phone', 'options'); ?></div>
				</div>
			</header>