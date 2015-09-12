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

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area content-container">
	<section class="content-element">
		<?php if ( have_comments() ) : ?>
			<h2 class="comments-title">
				<?php
					printf( // WPCS: XSS OK.
						esc_html( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'snowproblem' ) ),
						number_format_i18n( get_comments_number() ),
						'<span>' . get_the_title() . '</span>'
					);
				?>
			</h2>

			<section class="comment-list">
				<?php
					wp_list_comments( array(
						'style'      => 'div',
						'short_ping' => true,
						'per_page'   => -1,
						'max_depth'  => 1,
					) );
				?>
			</section><!-- .comment-list -->


		<?php endif; // Check for have_comments(). ?>

		<?php
			// If comments are closed and there are comments, let's leave a little note, shall we?
			if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'snowproblem' ); ?></p>
		<?php endif; ?>

		<?php comment_form(); ?>
	</section> <!-- .content-element -->
</div><!-- #comments -->
