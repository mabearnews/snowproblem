<?php
/**
 * Funcitonality for the addition of post view counter. This is done by
 * adding a meta filed for the post that is updated when the post is viewed.
 *
 * @see http://www.wpbeginner.com/wp-tutorials/how-to-track-popular-posts-by-views-in-wordpress-without-a-plugin/
 *
 * @package snowproblem
 */


/**
 * Sets the post views. Based off of information concerning the post, this
 * value may either increase or be set to zero -- the alter in the case of a
 * new post.
 *
 * This function should be called every time single.php is hit.
 *
 * The meta key for this is `snowproblem_views_count`
 *
 * @param int $post_id
 */
 function snowproblem_set_post_views( $post_id = 0 ) {
    // Ensure the id is present.
    if ( ! $post_id ) {
        global $post;
        $post_id = $post->ID;
    }

    $count_key = 'snowproblem_views_count';
    $count = get_post_meta( $post_id, $count_key, true );

    if( $count == '' ){
        $count = 0;
        delete_post_meta( $post_id, $count_key );
        add_post_meta( $post_id, $count_key, '0' );
    } else {
        update_post_meta( $post_id, $count_key, ++$count );
    }
 }

 // To keep the count accurate, lets get rid of prefetching.
 remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

/**
 * Provides a method for the return of the post view count as specified by the
 * 'snowproblem_set_post_views' function. Simply a convenicance over calling
 * 'get_post_meta'
 *
 * @param int $post_id
 *
 * @return int
 */
function snowproblem_get_post_views( $post_id = 0 ) {
    // Ensure the id is present.
    if ( ! $post_id ) {
        global $post;
        $post_id = $post->ID;
    }

    // Keep synched with set_post_views.
    $count_key = 'snowproblem_views_count';

    // Make the meta call. -- pretty far out mate.
    $count = get_post_meta( $post_id, $count_key, true );

    if ( $count == '' ) {
        return 'NO DICE!';
    }
    return $count;
}

/**
 * Ensures the 'snowproblem_set_post_views' function is used to keep track of
 * post views only on single pages.
 *
 * @param int $post_id
 */
 function snowproblem_track_post_views( $post_id = null ) {
     // Avoid any pages not single.
    if ( ! is_single() ) return;

    // Ensure the id is set.
    if ( ! $post_id ) {
        global $post;
        $post_id = $post->ID;
    }

    // Perform the actual function call
    snowproblem_set_post_views($post_id);
}

add_action( 'wp_head', 'snowproblem_track_post_views');
