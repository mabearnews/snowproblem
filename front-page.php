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

/**
 * Sets up an array of id's to be ignored as they are already loaded...
 */
$loaded_posts = array();

get_header(); ?>

	<?php include get_template_directory() . '/front-parts/featured.php'; ?>

	<?php include get_template_directory() . '/front-parts/breaking-news-ticker.php'; ?>


	<section class="front-grid direction-row row-2">

		<div class="col-1" >

		</div>

		<div class="col-2 front-grid direction-col" >

			<div class="row-p50" >

				<?php /* Include editors picks -- avoids excessivly complicated front page file. */  ?>
				<?php include get_template_directory() . '/front-parts/editors-picks.php'; ?>
			</div>

			<div class="row-p50">

			</div>

		</div>

	</section>

	<?php
		/**
		 * Define the paramaters for the recent posts query.
		 */
		 $params = array(
			 'orderby'    => 'date',
			 'order'      => 'DESC',
			 'postFormat' => 'front',
			 'excludeIDS' => $loaded_posts,
		 );
	?>
	<section id="recent-posts" class="snowgrid" ajax-load-posts='<?php echo json_encode( $params ); ?>' first-large="2"></section>
<?php get_footer(); ?>
