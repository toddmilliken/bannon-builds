<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title><?php wp_title(); ?></title>
	<link rel="stylesheet" href="<?php echo esc_url( get_stylesheet_uri() ); ?>" type="text/css" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div class="loading-indicator"></div>
	<header class="site-head">
		<?php
			echo '
				<a href="' . home_url() . '" class="logo">
					<span class="logo__sign"><em></em></span>
					<span class="logo__text"><strong>bannon</strong></span>
				</a>
			';			
		?>
		<a href="javascript:;" class="mob-menu">
			<div></div>
			<span class="menu-text">Menu</span>
		</a>
		
		<nav class="site-navigation">				
			<?php
				//! MAIN MENU 
				wp_nav_menu('container=&container_class=&menu_class=main-menu clearfix&theme_location=main-menu&fallback_cb=false');
				
				//! MOBILE FOOTER MENU 
				if ( has_nav_menu('footer-menu') ) :
					wp_nav_menu(array(
						'container' => '',
						'container_class' => '',
						'theme_location'  => 'footer-menu',
						'menu'            => '',
						'items_wrap' 	  	=> '<ul class="%2$s">%3$s</ul>',
						'menu_class'      => 'footer-menu',
					));
				endif;
				
			?>				
		</nav>
	</header>