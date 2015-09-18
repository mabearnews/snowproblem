<?php
/**
 * Template part for displaying featured posts. This will occur mainly on the front page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package snowproblem
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<!-- Everything in this section is transfered to the front of attention on hover. -->
	<section class="post-featured-image" data-post-id="post-<?php the_ID(); ?>">

			<?php if ( has_post_thumbnail() ) : ?>

				<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>

					<div class="background-image" style="background-image: url('<?php print $image[0]; ?>');"></div>

				<?php unset($image); /* Remove $image in case it interferes with later wordpress functionality. */ ?>

			<?php else  : ?>

				<div class="background-image" style="background-color: rgb(192, 57, 43);"></div>

			<?php endif;?>

			<div class="entry-content">

				<div class="entry-content-wrapper">
					
					<a href="<?php print get_permalink(); ?>" title="<?php print  __('Read More', 'snowproblem'); ?>" rel="bookmark"><?php the_title( '<h1 class="entry-title">', '</h1>' ); ?></a>

					<?php the_excerpt(); ?>

				</div>


			</div><!-- .entry-content -->

	</section><!-- .post-featured-image -->

	<section class="post-content recieves-toggles">

		<header class="entry-header">

			<a href="<?php print get_permalink(); ?>" title="<?php print  __('Read More', 'snowproblem'); ?>" rel="bookmark"><?php the_title( '<h1 class="entry-title">', '</h1>' ); ?></a>

			<?php if ( 'post' == get_post_type() ) : ?>

				<div class="entry-meta">
					<?php snowproblem_posted_on( 'n/j/y' ); ?>
				</div><!-- .entry-meta -->

			<?php endif; ?>

		</header><!-- .entry-header -->

	</section>
	<!-- Shows the background of the site with the vertical slant as specified. -->
	<div class="background"></div>

</article><!-- #post-## -->
