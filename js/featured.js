jQuery(document).ready(function($) { if ( $( '#featured' ).length ) {

// The front page is there.
var f   = $( '#featured' );
var fps = $( '#featured-posts > article.featured-post' );
var cp  = fps.last();

var it  = 6000;

// Allowes the interval to be paused...
var intervalIsPaused = false;

function next( e ) {
    /* Gets the next element from the current element */
    return e.index() + 1 >= fps.length ? fps.first() : $( fps[ e.index() + 1 ] );
}

var intFunc = function() {
    if ( ! intervalIsPaused ) {
        // Remove old one...
        $( '#featured-posts > article.featured-post.active' ).removeClass( 'active' );

        // Change the current post.
        cp = next( cp );

        // Add new one...
        cp.addClass( 'active' );

        // Tell the option which is featured...
        $( '#featured-post-navigation .option.active' ).removeClass( 'active' );
        $( '#featured-post-navigation .option' ).eq( cp.index() ).addClass( 'active' );
    }
};

var interval = setInterval( intFunc, it );
intFunc();

// Handle click to navigate the featured section...
$( '#featured-post-navigation .option' ).on( 'click', function() {

    cp = $( fps[ $( this ).index() - 1] );

    clearInterval( interval ); // Normalize timing.
    interval = setInterval( intFunc, it );
    intFunc();
});


}});
