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
    'numberposts' => 5,
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
        'meta_key'    => 'snowproblem_views_count',
        'orderby'     => 'meta_value_num',
        'numberposts' => 20,
    ) );

    while ( have_posts() ) {
        the_post();

        // Check condiftions of post, to see whether it meets proper criteria
        if ( has_post_thumbnail() && ! in_array( get_the_ID(), $exclude_ids ) ) {
            get_template_part( 'template-parts/content', 'popular' );
            $exclude_ids[] = get_the_ID();
            break;
        }
    }

    wp_reset_query();
}


/**
 * Create a title for a category. This is used often for the division of
 * sectons of content.
 *
 * It allows for some newer/better containment of reduntnat logic.
 *
 * -- I'm kinda sick, so if you can't understand that, my bad
 *
 * @param string $cat_name
 */
function snowproblem_section_title( $cat_name ) {
    $cat   = term_exists('Uncategorized', 'category') ? get_category_by_slug( $cat_name ) : 0;
    $title = $cat ? get_cat_name( $cat->term_id ) : $cat_name;
    $url   = $cat ? esc_url( get_category_link( $cat->term_id ) ) : "#$cat_name";

    ?>
        <div class="section-title-container">
            <section class="section-title">
                <div class="title-size">
                    <span><?php print $title; ?></span>
                </div>
                <div class="title-first angled">
                    <a class="title" href="<?php print $url; ?>"><?php print $title; ?></a>
                </div>
                <div class="title-second angled">
                    <a class="title" href="<?php print $url; ?>"><?php print $title; ?></a>
                </div>
            </section>
        </div>
    <?php
}

get_header(); ?>

<div id="front-container">

    <?php snowproblem_section_title( 'top-stories' ); ?>

    <section id="top-stories" class="post-container snowgrid" snowgrid-columnGap="10" snowgrid-animationDuration="1">
        <?php
        snowproblem_excluded_query( array(
            'orderby'        => 'DATE',
            'order'          => 'DESC',
            'numberposts'    => '6',
            'meta_key'       => '_thumbnail_id',
            'category_name'  => 'top-stories',
        ), function() {
            get_template_part( 'template-parts/content', 'newscard' );
        } ); ?>

    </section>

    <?php snoproblem_display_popular(); ?>

    <?php snowproblem_section_title( 'categories' ); ?>

    <section id="categories"
             class="snowgrid"
             snowgrid-columnGap="10"
             snowground-minWidth="120"
             snowground-maxWidth="260">

        <?php
        $cats = get_categories( array(
            'orderby'      => 'count',
            'order'        => 'DESC',
            'hierarchical' => 0,
        ) );

        foreach ( $cats  as $cat ) : if ( $cat->count < 5 || $cat->slug == 'uncategorized' ) { continue; } ?>

            <div class="column cat" style="height: <?php print rand( 50, 150 ); ?>px;">

                <a href="<?php print esc_url( get_category_link( $cat->term_id ) ); ?>">
                    <?php print $cat->cat_name; ?>
                </a>

            </div> <!-- .cat -->

        <?php endforeach; ?>

    </section> <!-- #categories -->

    <?php snowproblem_section_title( 'Recent Posts' ); ?>

    <section id="recent-posts" class="post-container snowgrid" snowgrid-columnGap="10" snowgrid-animationDuration="1">

        <?php
        snowproblem_excluded_query( array(
            'orderby'        => 'DATE',
            'order'          => 'DESC',
            'numberposts' => '6',
            'meta_key'       => '_thumbnail_id',
        ), function() {
            get_template_part( 'template-parts/content', 'newscard' );
        } ); ?>

    </section>

    <?php snoproblem_display_popular(); ?>

    <?php get_footer(); ?>

</div>
