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
			
				//! LAYER IMAGE HTML 
				$image_html = '<div class="layer__image">';
				if ( $image = $layer['layer_img'] ) :
					$image_html .= '<div class="layer__image_bg" style="background-image: url(' . $image['url'] . ');"></div>';
				endif;
				$image_html .= '</div>';
			
				//! BEGIN OUTPUT
				$html .= '<div class="layer">';
					
					if ( $index % 2 == 0 ) 
						$html .= $image_html;
				
					//! LAYER CONTENT
					$html .= '
						<div class="layer__content">
							<h3 class="layer__title">' . $layer['layer_title'] . '</h3>
							<p class="layer__p">' . $layer['layer_content'] . '</p>
						</div>
					';
					
					if ( $index % 2 !== 0 ) 
						$html .= $image_html;
								
				
				$html .= '</div>';
				
				$index++;
			endforeach;
			$html .= '</div>';
			
			echo $html;
			
		endif;
		
	endwhile;		
?>
</div>
<?php get_footer(); ?>