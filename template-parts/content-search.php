<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package snowproblem
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<section class="post-content">
		<header class="entry-header">
			<?php print _svg_heading( get_the_title() ); ?>

			<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php snowproblem_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_excerpt(); ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer continue-reading">
			<span class="read-more">
				<?php print '<a href="' . get_permalink() . '" title="' . __('Read More', 'snowproblem') . '" rel="bookmark">— Read More</a>'; ?>
			</span>
		</footer><!-- .entry-footer -->
	</section>
	<!-- Shows the background of the site with the vertical slant as specified. -->
	<div class="background"></div>
</article><!-- #post-## -->
