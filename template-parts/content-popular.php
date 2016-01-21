<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package snowproblem
 */

?>

<article id="post-<?php the_ID(); ?>"
		 <?php post_class( 'post post-popular' ); ?>
		 style="background-image: url('<?php print snowproblem_get_thumbnail_url(); ?>')">

	<section class="post-content">

		<div class="title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</div>

		<div class="entry-meta">
			<?php snowproblem_posted_on(); ?>
		</div>

	</section>

</article><!-- #post-## -->
