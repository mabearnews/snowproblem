jQuery(document).ready(function($) { if ( $( '#featured' ).length ) {

// The front page is there.
var f   = $( '#featured' );
var fps = $( '#featured-posts > article.featured-post' );
var cp  = fps.first();


var tt  = 1000;
var it  = 10000;

// Allowes the interval to be paused...
var intervalIsPaused = false;

function next( e ) {
    /* Gets the next element from the current element */
    return e.index() + 1 >= fps.length ? fps.first() : $( fps[ e.index() + 1 ] );
}

var intFunc = function() {
    if ( ! intervalIsPaused ) {
        // Remove old one...
        cp.removeClass( 'active' );

        // Change the current post.
        cp = next( cp );

        // Add new one...
        cp.addClass( 'active' );
    }
};

var interval = setInterval(intFunc, it );

intFunc();

}});
