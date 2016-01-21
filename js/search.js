jQuery(document).ready(function($) {
    var state = false;

    var toggleState = function() {
        state = ! state;

        if ( state ) {
            $( 'body' ).addClass( 'search-visible' );
        } else {
            $( 'body' ).removeClass( 'search-visible' );
        }
    };

    // Allows the toggle to do some toggling.
    $( '#search-toggle' ).on( 'click', toggleState );

    // Also on search exit button click...
    $( '#search-exit' ).on( 'click', toggleState );

    // Submit searchform on input enter.
    $( '#searchform .search-field' ).keypress(function (e) {
        if ( e.which == 13 ) {
            $('#searchform').submit();
            return false; // Ensure default is prevented.
        }
    });

});
