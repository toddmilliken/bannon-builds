<?php if ( $panels = get_field('home_panels') ) : ?>
	
	<section class="panels-wrapper">


		<div class="hp-content">
		
			<?php if ( $hp_headline = get_field('hp_headline') ) : ?>
				<h1 class="hp-headline"><?php echo $hp_headline; ?></h1>
			<?php endif; ?>

			<?php if ( $hp_desc = get_field('hp_description') ) : ?>
				<div class="hp-desc"><?php echo $hp_desc; ?></div>
			<?php endif; ?>

		</div>



		<ul class="panels owl-carousel">
	
		<?php			
			$panel_counter = 1;
			foreach ( $panels as $panel ) :
		?>

			<li class="panel panel-<?php echo $panel_counter; ?>" id="panel-<?php echo $panel_counter; ?>">
				
				<?php if ( $bg_img = $panel['hp_bg_img'] ) :	?>
					<div class="panel-bg picturefill-background">
						<span data-src="<?php echo $bg_img['url']; ?>" data-media="(min-width: 681px)"></span>
						<span data-src="<?php echo $bg_img['sizes']['mobile']; ?>" data-media="(max-width: 680px)"></span>
					</div>
				<?php endif; ?>

			</li>

		<?php 
			++$panel_counter;
			endforeach;
		?>

		</ul>
	</section>

<?php endif; ?>