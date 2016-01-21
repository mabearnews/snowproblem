jQuery(document).ready(function($) {
    /**
     * Include the creation of the add-hover-stick class which is applied to all
     * children on hover, but not removed thereafter.
     */

    $( '*[add-hover-stick]' ).each(function() {
        var t = $( this );
        var c = t.attr( 'add-hover-stick' );
        t.children().mouseover(function(event) {
            // Remove all other applied classes...
            t.children( '.' + c ).each(function() { $( this ).removeClass( c ); });

            $( this ).addClass( c );
        });
    });
});
