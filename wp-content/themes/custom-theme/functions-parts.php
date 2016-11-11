<?php 

class Custom_Parts extends Custom_Theme
{
	
	public static function loading_indicator() 
	{
		
		if ( ! is_front_page() )
			return;
		
		?>
			
			
		<div class="loading-indicator">
			
			<!-- svg icon -->
<svg class="loading-indicator__icon" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 65.28 66.25">
	<title>Bannon Logo - loading indicator</title>
	<defs>  
		<linearGradient id="gradient" x1="0" y1="0" x2="100%" y2="0">
		  <stop offset="0%" style="stop-color:#E46725;"></stop>
		  <stop offset="40%" style="stop-color:#E97639;"></stop>
		  <stop offset="50%" style="stop-color:#E97639;"></stop><!-- $primary-color: #E58E1A -->
		  <stop offset="90%" style="stop-color:#E97639;"></stop>
		  <stop offset="100%" style="stop-color:#E46725;"></stop>
		</linearGradient>
		
		<!-- Stitch 2 gradients together for seamless animation  -->
		<pattern id="pattern" x="0" y="0" width="300%" height="100%" patternUnits="userSpaceOnUse">
		  <rect x="55.0615%" y="0" width="150%" height="100%" fill="url(#gradient)">
		    <animate attributeType="XML" attributeName="x" from="0%" to="150%" dur="1.5s" repeatCount="indefinite"></animate>
		  </rect>
		  <rect x="-94.2044%" y="0" width="150%" height="100%" fill="url(#gradient)">
		    <animate attributeType="XML" attributeName="x" from="-150%" to="2%" dur="1.5s" repeatCount="indefinite"></animate>
		  </rect>
		</pattern>
	</defs>

	  <!-- Text using the #pattern in defs as the fill -->
	  <!--<text x="50%" text-anchor="middle" y="50%" dy="0.4em" fill="url(#pattern)" font-family="sonos-logoregular" font-size="50vh">SONOS</text>-->
	  <path fill="url(#pattern)" d="M65.28,32.86C65.28,13.74,49.58,0,30.51,0A31.77,31.77,0,0,0,4.37,13.14h8l0.54,0c4.43-3.26,10.2-5.2,17.38-5.2,15.26,0,25.9,10,25.9,25,0,14.1-9,25.37-24.83,25.37-14.1,0-23.95-7.66-23.95-21.41,0-8.63,4.61-14.67,8.31-14.12,1.32,0.2,2.15,2,1.78,3.47,0,0.07,0,.19-0.05.27L12.67,47.59H22.86l0.61-2.7c0.13,0.09.88,0.83,1.49,1.26a14,14,0,0,0,8.3,2.09c5.49-.09,11.28-2.57,13.61-9.37a14.79,14.79,0,0,0,.83-4.93,9.55,9.55,0,0,0-5.84-9.24A11.74,11.74,0,0,0,37,23.83a14.7,14.7,0,0,0-9.31,2.83L30,15H20.12l0,0.08C14.61,15.45,0,20.61,0,39.91c0,15.5,15.43,26.34,31,26.34,18.89,0,34.24-14.27,34.24-33.39h0ZM25.49,36.65A6,6,0,0,1,28.3,31.5a6.47,6.47,0,0,1,3.34-.87c2.81,0,5.31,1.22,5.36,4.58a6,6,0,0,1-6.1,6.19c-0.92,0-5.4-.17-5.4-4.75h0Z"></path>
</svg>		

			<!-- svg icon -->
		
		</div>

		<?php 
	}
	
	
	function get_social( $echo = true ) {
		
		if ( $social = get_field('opts_social', 'options') ) :
			
			$html = '<ul class="social dark-gray-theme clearfix">';
			foreach ( $social as $sm ) :
				$html .= '<li class="fa-stack ' . $sm['opts_social_service'] . '">
						<a target="_blank" href="' . $sm['opts_social_url'] . '">
							<i class="fa fa-circle fa-stack-2x"></i>
							<i class="fa fa-' . $sm['opts_social_service'] . ' fa-stack-1x fa-inverse"></i>
						</a>
					</li>';
			endforeach;
			$html .= '</ul>';

		
			if ( $echo ) :
				echo $html;
			else : 
				return $html;
			endif;

		endif; 
		
	}


	function get_site_search_form( $echo = true ) {
	
		if ( get_option( 'options_is_site_search' ) ) :
	
			$html = '<form class="site-search" method="get" action="#">
				<input type="search" name="s" value="" placeholder="Search" />
			</form>';

			if ( $echo ) :
				echo $html;
			else : 
				return $html;
			endif;

		endif;
	}


	function get_associated_image( $args ) {

	}

}