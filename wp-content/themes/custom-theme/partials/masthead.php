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
	

	//! VERIFY THERE IS A MASTHEAD IMAGE AND BUILD HTML
	$blank_gif = get_template_directory_uri() . '/core/image/blank.gif';

?>		
	<section class="masthead">
		<?php if ( $masthead ) : ?>
			<div class="masthead-bg picturefill-background">
				<span data-src="<?php echo $masthead['url']; ?>" data-media="(min-width: 681px)"></span>
				<span data-src="<?php echo $blank_gif; ?>" data-media="(max-width: 680px)"></span>
			</div>
			
		<?php endif; ?>
		<div class="tble">
			<div class="tble-cell">
				<div class="masthead-content">
					<div class="inner">
						<h1 class="masthead-title"><?php echo Custom_Client::get_page_title(false); ?></h1>
					</div>
				</div>
		</div>
	</section>