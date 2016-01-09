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


	function get_site_logo( $echo = true ) {

		if ( $logo = get_option('options_site_logo') ) :
			
			$html .= '<a class="logo" href="' . home_url() . '"><img src="' . $logo['url'] . '" alt="' . $logo['alt'] . '" />';
			if ( $logo_text = get_option('options_site_logo_text') ) :
				$html .= '<strong>' . $logo_text . '</strong>';
			endif;
			$html .= '</a>';
		else : 
			$html .= '<div class="logo-text"><a href="' . home_url() . '"><span class="logo-text-primary">' . get_field('opts_logo_text_1', 'options') . '</span><span class="logo-text-tagline">' . get_field('opts_logo_text_2', 'options') . '</span></a></div>';
		endif;


		if ( $echo ) :
			echo $html;
		else : 
			return $html;
		endif;

	}


	function get_associated_image( $args ) {

	}

}