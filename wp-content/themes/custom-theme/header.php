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
	<header class="site-head">
		<?php
			//! SITE LOGO
			if ( $logo = get_field('opts_logo', 'options') ) :
				echo '
					<a class="logo" href="' . home_url() . '">
						<img class="logo__img" src="' . $logo['url'] . '" alt="' . $logo['alt'] . '" />
					</a>
				';
			endif;
			echo '
				<a href="' . home_url() . '" class="logo__custom">
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
			?>				
		</nav>
	</header>