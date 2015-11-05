<?php
/**
 * The template for displaying author pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package snowproblem
 */


/**
 * Wordpress author.
 *
 * @link https://codex.wordpress.org/Author_Templates
 */
$author = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php if ( have_posts() ) : ?>

				<header id="author-info" class="page-header">

					<div class="author-content">

						<?php if ( $author_image = get_author_image_url( $author->id ) ) : ?>

							<div class="author-image">
								<img src="<?php echo $author_image; ?>" />
							</div>

						<?php endif;?>

						<div class="author-name">

							<h1><?php echo $author->display_name;  ?></h1>
						</div>

						<?php if ( $bio = $author->description ) : ?>

							<div class="author-bio">
								<p><?php echo $bio; ?></p>
							</div>

						<?php endif; ?>

					</div><!-- .author-content -->

				</header><!-- .page-header -->

				<section id="category-results" class="loaded-posts" ajax-load-posts="<?php print $query_string; ?>"></section>

			<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
