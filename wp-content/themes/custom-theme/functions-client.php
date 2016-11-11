<?php
add_action('wp_head', array('Custom_Client', 'ga_tracking'));
add_action('login_head', array('Custom_Client','wp_login_client_logo'));
add_action('pre_get_posts', array('Custom_Client', 'theme_search_settings'));
add_action('login_head', array('Custom_Client','wp_login_client_logo'));

class Custom_Client extends Custom_Theme
{
	
	public static function ga_tracking() {
		
		if ( $ga_id = get_field('opts_ga_id', 'options') ) {
			?>
			
<!-- Google Analytics -->
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

ga('create', '<?php echo $ga_id; ?>', 'auto');
ga('send', 'pageview');
</script>
<!-- End Google Analytics -->

			<?php 
		}
		
	}
	
	public static function get_page_title( $echo = true ) {

		if ( in_the_loop() ) :
			$id = get_the_ID();
		else :
			global $wp_query;
			$id = $wp_query->get_queried_object_id();
		endif;

		$html = ( get_field('int_alt_title', $id) ? get_field('int_alt_title', $id) : get_the_title($id) );

		if ( $echo ) :
			echo '<h1 class="page-title">' . $html . '</h1>';
		else :
			return $html;
		endif;
		
	}
	
	public static function theme_search_settings($query) {
	
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

	public static function wp_login_client_logo() {
		
		
		if ( $logo = get_field('opts_logo', 'options') ) :

			$logo_url = $logo['url'];
			$logo_height = $logo['height'];
			$logo_width = $logo['width'];
		
			echo '
				<style type="text/css">
					
					#login h1 {					
						height: ' . $logo_height . 'px !important;
						width: ' . $logo_width . 'px !important;
						position: relative;
							left: 50%;
						-o-transform: translate(-50%, 0);
						-ms-transform: translate(-50%, 0);
						-moz-transform: translate(-50%, 0);
						-webkit-transform: translate(-50%, 0);
						transform: translate(-50%, 0);					
					}			
				
					#login h1 a { 
						background-image: url('. $logo_url .') !important;
						background-size: auto !important;
						height: ' . $logo_height . 'px !important;
						width: ' . $logo_width . 'px !important;
					}
					
					#login h1 + div ,
					#login h1 + p {
						margin-top: 20px;
					}
					
				</style>
			';	
		endif;
		
	}


	public static function get_acf_map( $acf_field_name = '', $echo = true ) {

		if ( $location = get_field($acf_field_name) ) :
			$html = '
				<script src="' . get_template_directory_uri() . '/core/js/acf-google-map.js"></script>
				<div class="acf-map">
					<div class="marker" data-lat="' . $location['lat'] . '" data-lng="' . $location['lng'] . '"></div>
				</div>
			';		
		endif;

		if ( $echo ) :
			echo $html;
		else :
			return $html;
		endif;
	}
	
}