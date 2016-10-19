<?php get_header(); 
	$partial_dir = 'partials/front-page/';
?>
	<?php get_template_part($partial_dir . 'panels'); ?>
	<?php get_template_part($partial_dir . 'about'); ?>
	<?php get_template_part($partial_dir . 'projects'); ?>
<?php get_footer(); ?>