		<footer class="site-foot">
			<div class="inner">
				
				<div class="footer-copy">
					Copyright &copy; <?php echo date('Y'); ?> <?php echo get_bloginfo( 'name' ); ?>. All&nbsp;Rights&nbsp;Reserved.
				</div>
			
				<div class="footer-links">
					<?php				
						
						//! FOOTER MENU 
						if ( has_nav_menu('footer-menu') ) :
							wp_nav_menu(array(
								'container' => '',
								'container_class' => '',
								'theme_location'  => 'footer-menu',
								'menu'            => '',
								'items_wrap' 	  	=> '<ul class="%2$s">%3$s</ul>',
								'menu_class'      => 'footer-menu',
							));
						endif;
						
						//! SOCIAL MEDIA ICONS/LINKS
						// Em_Parts::get_social_media(array('class' => 'social--footer'));
						
					?>			
				</div>
					
			</div>	
		</footer>
		<?php wp_footer(); ?>
	</body>
</html>
