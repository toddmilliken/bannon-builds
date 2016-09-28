<?php if ( $slides = get_field('project_slides') ) : 	
	
	// open slider
	$html = '
		<div class="project-slider">
			<div class="project-slides">';
		
			//! Build each slide html, adding specific classes along the way. 		
			foreach ( $slides as $slide ) : 
			
				//---
				// SETUP CLASSES
				//---
				$slide_classes = array('project-slide');
				$image_classes = array('project-slide__image', 'picturefill-background');
				$content_classes = array('project-slide__content');
				
				// slide type
				switch ( $slide['project_slide_type'] ) :
					case 'full-screen' :
						$image_classes[] = 'project-slide__image--full-screen';
						$content_classes[] = 'project-slide__content--full-screen';
						break;
						
					case 'half-screen' :
						
						// slide image position
						switch ( $slide['project_slide_img_pos'] ) :
							case 'left' :
								$image_classes[] = 'project-slide__image--left';
								$content_classes[] = 'project-slide__content--right';
								break;
							case 'right' :								
								$image_classes[] = 'project-slide__image--right';
								$content_classes[] = 'project-slide__content--left';
								break;
						endswitch;
						
						break;
				endswitch;
				
				
				
				//---
				// OUTPUT SLIDE
				//---
				$html .= '<div class="' . implode(' ', $slide_classes) . '">';
					
					//! slide image
						
					if ( $bg_img = $slide['project_slide_img'] ) :
					
						$html .= '
							<div class="' . implode(' ', $image_classes) . '">
								<span data-src="' . $bg_img['sizes']['desktop'] . '" data-media="(min-width: 1025px)"></span>
								<span data-src="' . $bg_img['sizes']['tablet'] . '" data-media="(max-width: 1024px)"></span>
								<span data-src="' . $bg_img['sizes']['mobile'] . '" data-media="(max-width: 680px)"></span>
							</div>
						';
						
					endif;
					
					
					//! slide content
					if ( $slide['project_slide_is_content'] ) :
						$html .= '
							<div class="' . implode(' ', $content_classes) . '">
								<div class="content-inner">';
									
									//! slide title
									if ( $title = $slide['project_slide_title'] ) :
										$html .= '<div class="ps__title">' . $title . '</div>';
									endif;
									
									//! slide content
									if ( $content = $slide['project_slide_content'] ) :
										$html .= '<div class="ps__content">' . $content . '</div>';
									endif;
									
									// slide citation
									if ( $cite = $slide['project_slide_content_cite'] ) :
										$html .= '<div class="ps__cite">' . $cite . '</div>';
									endif;
									
									$html .= '
									</div>
							</div>
						';
					endif;
				
				$html .= '</div>';
			endforeach;
	
			// close slider
			$html .= '
				</div>
			</div>';
	
	echo $html;

endif;
