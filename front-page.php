<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package snowproblem
 */

get_header(); ?>

	<!-- <div id="primary" class="content-area">
		<main id="main" class="site-main" role="main"> -->

		<section id="featured">
			<section id="featured-image"></section>
			<section id="featured-posts">
				<?php query_posts('posts_per_page=4&category_name=featured&orderby=date&order=DESC'); /* Query all posts with 'featured' category. Maximum of 5. */ ?>
				<?php if ( have_posts() ): ?>
					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php
							/**
							 * Include content speciffically of the 'featured' type.
							 */
							get_template_part( 'template-parts/content', 'featured');

						?>

					<?php endwhile; ?>
				<?php endif; ?>
				<?php wp_reset_query(); /* Reset for all posts. */ ?>
			</section> <!-- #featured-posts -->
		</section> <!-- #featured -->

		<section id="breaking">
			<section id="breaking-posts">
				<?php query_posts('posts_per_page=5&category_name=breaking&orderby=date&order=DESC'); /* Query all posts with 'featured' category. Maximum of 5. */ ?>
				<?php if ( have_posts() ): ?>
					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php
							/**
							 * Include content speciffically of the 'featured' type.
							 */
							get_template_part( 'template-parts/content', 'front' );

						?>

					<?php endwhile; ?>
				<?php endif; ?>
				<?php wp_reset_query(); /* Reset for all posts. */ ?>
			</section>
		</section>

		<section id="recent-posts">
			<?php
			/**
			 * Go back 12 months using php date function
			 */
			 $count = 0;
			 $current_month = date('m');
			 $current_year  = date('Y');

			 while ( $count < 12 ):

				 // Establish varaibles to use.
				 $month = $current_month > $count ? $current_month - $count : 12 + $current_month - $count;
				 $year  = $current_month > $count ? $current_year : $current_year - 1;

				 $count++;
			?>
				<?php query_posts( "year={$year}&monthnum={$month}&posts_per_page=-1&orderby=date&order=DESC" ); ?>

				<?php if ( have_posts() ) : ?>

					<section class="month month-<?php print $month; ?> year-<?php print $year; ?> masonary-grid">

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php
					//		if ( ! has_category( 'featured' ) ) :

							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'template-parts/content', 'front' );

					//		endif;
						?>

					<?php endwhile; ?>

					</section><!-- .month -->

				<?php endif; ?>



				<?php wp_reset_query(); ?>

			<?php endwhile; ?>

		</section><!-- #recent-posts-->

<?php get_footer(); ?>
