<?php //! TEMPLATE NAME: Contact 
get_header(); ?>
<div class="main">
	<?php Custom_Client::get_masthead(); ?>
	<div class="inner">
		<div class="page-title">
			<?php Custom_Client::get_page_title(); ?>
			<?php Custom_Client::get_introductory_text(); ?>
		</div>
		<div class="content clearfix">
			<?php if ( have_posts() ) : 
				while ( have_posts() ) : the_post(); ?>
				
					<div class="contact-left">
						<?php the_content(); ?>
					</div>

					<div class="contact-right">
						<?php Custom_Client::get_tmpl_contact(); ?>
					</div> 

				<?php endwhile;
			endif; ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>