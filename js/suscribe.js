jQuery(document).ready(function($) {
    // Handle click events from the form and alter it to subscribe if
    // it passes validation and such. (validation has not yet been implemented).

    $( '#mce-EMAIL' ).keypress(function(e) {
        if ( e.keyCode == 13 ) { // Enter was pressed.
            // Change the form status to submitted.
            $('form#mc-embedded-subscribe-form').submit();
        }
    });
});
