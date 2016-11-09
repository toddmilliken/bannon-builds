<?php
/**
 * Extends the Wordpress Customizer features
 *
 * Uses the following 
 *
 * @link https://codex.wordpress.org/Theme_Customization_API
 *
 * @since 1.0.0
 */
 
 

/**
 * Registers panels, sections, settings, and controls
 *
 * @see customize_register 
 *      The hook that allows you to define new Customizer panels, sections, 
 *      settings, and controls.
 *
 * @since 1.0.0
 */ 
function base_customizer_register( $wp_customize ) 
{

	// add color picker setting
	$wp_customize->add_setting( 'header_bg_color', array(
		'default' => '#3e4826'
	) );
	
	// add color picker control
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_bg_color', array(
		'label' => 'Header Background Color',
		'section' => 'colors',
		'settings' => 'header_bg_color',
	) ) );

}
add_action( 'customize_register', 'base_customizer_register' );



function base_update_customizer_header()
{	

  ?>

	<style type="text/css">
		
		.masthead {
			background-color: <?php echo get_theme_mod( 'header_bg_color' ); ?> !important;
		}
		
		.masthead-bg { 
			background-image: url(<?php echo( get_header_image() ); ?>) !important; 
		}
		
		.masthead-title {
			color: #<?php echo get_header_textcolor(); ?> !important;
		}
		
	</style>

  <?php
	  
}
add_action( 'wp_head', 'base_update_customizer_header' );




/**
 * Adds default imagery for Custom Header
 *
 * @since 1.0.0
 */
function custom_header_defaults()
{

	$defaults = array(
		// 'default-image'          => get_stylesheet_directory_uri() . '/core/images/default-header.jpg',
		'width'                  => 1600,
		'height'                 => 280,
		'flex-height'            => true,
		'flex-width'             => true,
		'uploads'                => true,
		'random-default'         => false,
		'header-text'            => true,
		'default-text-color'     => 'ffffff',
		'wp-head-callback'       => '',
		'admin-head-callback'    => '',
		'admin-preview-callback' => '',
	);
	
	add_theme_support( 'custom-header', $defaults );
	
	register_default_headers( array(
		'default-header' => array(
			'url'           => '%s/core/images/default-header-1400x280.jpg',
			'thumbnail_url' => '%s/core/images/default-header-1400x280.jpg',
			'description'   => 'Default Texture',
		),
		'wooden-texture' => array(
			'url'           => '%s/core/images/wood-background_masthead-1202x280.jpg',
			'thumbnail_url' => '%s/core/images/wood-background_masthead-1202x280.jpg',
			'description'   => 'Wooden Texture'
		),
	) ); 
	
	
}
add_action( 'after_setup_theme', 'custom_header_defaults' );




/**
 * Adds custom background support
 */
