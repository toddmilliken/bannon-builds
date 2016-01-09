			<footer class="site-foot">
					<?php Custom_Parts::get_social(); ?>
					<div class="footer-copy">
						<?php echo ( $footer_copy = get_field('opts_footer_copy', 'options') ) ? $footer_copy : ''; ?>
					</div>
					<?php wp_nav_menu('container=&menu_class=footer-menu clearfix&theme_location=footer-menu&fallback_cb=false'); ?>
			</footer>
		</div><!-- end site-wrap -->
	</div><!-- end outer-wrap -->
	<?php wp_footer(); ?>
	</body>
</html>
