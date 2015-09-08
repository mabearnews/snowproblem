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
	<section class="post-content">
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title add-animated">', '</h1>' ); ?>

			<div class="entry-meta">
				<?php snowproblem_posted_on(); ?>
			</div><!-- .entry-meta -->
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'snowproblem' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php snowproblem_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</section>
</article><!-- #post-## -->
