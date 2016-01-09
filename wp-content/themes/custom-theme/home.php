<?php get_header(); ?>
<div class="main">
	<?php Custom_Client::get_masthead(); ?>
	<div class="inner">
		<div class="page-title">
			<?php Custom_Blog::get_blog_title(); ?>
			<?php Custom_Client::get_introductory_text(); ?>
		</div>
		<?php get_sidebar('blog'); ?>
		<?php Custom_Blog::get_blog_posts(); ?>
	</div>
</div>
<?php get_footer(); ?>