/**
 * Show the navigation bar when it is scrolled on a single page.
 */
jQuery(document).ready(function($) {
    if ( ! $( 'body.single' ).length ) { return; }

    // On scroll add the hidden class, if scrolled past ~5
    $( '#page' ).scroll(function() {
        if ( $( this ).scrollTop() > 5 ) {
            $( '#site-navigation' ).addClass('hide-most');
        } else {
            $( '#site-navigation' ).removeClass('hide-most');
        }
    });
});
