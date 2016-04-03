<?php if ( $projects = get_field('project_posts') ) : ?>
<div class="inner">
	<div class="project-grid">
		<ul class="grid" id="projects">
		<?php 
			foreach ( $projects as $project ) : 
				//! GET PROJECT ID			
				$project_ID = $project->ID;
				
				//! OUTPUT GRID ITEM IF HAS THUMBNAIL
				if ( has_post_thumbnail( $project_ID ) ) :
					$project__thumbnail_ID = get_post_thumbnail_id($project_ID);
					$project__thumbnail_url = wp_get_attachment_image_src($project__thumbnail_ID, 'mobile');
					echo '
						<li class="griditem">
							<div class="griditem__box">
								<a class="griditem__link" href="' . get_permalink( $project->ID ) . '">
									<div class="griditem__img" style="background-image: url(' . $project__thumbnail_url[0] .');"></div>
								</a>
								<h3 class="griditem__title">' . get_the_title($project->ID) . '</h3>
							</div>
						</li>
					';
			    endif;
			    
			endforeach; 
		?>
		</ul>
	</div>
</div>
<?php endif; ?>