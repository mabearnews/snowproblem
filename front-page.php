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

/// Determines what id's are already loaded on the page (note!) this does
/// not, by default, include featured, thus the following loop is perfrmed.
$exclude_ids = array();

// Note, this query is exactly the same as that used in
// js/front/components/featured.jsx and should be kept in synch with that
// query
query_posts( array(
    'category_name'  => 'featured',
    'orderby'        => 'date',
    'order'          => 'DESC',
    'posts_per_page' => 5,
) );

while ( have_posts() ) {
    the_post();
    $exclude_ids[] = get_the_ID();
}

wp_reset_query();



/**
 * Shows a top story that will be shown in a manner even more prominint than
 * a feature. This function loads one of these and displays it in proper format
 * after performing a wordpress query. No more than 10 of these should be
 * displayed.
 *
 * @see template-parts/content-most-viewed
 */
function snoproblem_display_popular() {
    global $exclude_ids;

    query_posts( array(
        'meta_key'       => 'post_views_count',
        'orderby'        => 'meta_value_num',
        'posts_per_page' => 20,
        'date_query'     => array(
           'after' => date('Y-m-d', strtotime('-40 days'))
       ),
    ) );

    while ( have_posts() ) {
        the_post();

        // Check condiftions of post, to see whether it meets proper criteria
        if ( has_post_thumbnail() && ! in_array( get_the_ID(), $exclude_ids ) ) {
            get_template_part( 'template-parts/content', 'popular' );
            $exclude_ids[] = get_the_ID();
        }
    }

    wp_reset_query();
}

get_header(); ?>

<div id="front-container">

    <section class="section-title">
        <a class="title" href="<?php echo esc_url( get_category_link( get_category_by_slug( 'top-stories' ) ) ); ?>">Top Stories</a>
    </section>
    <section id="top-stories" class="post-container snowgrid" snowgrid-columnGap="10" snowgrid-animationDuration="1">
        <?php
        snowproblem_excluded_query( array(
            'orderby'        => 'DATE',
            'order'          => 'DESC',
            'posts_per_page' => '6',
            'meta_key'       => '_thumbnail_id',
            'category_name'  => 'top-stories',
        ), function() {
            get_template_part( 'template-parts/content', 'newscard' );
        } ); ?>

    </section>

    <?php snoproblem_display_popular(); ?>

    <section id="categories">

        <?php wp_list_categories( array(
            'orderby'  => 'count',
            'order'    => 'DESC',
            'depth'    => 1,
            'title_li' => '',
        ) ); ?>

    </section>

    <section class="section-title">
        <a>Recent Posts</a>
    </section>
    <section id="recent-posts" class="post-container snowgrid" snowgrid-columnGap="10" snowgrid-animationDuration="1">
        <?php
        query_posts( array(
            'orderby'        => 'DATE',
            'order'          => 'DESC',
            'posts_per_page' => '6',
            'meta_key'       => '_thumbnail_id',
        ) );

        while ( have_posts() ) : the_post();

            get_template_part( 'template-parts/content', 'newscard' );

        endwhile; ?>

    </section>

    <?php get_footer(); ?>

</div>
