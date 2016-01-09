<?php

// add_action('login_head', array('Custom_Client','wp_login_client_logo'));
add_action('pre_get_posts', array('Custom_Client', 'theme_search_settings'));

class Custom_Client extends Custom_Theme
{

	function get_home_panels( $echo = true ) {
		
		$html = '<section class="panels">
			<div class="panel">
				<div class="panel-content-wrapper left-align">
					<div class="panel-heading">
						<h2>Test Heading</h2>
					</div>
					<div class="panel-contet">
						<p>Test paragraph</p>
						<a class="more" href="#">Read More</a>
					</div>
				</div>
			</div>
		</div>';

		if ( $echo ) :
			echo $html;
		else :
			return $html;
		endif;
	}
	
	function get_home_icons( $echo = true )
	{
		/*$html = '<ul class="circle-container">
			<li><a href="#""><img src="http://lorempixel.com/100/100/city"></a></li>
			<li><a href="#"><img src="http://lorempixel.com/100/100/nature"></a></li>
			<li><a href="#"><img src="http://lorempixel.com/100/100/abstract"></a></li>
			<li><a href="#"><img src="http://lorempixel.com/100/100/cats"></a></li>
			<li><a href="#"><img src="http://lorempixel.com/100/100/food"></a></li>
			<li><a href="#"><img src="http://lorempixel.com/100/100/animals"></a></li>
		</ul>';
*/
		$html = '
		<div class="lazyload-wrapper">
			<div class="fullscreen-layer lazyload" data-src="' . get_stylesheet_directory_uri() . '/core/images/car_img.jpg">
				<ul class="circle-container">
				
					<li class="circle-item">
						<a href="#">
							<div class="circle-item-text">
								<i class="fa fa-car"></i>
								<p>Parts Finder</p>
							</div>
						</a>
					</li>
					<li class="circle-item">
						<a href="#">
							<div class="circle-item-text">
								<i class="fa fa-paper-plane-o"></i>
								<p>Schedule Appointment</p>
							</div>
						</a>
					</li>
					<li class="circle-item">
						<a href="#">
							<div class="circle-item-text">
								<i class="fa fa-gear"></i>
								<p>My Account</p>
							</div>
						</a>
					</li>
					<li class="circle-item">
						<a href="#">
							<div class="circle-item-text">
								<i class="fa fa-comments"></i>
								<p>Blog</p>
							</div>
						</a>
					</li>
					<li class="circle-item">
						<a href="#">						
							<div class="circle-item-text">
								<i class="fa fa-user"></i>
								<p>About</p>
							</div>
						</a>	
					</li>
					<li class="circle-item">
						<a href="#">
							<div class="circle-item-text">
								<i class="fa fa-wrench"></i>
								<p>Maintenance <br />&amp; Services</p>
							</div>
						</a>
					</li>
				</ul>
			</div>
		</div>
		-->';

		if ( $echo ) :
			echo $html;
		else :
			return $html;
		endif;
	}

	/*-----------------------------------------------------------------------------------------------------------
	 *
 	 * Build and echo the masthead for the current page
 	 *
 	 * @params boolean $is_term
 	 * If is a term, append the term slug + id to masthead to get the term's masthead.
 	 *
 	 * @echo variable $html
 	 *
 	 *-----------------------------------------------------------------------------------------------------------*/
	
	function get_masthead()
	{
		
		global $post;

		$id = $post->ID;
		$masthead = get_field('int_masthead_image', $id);
		

		//! IF NO MASTHEAD, CHECK ANCESTORS
		if ( !$masthead ) :
			$ancestors = get_post_ancestors($post);
			foreach ( $ancestors as $a ) :
				if ( $has_masthead_image = get_field('int_masthead_image', $a) ) :
					$masthead = $has_masthead_image;
					break;
				endif;
			endforeach;
		endif;
		
		//! IF STILL NO MASTHEAD, OR IS SEARCH, OR IS 404, GET MASTHEAD DEFAULT IN SITE OPTIONS
		if ( !$masthead || is_search() || is_404() ) $masthead = get_field('opts_masthead', 'options');
		
		//! IF THE CURRENT PAGE IS A BLOG PAGE, GET BLOG RELATED MASTHEAD
		if ( Custom_Blog::is_blog() ) :
			$masthead = get_field('opts_masthead_blog', 'options');	
		endif;

		//! VERIFY THERE IS A MASTHEAD IMAGE AND BUILD HTML
		if ( $masthead ) :		
			$html = '
				<section class="masthead">
					<div class="masthead-img-wrap">
						<img src="' . $masthead['url'] . '" alt="' . $masthead['alt'] . '" class="masthead-img" />
					</div>
				</section>';
			echo $html;
		endif;

	}


	function get_page_title( $echo = true ) {

		if ( in_the_loop() ) :
			$id = get_the_ID();
		else :
			global $wp_query;
			$id = $wp_query->get_queried_object_id();
		endif;

		$html = ( get_field('int_alt_title', $id) ? get_field('int_alt_title', $id) : get_the_title($id) );

		if ( $echo ) :
			echo '<h1>' . $html . '</h1>';
		else :
			return $html;
		endif;
		
	}

	function get_introductory_text( $echo = true ) {
		if ( in_the_loop() ) :
			$id = get_the_ID();
		else :
			global $wp_query;
			$id = $wp_query->get_queried_object_id();
		endif;

		if ( get_field('int_intro_text', $id) ) :
			$html = get_field('int_intro_text', $id);
			if ( $echo ) :
				echo '<div class="page-intro-text"><p>' . $html . '</p></div>';
			else :
				return $html;
			endif;
		endif;
	}
	
	function get_breadcrumbs() {
		if ( function_exists('yoast_breadcrumb') ) :
			yoast_breadcrumb('<p id="breadcrumbs">','</p>');
		endif;
	}
	
	function theme_search_settings($query) {
	
		if ( !is_admin() && $query->is_main_query() && $query->is_search() ) :
			$query->query_vars['posts_per_page'] = -1;
			$exclude_ids = array();		
			if ( $exclude_posts = get_field('opts_exclude_posts', 'options') ) :
				foreach ( $exclude_posts as $ex_post ) {
					array_push($exclude_ids, $ex_post->ID);				
				}
			endif;
			$query->set('post__not_in', $exclude_ids);		
			return;
		endif;
	}


	function get_tmpl_contact( $echo = true ) {

		$location = get_field('contact_map');

		if ( !empty($location) ) : 
			$html = '<script src="' . get_template_directory_uri() . '/core/js/acf-google-map.js"></script>
			<div class="acf-map">
				<div class="marker" data-lat="' . $location['lat'] . '" data-lng="' . $location['lng'] . '"></div>
			</div>';
		endif;

		if ( $echo ) :
			echo $html;
		else :
			return $html;
		endif;
	}
	
}