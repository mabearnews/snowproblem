<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package snowproblem
 */

// Ensure that their is no viewing of this file by itself, this shouldn't
// really happen so lets die if its the case.
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) &&
	 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME']) ) {
	die ('Please do not load this page directly. Thanks!');
}



// If the current post is protected by a password and
// the visitor has not yet entered the password we will
// return early without loading the comments.
if ( post_password_required() ) {
	echo "Post comments password protected, try again next time...";
	return;
}
?>

<div id="comments" class="comments-area">
	<section class="comments-content">
		<?php if ( have_comments() ) : ?>
			<h2 class="comments-number">
				<span class="num"><?php print get_comments_number(); ?></span> Comments
			</h2>

			<section class="comment-list">
				<?php
					wp_list_comments( array(
						'style'		  => 'div',
						'type'        => 'comment',
						'callback'    => 'snowproblem_comment',
						'avatar_size' => 0,
						'format'      => 'html5',
					) );
				?>
			</section><!-- .comment-list -->


		<?php endif; // Check for have_comments(). ?>

		<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'snowproblem' ); ?></p>
		<?php endif; ?>

		<?php comment_form(); ?>
	</section> <!-- .content-element -->
</div><!-- #comments -->
