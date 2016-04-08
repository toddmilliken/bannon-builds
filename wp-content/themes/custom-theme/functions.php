<?php

include_once('functions-client.php');
include_once('functions-parts.php');

Custom_Theme::_init();

class Custom_Theme {

	// ! @static array $admin_menus_to_hide A list of admin menus to hide
  	static $admin_menus_to_hide = array(
		/*
		'index.php',						// Dashboard
		*/'edit.php',/*)							// Posts
		'upload.php',						// Media
		'link-manager.php',					// Links
		'edit.php?post_type=page',			// Pages
		*/'edit-comments.php', /*				// Comments
		'themes.php',						// Themes
		'plugins.php',						// Plugins
		'users.php',						// Users
		'tools.php',						// Tools
		'options-general.php'			// Settings
		*/
	);

	// ! @static array $dashboard_widgets_to_hide A list of dashboard widgets to hide
	static $dashboard_widgets_to_hide = array(
		'side' => array(
		'dashboard_activity',
		'dashboard_quick_press',
		'dashboard_recent_drafts',
		'dashboard_primary',
		'dashboard_secondary',
	),
		'normal' => array(
			'dashboard_activity',
		'dashboard_incoming_links',
		'dashboard_right_now',
		'dashboard_plugins',
		'dashboard_recent_comments',
		),
	);
	
	public static function _init() {
		
		show_admin_bar(false);

		//! ADD OPTIONS PAGE
		if ( function_exists('acf_add_options_page') ) :
			acf_add_options_page();
		endif;

		// Add featured image support
		add_theme_support( 'post-thumbnails' ); 

		add_image_size( 'small', 380 );
		add_image_size( 'mobile', 680 );		
		add_image_size( 'tablet', 1024 );
		add_image_size( 'desktop', 1800 );
		

		// Add HTML5 support for the search form.
		add_theme_support( 'html5', array( 'search-form' ) );
		
		// Add MIME types; not used in multisite
		add_filter('upload_mimes', array(__CLASS__, 'add_mime_types'));
		
		// Push Yoast to the bottom of the page
		add_filter( 'wpseo_metabox_prio', function() { return 'low';});

		// Disable updates
		//add_filter('pre_site_transient_update_core', create_function('$a', "return null;"));
		//remove_action('load-update-core.php', 'wp_update_plugins');
		//add_filter('pre_site_transient_update_plugins', create_function('$a', "return null;"));

		//! REGISTER POST TYPES
		add_action('init', array(__CLASS__, 'register_post_types'));

		/*  AJAX hooks  */
		if ( defined('DOING_AJAX') && DOING_AJAX ) {
			return;
		}

		add_action( 'init', array(__CLASS__, 'register_theme_menus' ));
		add_action( 'widgets_init', array(__CLASS__, 'custom_theme_widgets_init' ));
		
		/*	Admin hooks  */
		if ( is_admin() ) {			
			add_action('admin_menu', array(__CLASS__, 'hide_admin_menu_items'));
			add_action('wp_dashboard_setup', array(__CLASS__, 'hide_dashboard_widgets'));
			add_filter( 'tiny_mce_before_init', array(__CLASS__, 'my_mce_before_init_insert_formats') );
			return;
		}

		/*	Frontend hooks	*/ 
		add_action('wp_enqueue_scripts', array(__CLASS__, 'enqueue_scripts'));
		add_action('wp_enqueue_scripts', array(__CLASS__, 'enqueue_styles'));
		add_filter('body_class', array(__CLASS__, 'body_class'));
		add_filter('excerpt_length', array(__CLASS__, 'change_excerpt_length'));
	}

	public static function register_theme_menus() {
		register_nav_menus(
			array(
				'main-menu' => __( 'Main Menu' ),
				'utility-menu' => __( 'Utility Menu' ),
				'footer-menu' => __( 'Footer Links' ),
			)
		);
	}

	/**
	 * Register our sidebars and widgetized areas.
	 *
	 */
	public static function custom_theme_widgets_init() {
/*
		register_sidebar(array(
			'name'          => 'Sidebar',
			'id'            => 'sidebar-right',
			'before_widget' => '<div class="widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		));
*/
	}

	public static function enqueue_scripts() {
		wp_enqueue_script('jquery');
		wp_enqueue_script('modernizr', get_template_directory_uri() . '/core/js/modernizr.min.js',	array('jquery'));
		wp_enqueue_script('picturefill-bg', get_template_directory_uri() . '/core/js/picturefill-background-mod.js', array(), null);
		//wp_enqueue_script('picturefill', get_template_directory_uri() . '/core/js/picturefill.min.js', array('picturefill-bg'), null);
		wp_enqueue_script('jquery-plugins', get_template_directory_uri() . '/core/js/plugins.js', array('jquery'), null, true);
		wp_enqueue_script('global', get_template_directory_uri() . '/core/js/global.js', array('jquery', 'jquery-plugins'), null, true);		
		
		// for acf map field. 
		wp_enqueue_script('google-map', 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false', array('jquery'));
		
		// if comments are open, get comment reply script.
		if ( is_singular() && comments_open() && ( get_option('thread_comments') == 1 ) ) :
	    	wp_enqueue_script('comment-reply');
	    endif;

	}

	public static function enqueue_styles() {
		//wp_enqueue_style('fonts', 'https://fonts.googleapis.com/css?family=Lato:400,300,400italic,700,700italic,900', array(), null);
		wp_enqueue_style('icons', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css', array(), null);
		wp_enqueue_style('global', get_template_directory_uri() . '/core/css/global.css', array(), null);
		wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/core/css/owl.carousel.css', array('global'), null);
	}


	public static function change_excerpt_length( $length )
	{
   		return 30;
	}

	// Callback function to filter the MCE settings
	public static function my_mce_before_init_insert_formats( $init_array ) {  
		// Define the style_formats array
		$style_formats = array(  
			// Each array child is a format with it's own settings
			array(  
				'title' => '.translation',  
				'block' => 'blockquote',  
				'classes' => 'translation',
				'wrapper' => true,
				
			),  
			array(  
				'title' => '⇠.rtl',  
				'block' => 'blockquote',  
				'classes' => 'rtl',
				'wrapper' => true,
			),
			array(  
				'title' => '.ltr⇢',  
				'block' => 'blockquote',  
				'classes' => 'ltr',
				'wrapper' => true,
			),
		);  
		// Insert the array, JSON ENCODED, into 'style_formats'
		$init_array['style_formats'] = json_encode( $style_formats );  
		
		return $init_array;  
	  
	} 


	public static function register_post_types()
	{
		include_once get_stylesheet_directory() . '/core/includes/post-types.php';
	}

	/*--------------------------------------------------------------------------------------
	 *
	 * Customize the classes output by the body_class() function
	 *
	 * @param array $classes
	 * @return array
	 *
	 *--------------------------------------------------------------------------------------*/
	
	public static function body_class( $classes )
	{
		
		foreach ( $classes as &$class )
		{
			$class = str_replace(array('-php', 'page-template-' , 'page-template' , '_templates'), '', $class);
		}
		
		if ( !is_front_page() )
		{
			$classes[] = 'interior';
		} else {
			$classes[] = 'home';
		}
		
		if ( is_active_sidebar('callouts') )
		{
			$classes[] = 'has-callouts';
		}

		return $classes;
	}


   /*--------------------------------------------------------------------------------------
    *
    * Hide admin menu items
    * @uses $menu
    *
    *--------------------------------------------------------------------------------------*/
    
	public static function hide_admin_menu_items()
	{
		global $menu;

		if ( empty(self::$admin_menus_to_hide) ) return;
		
		foreach ( $menu as $key => $item )
		{
			if ( in_array($item[2], self::$admin_menus_to_hide) )
			{
				unset($menu[$key]);
			}
		}
	}
   
   /*--------------------------------------------------------------------------------------
    *
    * Hide dashboard widgets
    * @uses $wp_meta_boxes
    *
    *--------------------------------------------------------------------------------------*/
    
   public static function hide_dashboard_widgets()
   {
    	global $wp_meta_boxes;
    	
    	foreach ( (array) self::$dashboard_widgets_to_hide as $context => $boxes )
    	{
    		foreach ( $boxes as $boxname )
    		{
    			unset($wp_meta_boxes['dashboard'][$context]['core'][$boxname]);
    		}
    	}
   }

	
	public static function add_mime_types($mimes) {
		//! EXAMPLE: $mimes['extension'] = 'mime/type';
		
		$mimes['doc'] = 'application/msword'; 
		$mimes['svg'] = 'image/svg+xml';
		
		return $mimes;
	}

	
}