/**
 * @see https://github.com/thebird/Swipe
 */
jQuery(document).ready(function($) {
    if ( ! $( '#top-stories-container' ).length ) { return; }

    // Change some display properties by removing post image styles.
    $( '#top-stories-container .post' ).each(function() {
        $( this ).removeClass('format-image')
                 .removeClass('post_format-post-format-image');
    });

    window.topStoriesSwipe = new Swipe( document.getElementById('top-stories-container'), {
        auto: false,
        speed: 550,
        callback: function(index) {
            var i = index + 1;
            // Automatically update the bottom indexes.
            $( '#top-stories-controller .option.active' ).removeClass('active');
            $( '#top-stories-controller .option:nth-child('+i+')' ).addClass('active');
        }
    } );

    var interval;
    var resetInterval = function() {
        clearInterval(interval);
        interval = setInterval(function() {
           window.topStoriesSwipe.next();
        }, 4000);
    }
    resetInterval();

    // Initially at the first position.
    $( '#top-stories-controller .option:first' ).addClass('active');

    // Change the index based off of the options.
    $( '#top-stories-controller .option' ).click(function() {
        window.topStoriesSwipe.slide( $( this ).index() );
        resetInterval();
    });

    $( '#top-stories-arrows .arrow' ).click(resetInterval);
});
