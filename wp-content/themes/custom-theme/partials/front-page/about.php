<div id="home-content" class="h-layer">
	<div class="inner">
		<div class="h-left">
			<?php if ( $title = get_field('home_about_title') ) : ?>
				<h2><?php echo $title; ?></h2>
			<?php endif; ?>
		</div>
		<div class="h-right">
			<?php 
				if ( $content = get_field('home_about_content') ) : 
					echo $content; 
				endif; 
			?>
		</div>
	</div>
</div>