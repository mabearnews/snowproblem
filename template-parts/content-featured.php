<?php
/**
 * Template part for displaying featured posts. This will occur mainly on the front page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package snowproblem
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'featured-post' ); ?>>
	<!-- Everything in this section is transfered to the front of attention on hover. -->
	<section class="post-content" data-post-id="post-<?php the_ID(); ?>" <?php echo has_post_thumbnail() ? 'style="background-image: url(' . get_the_post_thumbnail_url() . ');"' : 'style="background-color: rgb(192, 57, 43);"'; ?>>

			<div class="entry-content">

					<div class="title">
						<a href="<?php print get_permalink(); ?>"><?php the_title( '<h1 class="entry-title">', '</h1>' ); ?></a>
					</div>

					<div class="excerpt">
						<?php the_excerpt(); ?>
					</div>

			</div><!-- .entry-content -->

	</section><!-- .post-featured-image -->

</article><!-- #post-## -->
