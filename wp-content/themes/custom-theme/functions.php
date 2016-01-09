 <?php
include_once('functions-blog.php');
include_once('functions-client.php');
include_once('functions-parts.php');

Custom_Theme::_init();

class Custom_Theme {
	
	public static function _init() {
		
		//! ADD OPTIONS PAGE
		if ( function_exists('acf_add_options_page') ) :
			acf_add_options_page();
		endif;

		// Add featured image support
		add_theme_support( 'post-thumbnails' ); 

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
		add_action( 'widgets_init', array(__CLASS__, 'kraftwerke_widgets_init' ));
		
		/*	Admin hooks  */
		if ( is_admin() ) {
			
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
		register_nav_menus(array(
			'main-menu' => __( 'Main Menu' ),
			'footer-menu' => __( 'Footer Menu' )
		));
	}

	/**
	 * Register our sidebars and widgetized areas.
	 *
	 */
	public static function kraftwerke_widgets_init() {

		register_sidebar(array(
			'name'          => 'Sidebar',
			'id'            => 'interior-sidebar',
			'before_widget' => '<div class="widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		));
		register_sidebar(array(
			'name'          => 'Blog Sidebar',
			'id'            => 'blog-sidebar',
			'before_widget' => '<div class="widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title widget-title-blog">',
			'after_title'   => '</h2>',
		));

	}

	public static function enqueue_scripts() {
		wp_enqueue_script('jquery');
		wp_enqueue_script('modernizr', get_template_directory_uri() . '/core/js/modernizr.min.js',	array('jquery'));
		//wp_enqueue_script('picturefill-bg', get_template_directory_uri() . '/core/js/picturefill-background-mod.js', array(), null);
		//wp_enqueue_script('picturefill', get_template_directory_uri() . '/core/js/picturefill.min.js', array('picturefill-bg'), null);
		wp_enqueue_script('jquery-plugins', get_template_directory_uri() . '/core/js/plugins.js', array('jquery'), null, true);
		wp_enqueue_script('global', get_template_directory_uri() . '/core/js/global.js', array('jquery', 'jquery-plugins'), null, true);		
		if ( is_page_template('_templates/tmpl-contact.php') ) :
			wp_enqueue_script('google-map', 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false', array('jquery'));
		endif;
		if ( is_singular() && comments_open() && ( get_option('thread_comments') == 1 ) ) :
	    	wp_enqueue_script('comment-reply');
	    endif;
	}

	public static function enqueue_styles() {
		wp_enqueue_style('fonts', 'http://fonts.googleapis.com/css?family=Karla:400,400italic,700,700italic', array(), null);
		wp_enqueue_style('fonts-2', 'http://fonts.googleapis.com/css?family=Cabin:400,500,700', array(), null);
		wp_enqueue_style('icons', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css', array(), null);
		wp_enqueue_style('global', get_template_directory_uri() . '/core/css/global.css', array('fonts', 'fonts-2', 'icons'), null);
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
		}
		
		if ( is_active_sidebar('callouts') )
		{
			$classes[] = 'has-callouts';
		}
		
		if ( Custom_Blog::is_blog() )
		{
			$classes[] = 'is-blog';
		}

		return $classes;
	}

	
}