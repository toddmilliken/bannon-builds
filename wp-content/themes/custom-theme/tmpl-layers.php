<?php // Template Name: Layers
get_header();
get_template_part('partials/masthead');
?>
<div id="main-content">
<?php
	while ( have_posts() ) : the_post(); 
		
		//! BEGIN LAYERS
		if ( $layers = get_field('layers') ) :
			$html = '<div class="layers">';
			$index = 1;
			foreach ( $layers as $layer ) :			
				$image_html = '';
				//! LAYER IMAGE HTML 
				if ( $bg_img = $layer['layer_img'] ) :
					$image_html = '
						<div class="layer__image picturefill-background">
							<span data-src="' . $bg_img['sizes']['desktop'] . '" data-media="(min-width: 1025px)"></span>
							<span data-src="' . $bg_img['sizes']['tablet'] . '" data-media="(max-width: 1024px)"></span>
							<span data-src="' . $bg_img['sizes']['mobile'] . '" data-media="(max-width: 680px)"></span>
						</div>
					';		
				endif;
				
			
				//! BEGIN OUTPUT
				$html .= '<div class="layer">
					
					<div class="layer__flex-parent">
						<div class="layer__flex-child">
				';
					
					if ( $index % 2 == 0 ) 
						$html .= $image_html;
				
					//! LAYER CONTENT
					$html .= '
						<div class="layer__content">
							<h2 class="layer__title">' . $layer['layer_title'] . '</h2>
							<p class="layer__p">' . $layer['layer_content'] . '</p>
						</div>
					';
					
					if ( $index % 2 !== 0 ) 
						$html .= $image_html;
								
				
				$html .= '</div>
							</div>
						</div>';
				
				$index++;
			endforeach;
			$html .= '</div>';
			
			echo $html;
			
		endif;
		
	endwhile;		
?>
</div>
<?php get_footer(); ?>