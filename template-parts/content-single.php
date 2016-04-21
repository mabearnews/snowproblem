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

		<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'singlepost-background' ); ?>

		<section class="featured-image" image-url="<?php print $image[0]; ?>">

			<div class="background-image" style="background-image: url('<?php print $image[0]; ?>');"></div>

			<?php unset($image); /* Remove $image in case it interferes with later wordpress functionality. */ ?>

			<?php if ( has_post_format( 'image' ) ) : ?>

				<div class="entry-header entry-section">
					<?php the_title( '<h1 class="entry-title add-animated">', '</h1>' ); ?>

					<div class="entry-meta">
						<?php snowproblem_posted_on(); ?>
					</div><!-- .entry-meta -->
				</div><!-- .entry-header -->

			<?php endif; ?>

		</section>

	<?php endif; ?>


	<div class="center-element">

		<section class="post-content">
			<?php if ( ! has_post_format( 'image' ) ) : ?>

				<header class="entry-header entry-section">
					<?php the_title( '<h1 class="entry-title add-animated">', '</h1>' ); ?>

					<div class="entry-meta">
						<?php snowproblem_posted_on(); ?>
					</div><!-- .entry-meta -->
				</header><!-- .entry-header -->

			<?php endif; ?>

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

			<?php get_template_part('template-parts/content', 'social-share' ); ?>


			<?php if ( ( comments_open() || get_comments_number() ) && defined( 'SNOWPROBLEM_COMMENTS_ALLOWED' ) ) : ?>

				<div class="comments-section entry-section">

					<div class="comments-toggle">
						<i class="fa fa-comments-o"></i>
					</div>

				</div>

			<?php endif; ?>

		</section> <!-- .post-content -->
	</div> <!-- .center-element -->
</article><!-- #post-## -->
