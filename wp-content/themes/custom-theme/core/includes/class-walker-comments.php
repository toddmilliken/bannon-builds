<?php

class Custom_Walker_Comment extends Walker_Comment 
{
		
/**
	 * Start the list before the elements are added.
	 *
	 * @see Walker::start_lvl()
	 *
	 * @since 2.7.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of comment.
	 * @param array $args Uses 'style' argument for type of HTML list.
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$GLOBALS['comment_depth'] = $depth + 1;

		switch ( $args['style'] ) {
			case 'ol':
				$output .= '<ol class="children level-'.$depth.'">' . "\n";
				break;
			default:
			case 'ul':
				$output .= '<ul class="children level-'.$depth.'">' . "\n";
				break;
		}
	}

	/**
	 * End the list of items after the elements are added.
	 *
	 * @see Walker::end_lvl()
	 *
	 * @since 2.7.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of comment.
	 * @param array  $args   Will only append content if style argument value is 'ol' or 'ul'.
	 */
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$GLOBALS['comment_depth'] = $depth + 1;

		switch ( $args['style'] ) {
			case 'ol':
				$output .= "</ol><!-- .children .level-".$depth." -->\n";
				break;
			default:
			case 'ul':
				$output .= "</ul><!-- .children .level-".$depth." -->\n";
				break;
		}
	}

	/**
	 * Start the element output.
	 *
	 * @since 2.7.0
	 *
	 * @see Walker::start_el()
	 * @see wp_list_comments()
	 *
	 * @param string $output  Passed by reference. Used to append additional content.
	 * @param object $comment Comment data object.
	 * @param int    $depth   Depth of comment in reference to parents.
	 * @param array  $args    An array of arguments.
	 */
	function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) {
		$depth++;
		$GLOBALS['comment_depth'] = $depth;
		$GLOBALS['comment'] = $comment;
		$authorID = get_post_field( 'post_author', $comment->comment_post_ID ); // retrieve author ID - probably best to define this as a static variable
		if ( ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) && $args['short_ping'] ) {
			ob_start();
			$this->ping( $comment, $depth, $args );
			$output .= ob_get_clean();
		} elseif ($comment->user_id == $authorID) {
			ob_start();
			$this->author_comment( $comment, $depth, $args );
			$output .= ob_get_clean();	
		} else {
			ob_start();
			$this->html5_comment( $comment, $depth, $args );
			$output .= ob_get_clean();
		}
	}

	/**
	 * Ends the element output, if needed.
	 *
	 * @since 2.7.0
	 *
	 * @see Walker::end_el()
	 * @see wp_list_comments()
	 *
	 * @param string $output  Passed by reference. Used to append additional content.
	 * @param object $comment The comment object. Default current comment.
	 * @param int    $depth   Depth of comment.
	 * @param array  $args    An array of arguments.
	 */
	function end_el( &$output, $comment, $depth = 0, $args = array() ) {
		$output .= "</li>\n";
	}

	/**
	 * Output a comment in the HTML5 format.
	 *
	 * @access protected
	 * @since 3.6.0
	 *
	 * @see wp_list_comments()
	 *
	 * @param object $comment Comment to display.
	 * @param int    $depth   Depth of comment.
	 * @param array  $args    An array of arguments.
	 */
	protected function html5_comment( $comment, $depth, $args ) {
?>
		<li id="comment-<?php comment_ID(); ?>" class="comment">
			<figure class="gravatar no-border"><?php echo get_avatar( $comment->comment_author_email , $args['avatar_size']); ?></figure>
			<article class="comment-body">
				<p class="comment-author"><?php comment_author_link(); ?></p>
				<p class="comment-date"><?php comment_date(); ?></p>
				<div class="comment-content"><?php comment_text(); ?></div>
				<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'])), $comment->comment_ID); ?>
			</article>
<?php
	}
	
	/**
	 * Outputs a post author's comment.
	 *
	 * @access protected
	 *
	 * @param object $comment Comment to display.
	 * @param int    $depth   Depth of comment.
	 * @param array  $args    An array of arguments.
	 */
	protected function author_comment( $comment, $depth, $args ) {
?>
		<li id="comment-<?php comment_ID(); ?>" class="comment post-author-comment">
			<figure class="gravatar no-border"><?php echo get_avatar( $comment->comment_author_email , $args['avatar_size']); ?></figure>
			<article class="comment-body">
				<p class="comment-author"><?php comment_author_link(); ?></p>
				<p class="comment-date"><?php comment_date(); ?></p>
				<div class="comment-content"><?php comment_text(); ?></div>
				<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'])), $comment->comment_ID); ?>
			</article>
<?php
	}
}