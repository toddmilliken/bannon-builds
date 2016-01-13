<?php get_header(); ?>
<div class="main">
	<?php Custom_Client::get_masthead(); ?>
	<div class="inner">
		<div class="page-title">
			<?php Custom_Client::get_page_title(); ?>
		</div>
		<?php get_sidebar('right'); ?>
		<div class="content">
			<?php if ( have_posts() ) : 
				while ( have_posts() ) : the_post(); 
					the_content();	
					if ( is_404() ) the_field( 'opts_404_text', 'options' );		
				endwhile;
			endif; ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>