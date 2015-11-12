<?php
/**
 * Allow ajax loading of scripts to display content on infinite scroll.
 *
 * A request sent over post will be extrapolated into various elements of
 * information needed to retrieve the post.
 */
function snowproblem_ajax_post_loading() {
    // Ensure the post data is not corrupted;
    $pos_data = $_POST;

    // Establish the format of the posts as seen in 'template-parts/contnet'
    $format = isset( $_POST['postFormat'] ) ? $_POST['postFormat'] : '';

    // Check for the number of posts to be retrieved. Set to maximum if no specified.
    $post_number = isset( $_POST['postNumber'] ) ? $_POST['postNumber'] : PHP_INT_MAX;

    // If a post must skip to a certain value allow that functionality, this is
    // in cases where one would load the next ten posts.
    $skipTo = isset( $_POST['skipTo'] ) ? $_POST['skipTo'] : 0;

    // If some posts have already been loaded or are for some other reason
    // undesirable, skip these to avoid duplication;
    $exclude_ids = isset( $_POST['excludeIDS'] ) ? $_POST['excludeIDS'] : array();

    // Establish the nature and validity of the query params.
	$data = $_POST['queryParams'];

    // Establish how many posts should be included, instead of performing a
    // massive sql query to get all of them, we will only get the number needed,
    // while is the number requested, any that must be skipped, and excluded
    // posts wich are not included in $post_number. The +3 is just for security.
    $posts_per_page = $skipTo + $post_number + count( $exclude_ids ) + 3;

    // If the query is an array parse that, else parse as a whole
    if ( is_array( $data ) ) {
        $data['posts_per_page'] = $posts_per_page;
    } else {
        $data .= '&posts_per_page=' . $posts_per_page;
    }

    // Perform the mysql query and return each post
    query_posts( $data );

    // Iterate through the posts, in the same manner as seeen in template files.
	if ( have_posts() ) :
		while ( have_posts() ) : the_post();

            // Ensure the post is not to be excluded, if it is skip it.
			if ( in_array( get_the_ID(), $exclude_ids ) ) { continue; }

            // If not yet reached the number of posts needed to be skipped,
            // ignore the next post.
			if ( --$skipTo >= 0 ) { continue; }

            // Ensure that not to manny posts are actually being returned.
			if ( $post_number-- <= 0 ) {  break; };

            //  Actually pull the content of format specified.
			get_template_part( 'template-parts/content', $format );
		endwhile;
	endif;

	wp_reset_query();

	// Avoid the die 0 command which prints a rather inconveniant 0.
	die();
}

// Ecourage wordpress to allow this ajax functionality.
add_action( 'wp_ajax_ajax_post_loading', 'snowproblem_ajax_post_loading' );
add_action( 'wp_ajax_nopriv_ajax_post_loading', 'snowproblem_ajax_post_loading' );
