<?php 
get_header();
get_template_part('partials/masthead');
get_template_part('partials/wrapper', 'open');
	if ( have_posts() ) :
		while ( have_posts() ) : the_post(); 
			the_content();
		endwhile;
	else : 
		the_field('opts_404_text', 'options');
	endif;		
get_template_part('partials/wrapper', 'close');	
get_footer(); 
?>