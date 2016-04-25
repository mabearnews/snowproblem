<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package snowproblem
 */

?>

<div id="post-<?php the_ID(); ?>"
		 <?php post_class( 'post post-popular swipe-elem' ); ?>
		 style="background-image: url('<?php print snowproblem_get_thumbnail_url('singlepost-background'); ?>')">

	<section class="post-content">

		<div class="title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</div>

		<div class="entry-meta">
			<?php snowproblem_posted_on(); ?>
		</div>

	</section>

</div><!-- #post-## -->
