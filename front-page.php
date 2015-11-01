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

	<?php
	/**
	 * Keep track of the already loaded posts.
	 */
	$loaded_posts = array();
	?>

	<?php query_posts('posts_per_page=4&category_name=featured&orderby=date&order=DESC'); /* Query all posts with 'featured' category. Maximum of 5. */ ?>
	<?php if ( have_posts() ): ?>

		<section id="featured">
			<section id="featured-image"></section>
			<section id="featured-posts">
					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php
						/**
						 * Include content speciffically of the 'featured' type.
						 */
						get_template_part( 'template-parts/content', 'featured');

						// Add the post to already loaded elements
						$loaded_posts[] = get_the_ID();
						?>

					<?php endwhile; ?>

				<?php wp_reset_query(); /* Reset for all posts. */ ?>
			</section> <!-- #featured-posts -->
		</section> <!-- #featured -->

	<?php endif; ?>

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

					// Add the post to already loaded elements
					$loaded_posts[] = get_the_ID();
					?>

				<?php endwhile; ?>
			<?php endif; ?>
			<?php wp_reset_query(); /* Reset for all posts. */ ?>
		</section>
	</section>

	<?php
		/**
		 * Define the paramaters for the recent posts query.
		 */
		 $params = array(
			 'orderby' => 'data',
			 'order'   => 'DESC',
			 'postFormat' => 'front',
		 );
	?>
	<section id="recent-posts" class="snowgrid" ajax-load-posts='<?php echo json_encode( $params ); ?>' first-large="2"></section>
<?php get_footer(); ?>
