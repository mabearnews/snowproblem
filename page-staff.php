<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package snowproblem
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'page' ); ?>

			<?php endwhile; // End of the loop. ?>

            <?php wp_reset_query(); ?>
            <?php query_posts('post_type=staff_people&orderby=title'); ?>

            <?php if ( have_posts() ) : ?>

                <section id="people-container">

                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php get_template_part( 'template-parts/content', 'about-person' ); ?>

                    <?php endwhile; ?>

                </section> <!-- #people-container -->

            <?php endif; ?>
            <?php wp_reset_query(); ?>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer(); ?>
