<?php
/**
 * Extends the Wordpress Customizer features
 *
 * @since 1.0.0
 */
 
 

/**
 * Registers panels, sections, and settings & controls
 *
 * @since 1.0.0
 */ 
function base_customizer_register( $wp_customize ) 
{
	
	$wp_customize->add_panel( 'panel_id', array(
		'priority' => 10,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => 'Masthead',
		'description' => 'Sets the default section background for the interior.',
	) );
	
	$wp_customize->add_section( 'section_id', array(
		'priority' => 10,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => 'Example Section',
		'description' => '',
		'panel' => 'header_image',
	) );

}
add_action( 'customize_register', 'base_customizer_register' );


/**
 * 
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
			'url'           => '%s/core/images/default-header.jpg',
			'thumbnail_url' => '%s/core/images/default-header.jpg',
			'description'   => 'Default Texture',
		),
		'wooden-texture' => array(
			'url'           => '%s/core/images/wood-background_masthead.jpg',
			'thumbnail_url' => '%s/core/images/wood-background_masthead.jpg',
			'description'   => 'Wooden Texture'
		),
	) ); 
	
	
}
add_action( 'after_setup_theme', 'custom_header_defaults' );