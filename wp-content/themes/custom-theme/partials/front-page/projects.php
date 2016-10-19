<?php if ( $projects = get_field('home_projects') ) : ?>
<section class="home-projects">
	<div class="inner">
		<div class="project-grid">
			<?php if ( $heading = get_field('home_projects_heading') ) : ?>
				<h2 class="project-grid__heading"><?php echo $heading; ?></h2>
			<?php endif; ?>
			<ul class="grid grid--home-projects" id="projects">
			<?php 
				foreach ( $projects as $project_ID ) : 
									
					//! OUTPUT GRID ITEM IF HAS THUMBNAIL
					if ( has_post_thumbnail( $project_ID ) ) :
						$project__thumbnail_ID = get_post_thumbnail_id($project_ID);
						$project__thumbnail_url = wp_get_attachment_image_src($project__thumbnail_ID, 'mobile');
						echo '
							<li class="griditem">
								<div class="griditem__box">
									<a class="griditem__link" href="' . get_permalink( $project_ID ) . '">
										<div class="griditem__img" style="background-image: url(' . $project__thumbnail_url[0] .');"></div>
									</a>
									<h3 class="griditem__title">' . get_the_title($project_ID) . '</h3>
								</div>
							</li>
						';
				    endif;
				    
				endforeach; 
			?>
			</ul>
			<?php if ( $link = get_field('home_projects_link_internal') ) : ?>
				<a href="<?php echo $link; ?>" class="btn btn--home-projects">See All Our Work</a>
			<?php endif; ?>
		</div>
	</div>
</section>
<?php endif; ?>