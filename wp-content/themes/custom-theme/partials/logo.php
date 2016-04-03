<?php 
	
	//! outputs the site logo, set in Options. 	
	if ( $logo = get_field('opts_logo', 'option') ) : 
	
?>

		<a class="logo" href="<?php echo home_url(); ?>">
			<img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>" />
		</a>
		
<?php 
	
	endif; 
	
?>