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
    $numberposts = $skipTo + $post_number + count( $exclude_ids ) + 3;

    // If the query is an array parse that, else parse as a whole
    if ( is_array( $data ) ) {
        $data['numberposts'] = $numberposts;
    } else {
        $data .= '&numberposts=' . $numberposts;
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

/**
 * Used to get the data for a number of posts, returned as json. This allowes
 * for the creation of a more dynamic front page, as well as sitewide contnet
 * that works more regulary.
 *
 * All data is sent over post and wp_query is used to return a value.
 *
 * If a post id is provided, only one post will be returned.
 */
function snowproblem_ajax_data_get() {
    // Establish the nubmer of posts that are to be included.
    $numbPosts = isset( $_POST['post_number'] ) ? $_POST['post_number'] :
               ( isset( $_POST['numberposts'] ) ? $_POST['numberposts'] : 1000 );

    // Establish what is to be taken from the post in terms of data.
    $what = isset( $_POST['what'] ) ? $_POST['what'] : null;

    // Establish what post to skip to, past a certain number if need be.
    $skipTo = isset( $_POST['skip_to'] ) ? $_POST['skip_to'] : 0;

    // Any id's for posts that could be excluded from the return values.
    $excludeIds = isset( $_POST['exclude_ids'] ) ? $_POST['exclude_ids'] : array();

    // Unset any values from the post arrays that are not for querys.
    $queryData = $_POST;
    unset($queryData['post_number']);
    unset($queryData['action']);
    unset($queryData['what']);
    unset($queryData['skip_to']);
    unset($queryData['exclude_ids']);

    // Find out how many posts per page by using the exclude ids and skip to
    // in order to formulate a number.
    $postsPerPage = $skipTo + $numbPosts + count( $excludeIds ) + 1;

    $queryData['numberposts'] = $postsPerPage;

    // Perform the actual wordpress query.
    $query = new WP_Query( $queryData );

    // The data that will be returned as a json string.
    $returnData = array();

    // Special functions that are called if they are passed as a 'what' param
    // to the posts.
    $specials = array(
        'categories' => function( $id ) {
            $cats = array();
            foreach( wp_get_post_categories( $id ) as $c ) {
            	$cat = get_category( $c );

                // Include the url.
                $cat->url = get_category_link( $c );

            	$cats[] = $cat;
            }
            return $cats;
        },
        'featured_image' => 'get_the_post_thumbnail_url',
    );

    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) { $query->the_post();

            $id = get_the_ID();

            // Ensure the post is not to be excluded, if it is skip it.
			if ( in_array( $id, $excludeIds ) ) { continue; }

            // If not yet reached the number of posts needed to be skipped,
            // ignore the next post.
			if ( --$skipTo >= 0 ) { continue; }

            // Ensure that not to manny posts are actually being returned.
			if ( $numbPosts-- <= 0 ) {  break; };

            $post = get_post( $id );

            // Return the data based off of what type of component is provided.
            if ( $what ) {
                $dataComp = array();

                foreach ( $what as $propVal => $key ) {

                    // Ensure numeric values are not present.
                    if ( is_numeric( $key ) ) {
                        $key = $propVal;
                    }

                    if ( isset( $post->$propVal ) ) {

                        $dataComp[$key] = $post->$propVal;

                    } else if ( function_exists( $propVal ) ) {

                        $dataComp[$key] = $propVal( $id );

                    } else if ( isset( $specials[$propVal] ) ) {

                        $dataComp[$key] = call_user_func( $specials[$propVal], $id );

                    } else {

                        $dataComp[$key] = null;
                    }
                }

                $returnData[] = $dataComp;
            } else {

                $returnData[] = $post;
            }
        }
    }

    // Ensure proper functionality continues
    wp_reset_query();

    // Actually display the result as json.
    echo json_encode( $returnData );

    // Avoid the die 0 command which prints a rather inconveniant 0.
	die();
}

// Allow for data loading, primarily used on the front page.
add_action( 'wp_ajax_ajax_data_get', 'snowproblem_ajax_data_get' );
add_action( 'wp_ajax_nopriv_ajax_data_get', 'snowproblem_ajax_data_get' );
