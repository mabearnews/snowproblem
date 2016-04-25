/**
 * @see https://github.com/thebird/Swipe
 */
jQuery(document).ready(function($) {
    if ( ! $( '#top-stories-container' ).length ) { return; }

    var topSwipe = Swipe( document.getElementById('top-stories-container'), {
        auto: 3000,
        speed: 550,
        callback: function(index) {
            var i = index + 1;
            // Automatically update the bottom indexes.
            $( '#top-stories-controller .option.active' ).removeClass('active');
            $( '#top-stories-controller .option:nth-child('+i+')' ).addClass('active');
        }
    } );

    // Initially at the first position.
    $( '#top-stories-controller .option:first' ).addClass('active');

    // Change the index based off of the options.
    $( '#top-stories-controller .option' ).click(function() {
        topSwipe.slide( $( this ).index() );
    });

    $( '#top-stories-arrows .left' ).click(function() {
        topSwipe.prev();
    });

    $( '#top-stories-arrows .right' ).click(function() {
        topSwipe.next();
    });
});
