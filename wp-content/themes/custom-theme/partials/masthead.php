<?php 
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
	

	// global $post;

	$masthead = array(
		'background_color' => false,
		'background_image' => get_header_image(),
		'text_color' => get_header_textcolor()
	);
	

	//! IF NO MASTHEAD, CHECK ANCESTORS
	if ( get_field('is_customize_header') ) :
		
		// Background Color
		if ( $img = get_field('masthead_img') ) :
			$masthead['background_images'] = $img['sizes']['section_header'];
		endif;
		
		// Background Image
		$masthead['background_image'] = false;
		if (  ( $bg_color = get_field('masthead_bg_color') )  &&  ( get_field('masthead_bg_color') !== '333333' )  ) :
			$masthead['background_color'] = $bg_color;
		endif;
		
		// Text Color
		if (  ( $text_color = get_field('masthead_text_color') )  &&  ( get_field('masthead_text_color') !== 'FFFFFF' )  ) :
			$masthead['text_color'] = $text_color;
		endif;
		
	endif;

?>		
	<section class="masthead"<?php echo ( ! empty($masthead['background_color']) ? ' style="background-color: #' . sanitize_hex_color_no_hash( $masthead['background_color'] ) . '"' : '' ); ?>>
		<?php if ( ! empty($masthead['background_image']) ) : ?>
			<div class="masthead-bg picturefill-background">
				<span data-src="<?php echo $masthead['background_image']; ?>" data-media="(min-width: 681px)"></span>
				<span data-src="<?php echo get_template_directory_uri() . '/core/image/blank.gif'; ?>" data-media="(max-width: 680px)"></span>
			</div>			
		<?php endif; ?>
		<div class="tble">
			<div class="tble-cell">
				<div class="masthead-content">
					<div class="inner">
						<h1 class="masthead-title"<?php echo ( ! empty($masthead['text_color']) ? ' style="color: #' . sanitize_hex_color_no_hash($masthead['text_color']) . ' !important"' : '' ); ?>><?php echo Custom_Client::get_page_title(false); ?></h1>
					</div>
				</div>
		</div>
	</section>