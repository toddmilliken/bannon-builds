<?php //! Template Name: Projects
	get_header();
	get_template_part('partials/masthead');
?>
<div id="main-content">
	<div class="main-projects">
	<?php	
		if ( have_posts() ) :
			while ( have_posts() ) : the_post(); 	
				the_content();
				get_template_part('partials/project-posts');
			endwhile;
		endif;
	?>
	</div>
</div>

<?php get_footer(); ?>