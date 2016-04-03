<?php 

class Custom_Parts extends Custom_Theme
{

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