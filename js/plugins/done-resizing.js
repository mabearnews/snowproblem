jQuery(document).ready(function($) {
    /**
     * Functions that is fired when a resize event is complete. This is used
     * primarily for the window element.
     *
     * Example use `$(window).endResize()`
     */

    $.fn.endResize = function( func ) {
        var resizeID;
        this.resize( function() {
            clearTimeout( resizeID );

            resizeId = setTimeout( function() {
                func.call( this );
            }, 1000 );
        } );

    }
});
