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

/**
 * Define main post content number of posts to return each time.
 */
define( 'FRONT_MAX_COL', 4 );

/**
 * Which categories will be displayed on the front page...
 */
$front_categories = array( 'news', 'opinion', '' );

get_header(); ?>

	<?php include get_template_directory() . '/front-parts/featured.php'; ?>

	<?php include get_template_directory() . '/front-parts/breaking-news-ticker.php'; ?>


	<section id="categories-container" class="percent-gird" class="snowgrid" snowgrid-max-col-numb="<?php print FRONT_MAX_COL; ?>">

		<?php// include get_template_directory() . '/front-parts/editors-picks.php'; ?>

		<?php
		/**
		 * Grab all of the relevant categories and put them in individual containers, there should be around ~4
		 */


		foreach ( $front_categories as $category ) :
		?>


		<?php endforeach; ?>
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
	<section id="recent-posts" snowgrid-columnGap="10" class="snowgrid" ajax-load-posts='<?php echo json_encode( $params ); ?>'></section>
<?php get_footer(); ?>
