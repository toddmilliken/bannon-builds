		<footer class="site-foot">
			<div class="inner">
				<div class="footer-copy">
					<?php echo ( $footer_copy = get_field('opts_footer_copy', 'options') ) ? $footer_copy : ''; ?>
				</div>
			</div>	
		</footer>
		<?php wp_footer(); ?>
	</body>
</html>
