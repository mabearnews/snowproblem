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
function snowproblem_display_popular( $cat = 0, $numb = 1 ) {
    global $exclude_ids;

    $postsQuery = array(
        'meta_key'    => 'snowproblem_views_count',
        'orderby'     => 'meta_value_num',
        'numberposts' => 30,
    );

    if ( $cat ) {
        $postsQuery['category_name'] = $cat;
    }

    if ( $cat )

    query_posts( $postsQuery );

    while ( have_posts() ) {
        the_post();

        // Check condiftions of post, to see whether it meets proper criteria
        if ( has_post_thumbnail() && ! in_array( get_the_ID(), $exclude_ids ) ) {
            get_template_part( 'template-parts/content', 'popular' );
            $exclude_ids[] = get_the_ID();
            if ( ! --$numb ) break;
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

/**
 * Creates a section with an id and with an assortmant of cards based off of
 *  a category.
 *
 * @param string $category
 * @param int $numb
 */
function snowproblem_display_category( $category, $numb = 3 ) {
    if ( ! get_posts( "category_name=$category" ) ) { return; }

    snowproblem_section_title( $category );

    ?>
    <section id="<?php print $category ?>"
             class="post-container snowgrid"
             snowgrid-columnGap="10"
             snowgrid-animationDuration="1">

        <?php
        snowproblem_excluded_query( array(
            'orderby'        => 'DATE',
            'order'          => 'DESC',
            'numberposts'    => $numb,
            'meta_key'       => '_thumbnail_id',
            'category_name'  => $category,
        ), function() {
            get_template_part( 'template-parts/content', 'newscard' );
        } ); ?>

    </section>
    <?php
}

get_header(); ?>

<div id="react-container"></div>

<div id="top-stories-container">

    <div class="top-stories">

        <?php snowproblem_display_popular( 'top-stories', 4 ); ?>

    </div> <!-- .top-stories -->

    <div id="top-stories-controller">

            <?php foreach ( range(0, 3) as $a ) : ?>
                <div class="option"></div>
            <?php endforeach; ?>

    </div> <!-- #top-stories-controller -->

</div> <!-- #top-stories-controller -->

<div id="front-container">

    <?php snowproblem_display_category( 'news' ); ?>

    <?php snowproblem_display_category( 'opinion' ); ?>

    <?php snowproblem_display_category( 'sports' ); ?>

    <?php snowproblem_display_category( 'culture' ); ?>

    <?php snowproblem_display_category( 'blogs' ); ?>

    <?php get_footer(); ?>

</div>
