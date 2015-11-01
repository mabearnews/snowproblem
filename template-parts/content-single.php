<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package snowproblem
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-post-type="<?php print get_post_type(); ?>">
	<?php if ( has_post_thumbnail() ) : ?>

		<section class="featured-image">

			<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>

				<div class="background-image" style="background-image: url('<?php print $image[0]; ?>');"></div>

			<?php unset($image); /* Remove $image in case it interferes with later wordpress functionality. */ ?>

		</section>

	<?php endif; ?>

	<div class="center-element">

		<section class="post-content">
			<header class="entry-header entry-section">
				<?php the_title( '<h1 class="entry-title add-animated">', '</h1>' ); ?>

				<div class="entry-meta">
					<?php snowproblem_posted_on(); ?>
				</div><!-- .entry-meta -->
			</header><!-- .entry-header -->

			<div class="entry-content entry-section">
				<?php the_content(); ?>
				<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'snowproblem' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->

			<footer class="entry-footer entry-section">
				<?php snowproblem_entry_footer(); ?>
			</footer><!-- .entry-footer -->
		</section>
	</div>
</article><!-- #post-## -->
