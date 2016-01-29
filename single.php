<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package snowproblem
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', 'single' ); ?>

			<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( ( comments_open() || get_comments_number() ) && defined( 'SNOWPROBLEM_COMMENTS_ALLOWED' ) ) : ?>

				<div id="comments-container">

					<?php comments_template(); ?>

				</div>

			<?php endif; ?>

		<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
