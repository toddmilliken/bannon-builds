<?php 

class Custom_Blog extends Custom_Theme
{
	
	/*-----------------------------------------------------------------------------------------------------------
	 *
 	 * Conditionally check if requested template is a blog-specific-template.
 	 *
 	 * @boolean - returns true if this is a blog-specific template.
 	 *
 	 *-----------------------------------------------------------------------------------------------------------*/
	function is_blog() {
		if ( is_home() || is_category() || is_tag() || is_author() || is_date() || is_singular('post') ) :
			return true;
		else :
			return false;
		endif;
	}
	
	/*-----------------------------------------------------------------------------------------------------------
	 *
 	 * Retrieve the site's blog title. Displays in the get_masthead() function in blog-specific pages.
 	 *
 	 * @return variable $blog_title (html)
 	 *
 	 *-----------------------------------------------------------------------------------------------------------*/
	function get_blog_title( $echo = true ) {

		$id = get_option('page_for_posts');
		$title = ( get_field('int_alt_title', $id) ? get_field('int_alt_title', $id) : get_the_title($id) );	
		//! IF THIS IS NOT A SINGLE POST, USE H1
		if ( !is_singular('post') ) :
			$heading = 'h1';				
		else :
			$heading = 'h2';
		endif;

		if ( $echo ) :
			echo '<' . $heading . ' class="blog-title"><a href="' . get_permalink($id) . '">' . $title . '</a></' . $heading . '>';
		else :
			return '<' . $heading . ' class="blog-title"><a href="' . get_permalink($id) . '">' . $title . '</a></' . $heading . '>';
		endif;	
	}

	/*-----------------------------------------------------------------------------------------------------------
	 *
 	 * Output the correct template for the Blog (home, archive, single)
 	 *
 	 * @echo variable $html
 	 *
 	 *-----------------------------------------------------------------------------------------------------------*/
	function get_blog_posts()
	{
		//! IF NOT SINGULAR POST, GET BLOG POSTS IN LAYERS
		if ( !is_singular('post') ) :
			echo '<div class="blog-posts layers">';
				self::get_home_blog_posts();
			echo '</div>';
		//! ELSE, GET SINGLE POST
		else :
			if ( have_posts() ) :	
				while ( have_posts() ) : the_post();
					self::get_blog_post_singular();
				endwhile;
			endif;
		endif;		
	}
	
	/*-----------------------------------------------------------------------------------------------------------
	 *
 	 * Output layers for blog listings
 	 *
 	 * @ajax variable determines output. False = echo. True = wp_send_json_success
 	 * @query variable is the query to be displayed in layers. (required)
 	 *-----------------------------------------------------------------------------------------------------------*/
	function get_home_blog_posts()
	{
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();
				$html .= '
					<div class="content layer clearfix">
						<h2><a href="' . get_permalink() . '">' . Custom_Client::get_page_title(false) . '</a></h2>
						<div class="bp-meta-wrap">' . self::get_blog_post_meta(false) . '</div>' . 
						self::get_post_thumbnail(false) . '
						<div class="bp-content">
							<div class="bp-excerpt"><p>' . get_the_excerpt() . '</p></div>
							<div class="more-details">
								<div class="more-details-inner">
									<a href="' . get_permalink() . '" class="more more-big">Read Full Post</a>
								</div>
							</div>
							' . get_the_tag_list('<p class="tag-list">Tags: ',', ','</p>') . '
						</div>
					</div>';
				++$i;
			endwhile;
			wp_reset_postdata();			
			echo $html;			
		endif;
	}
	
	
	//! SINGLE BLOG POST
	function get_blog_post_singular()
	{
		echo '<div class="content">
				<div class="bp-header">
					<h1>' . Custom_Client::get_page_title(false) . '</h1>' .
					self::get_blog_post_meta(false) . '					
				</div>' . 
				self::get_post_thumbnail(false);
				the_content();
				echo get_the_tag_list('<p class="tag-list">Tags: ',', ','</p>');
				echo '
				</div>
				</div>
			</div>';
		self::get_about_author();
		echo '<div class="main comments-container"><div class="inner"><div class="content">';
		self::get_comments();
		echo '</div></div></div>';
	}
	
	/*-----------------------------------------------------------------------------------------------------------
	 *
 	 * Return blog post meta (user, category, date, comments)
 	 *
 	 * @return variable $html
 	 *
 	 *-----------------------------------------------------------------------------------------------------------*/
 	function get_blog_post_meta( $echo = true )
	{	
		$comment_num = get_comments_number();
		$html = '
			<ul class="bp-meta clearfix">
				<li class="bp-meta-author">Posted by <a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '">' . get_the_author_meta('display_name', get_the_author_meta('ID')) . '</a> on <span class="bp-meta-date">' . get_the_date() . '</span></li>
				<li class="bp-meta-cats">' . get_the_category_list(',') . '</li>' . 
				( $comment_num > 0 ? '<li class="bp-meta-comments"><a href="' . get_permalink() . '#respond">Comments ' . $comment_num . '</a></li>' : '' ) . '
			</ul>
		';	
		
		if ( $echo ) :
			echo $html;
		else :
			return $html;
		endif;
	}
 	
 	
	/*-----------------------------------------------------------------------------------------------------------
	 *
 	 * Return blog post author image
 	 *
 	 * @return variable $html
 	 *
 	 *-----------------------------------------------------------------------------------------------------------*/
	function get_author_thumbnail() 
	{
		if ( $img = get_field('user_thumbnail', 'user_' . get_the_author_meta('ID') ) ) :
			$html .= '<div class="author-thumb"><img class="no-border" src="' . $img['url'] . '" alt="' . $img['alt'] . '" /></div>';
			return $html;
		endif;
	}
	
	function get_post_thumbnail( $echo = true )
	{
		$html = '<div class="bp-featured-img">';
		if ( has_post_thumbnail() )	:
			//! DETERMINE LINK IF ON ARCHIVE OR SINGLE
			if ( is_single() ) :
				$link = wp_get_attachment_url(get_post_thumbnail_id());
			else :
				$link = get_permalink();
			endif;
			$html .= '<a href="' . $link . '">' . get_the_post_thumbnail(get_the_ID()) . '</a>';
		endif;
		$html .= '<div class="addthis_sharing_toolbox" data-url="' . get_permalink() . '" data-title="' . the_title_attribute(array('echo' => false)) . '"></div></div>';			
		
		if ( $echo ) :
			echo $html;
		else :
			return $html;
		endif;
	}
	
	/*-----------------------------------------------------------------------------------------------------------
	 *
 	 * Return blog post author image
 	 *
 	 * @return variable $html
 	 *
 	 *-----------------------------------------------------------------------------------------------------------*/
	
	function get_about_author()
	{
		$author_id = get_the_author_meta('ID');
		$bio = get_the_author_meta('description', $author_id );
		
		echo '<div class="about-author"><div class="inner clearfix"><div class="content clearfix">' 
			. self::get_author_thumbnail() . '
			<div class="author-details">
				<h2>Written by: <strong><a href="' . get_author_posts_url( $author_id ) . '">' . get_the_author_meta( 'display_name' , $author_id ) . '</a></strong></h2>';
				if ( !empty($bio) ) :
					echo '<p>' . $bio . '</p>';
				endif;
			echo '</div>
		</div></div></div>';
	}
	
	//! OUTPUTS COMMENT FORM AND COMMENT TEMPLATE
	function get_comments() 
	{
		$html = self::get_comment_form();
		$html .= self::get_comments_list();
		echo $html;
	}
	
	function get_comment_form()
	{
		//! DEFAULT INPUT FIELDS
		$fields =  array(
		    'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
		        '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
		    'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
		        '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
		    //'url'    => '<p class="comment-form-url"><label for="url">' . __( 'Website' ) . '</label>' .
		    //    '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
		);
		
		//! CUSTOMIZE ARGUMENTS FOR FORM
		$args = array(
			'class_submit' => 'btn',
			'comment_notes_before' => false,
			'comment_notes_after' => false,
			'fields' => $fields,
			'label_submit' => 'Post Comment',
			'title_reply' => 'Leave a Comment',
		);
		return comment_form($args);		
	}
	
	function get_comments_list() 
	{
		//! INCLUDE OUR COMMENT WALKER FUNCTION
		include_once get_stylesheet_directory() . '/core/includes/class-walker-comments.php';
		
		//! RETURN IF POST REQUIRES PASSWORD
		if ( post_password_required() ) return;
		
		//! GET ALL COMMENTS ARRAY FROM THE CURRENT POST
		$comments = get_comments(array('post_id'=> $post->ID));
		
		//! SETUP WP_LIST_COMMENTS ARGS
		$args = array(
			'walker'            => new Custom_Walker_Comment,
			//'max_depth'         => '',
			'style'             => 'ol',
			//'callback'          => null,
			//'end-callback'      => null,
			//'type'              => 'all',
			'reply_text'        => 'Reply',
			//'page'              => '',
			//'per_page'          => '',
			'avatar_size'       => 60,
			//'reverse_top_level' => null,
			//'reverse_children'  => '',
			'format'            => 'html5', // or 'xhtml' if no 'HTML5' theme support
			//'short_ping'        => false,   // @since 3.6
			'echo'              => false     // boolean, default is true
		);
		$html = '<ol class="commentlist no-list-style">' . wp_list_comments($args, $comments) . '</ol>';
		return $html;
	}
}