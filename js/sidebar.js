jQuery(document).ready(function($) {
    /* Toggle state on sidebar toggle click... */
    var state = false;
    $( '#sidebar-toggle' ).on( 'click', function() {
        state = ! state;

        if ( state ) {
            $( 'body' ).addClass( 'sidebar-visible' );
        } else {
            $( 'body' ).removeClass( 'sidebar-visible' );
        }
    } );
});
