<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package snowproblem
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'snowproblem' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</header><!-- .page-header -->

				<?php
				/**
				 * Define some rudementarry query variables to crete the paramaters
				 * search query.
				 */
				$queryattrs = array(
					's' => get_search_query()
				);
				?>

				<section id="search-posts" class="loaded-posts" ajax-load-posts='<?php echo json_encode( $queryattrs ); ?>'></section> <!-- #search-posts -->

			<?php else: ?>

				<header class="page-header">
					<h1 class="page-title"><?php print __('Sorry, nothing found for ' . get_search_query() ); ?></h1>
				</header><!-- .page-header -->


				<section id="nothing-result">
					<blockquote>
						<p>
							<?php print __('I am the wisest man alive, for I know one thing, and that is that I know nothing.'); ?>
						</p>
						<cite>Plato</cite>
					</blockquote>

				</section>

			<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_footer(); ?>
