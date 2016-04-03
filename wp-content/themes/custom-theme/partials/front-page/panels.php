<?php if ( $panels = get_field('home_panels') ) : ?>
	
	<section class="panels-wrapper">
		<div class="icon-loading"><i class="fa fa-circle-o-notch fa-spin"></i></div>
		<div class="arrow--down"><i class="fa fa-angle-down"></i></div>
		<div class="panels owl-carousel">
	
		<?php			
			$panel_counter = 1;
			foreach ( $panels as $panel ) :
		?>

			<div class="panel panel-<?php echo $panel_counter; ?>" id="panel-<?php echo $panel_counter; ?>">
				
				<?php if ( $bg_img = $panel['hp_bg_img'] ) :	?>
<!--
					<div class="panel-bg picturefill-background">
						<span data-src="<?php echo $bg_img['url']; ?>" data-media="(min-width: 681px)"></span>
						<span data-src="<?php echo $bg_img['sizes']['mobile']; ?>" data-media="(max-width: 680px)"></span>
					</div>
-->
					<img class="panel__img" src="<?php echo $bg_img['url']; ?>"/>
				<?php endif; ?>

				<div class="hp-content">
					<div class="inner">
				
					<?php if ( $hp_title = $panel['hp_title'] ) : ?>
						<h1 class="hp-title">
							<?php if ( $hp_link = $panel['hp_link'] ) : ?>
								<a class="hp-link" href="<?php echo $hp_link; ?>">
							<?php endif; ?>

								<?php echo $hp_title; ?>
								
							<?php if ( $hp_link = $panel['hp_link'] ) : ?>
								</a>
							<?php endif; ?>

						</h1>
					<?php endif; ?>
					
					</div>
				</div>


			</div>

		<?php 
			++$panel_counter;
			endforeach;
		?>

		</div>
	</section>

<?php endif; ?>