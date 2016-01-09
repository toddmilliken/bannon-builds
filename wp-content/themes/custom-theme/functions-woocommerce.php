<?php

//! FIRST First unhook the WooCommerce wrappers:
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10); 
//! Then hook in your own functions to display the wrappers your theme requires:
add_action('woocommerce_before_main_content', array('Custom_WooCommerce', 'my_theme_wrapper_start'), 10);
add_action('woocommerce_after_main_content', array('Custom_WooCommerce', 'my_theme_wrapper_end'), 10);
//! ADD SUPPORT (REMOVE MESSAGE)
add_action( 'after_setup_theme', array('Custom_WooCommerce', 'woocommerce_support') );


//! HOOK INTO ARCHIVE DESCRIPTION TO CHANGE HTML
add_action( 'woocommerce_archive_description', array('Custom_WooCommerce', 'wc_category_description'));

//! CHANGE BREADCRUMB DEFAULTS
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
add_filter( 'woocommerce_breadcrumb_defaults', array('Custom_WooCommerce', 'my_woocommerce_breadcrumbs'));


//! CHANGE IMAGE HTML

class Custom_WooCommerce extends Custom_Theme
{

	//! ADD WOOCOMMERCE SUPPORT TO THEME
	public static function woocommerce_support() {
	    add_theme_support( 'woocommerce' );
	}
	
	//! OPENING WRAPPER TO BE USED FOR PAGE TEMPLATES
	public static function my_theme_wrapper_start() {
		echo '<div class="main">';
		Custom_Client::get_masthead();
		echo '<div class="inner">
		<div class="page-title">';
			Custom_Client::get_page_title();
			Custom_Client::get_introductory_text();
			woocommerce_breadcrumb();
			self::wc_category_description();
		echo '</div>';
	}

	//! CLOSING WRAPPER TO BE USED FOR PAGE TEMPLATES
	public static function my_theme_wrapper_end() {
		echo '</div>';
	}

	public static function wc_category_description() {
		/**
		 * woocommerce_archive_description hook
		 *
		 * @hooked woocommerce_taxonomy_archive_description - 10
		 * @hooked woocommerce_product_archive_description - 10
		 */
		//do_action( 'woocommerce_archive_description' );

		if ( is_product_category() ) {
            global $wp_query;
            $cat_id = $wp_query->get_queried_object_id();
            $cat_desc = term_description( $cat_id, 'product_cat' );
            $subtit = '<div class="subtitle">'.$cat_desc.'</div>';
            echo $subtit;
        }

	}

	public static function my_woocommerce_breadcrumbs() {
			return array(
	            'delimiter'   => ' &#47; ',
	            'wrap_before' => '<div class="page-intro-text"><p class="woocommerce-breadcrumb-custom" itemprop="breadcrumb">',
	            'wrap_after'  => '</p></div>',
	            'before'      => '',
	            'after'       => '',
	            'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
	        );
	}


}