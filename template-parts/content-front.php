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
			<a href="<?php print get_permalink(); ?>" title="<?php print  __('Read More', 'snowproblem'); ?>" rel="bookmark"><?php the_title( '<h1 class="entry-title">', '</h1>' ); ?></a>

		</header><!-- .entry-header -->

		<div class="entry-image">
			<?php if ( has_post_thumbnail() ) : ?>

				<?php the_post_thumbnail( 'large' ); ?>

			<?php endif; ?>
		</div>

		<div class="entry-content">
			<?php the_excerpt(); ?>
		</div><!-- .entry-content -->

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php snowproblem_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>

	</section>
	<!-- Shows the background of the site with the vertical slant as specified. -->
	<div class="background"></div>
</article><!-- #post-## -->
