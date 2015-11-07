(function($) {
    /**
     * Creates a grid system based using absolutly positioned eleemnts. All
     * that is set is the width and top, left properties of each element.
     *
     * The containers width should be specifed as should the identity of the
     * container and the primary elements within that grid.
     *
     * The width of the grid elements is specified by class:
     *  column-1 ( default width )
     *  column-2 ( 2x default width )
     *  column-3 ( 3x default width )
     *  column-full ( 100% width )
     *
     * These can be changed by providing a map of column- class names to other
     * Identifiers in $.snowgrid.map
     *
     * All widths are specified in pixels.
     *
     * The default min-width is 220px
     * the default max-width is 350px
     *
     * These properties can be specified by setting:
     *  $.snowgrid.minWidth
     *  $.snowgrid.maxWidth
     */

    snowgridsettings = {
        minWidth: 300,
        maxWidth: 400,

        columnGap: 20,

        map: {
            'column': 'column',

            'column-1': 'column-1',
            'column-2': 'column-2',
            'column-3': 'column-3',
            'column-4': 'column-4',

            'column-full': 'column-full'
        }
    };

    $.fn.snowgridRefresh = function() {
        var settings = this.data( 'snowgrid-setting' );
        var colGap = settings.columnGap;
        var columnIdentifier = this.data( 'snowgrid-column-identifier' );

        var width  = this.width();
        var numbElements = Math.ceil( width / ( settings.maxWidth + colGap ) );
        var colWidth     = ( width - colGap ) / numbElements - colGap;
        var columns = this.find( columnIdentifier );

        // Set all the next top variables to zero by default.
        var nextTop = [];
        for ( var i = 0; i < numbElements; i++ ) { nextTop.push( colGap ); }

        var index = 0;
        columns.each(function() {
            // Set the number of columns for the given elemnt.
            var colNumb = 1;
            if ( $( this ).hasClass( settings.map['column-2'] ) ) {
                colNumb = 2;
            } else if ( $( this ).hasClass( settings.map['column-3'] ) ) {
                colNumb = 3;
            }  else if ( $( this ).hasClass( settings.map['column-4'] ) ) {
                colNumb = 4;
            } else if ( $( this ).hasClass( settings.map['column-full'] ) ) {
                colNumb = numbElements;
            }

            var width = colWidth * colNumb + colGap * ( colNumb - 1 );
            var top   = nextTop[ index  % numbElements ];
            var left  = ( index % numbElements ) * ( colGap + colWidth ) + colGap;



            // Actually adjust the element size
            $( this ).css({
                width: width + 'px',
                top: top + 'px',
                left: left + 'px'
            });
            // Update the value of the next top for this element...
            for ( colNumb; colNumb > 0; colNumb-- ) {
                nextTop[ index % numbElements ] += $( this ).height() + colGap;
                index++;
            }
        });

        // Update the size of the container to be the largest of the nextTop values.
        var maxTop = 0;
        for ( var i = 0; i < nextTop.length; i++ ) {
            if ( maxTop < nextTop[i] ) { maxTop = nextTop[i]; }
        }
        this.height( maxTop );
    };

    $.fn.snowgrid = function( columnIdentifier, overrides ) {
        var settings = snowgridsettings;

        // Ovverride default setting values
        if ( typeof overrides === 'object' ) {
            settings =  (function objectMerge( orig, over ) {
            	for ( var key in over ) {
            		if ( orig.hasOwnProperty( key ) ) {

            			if ( typeof over[key] === 'object' ) {
            				orig[ key ] = objectMerge( orig[key], over[key] );
            			} else {
            				orig[ key ] = over[key];
            			}

            		}
            	}
            	return orig;
            })( settings, overrides )
        }

        // Save the settings
        this.data( 'snowgrid-setting', settings );

        // Check if a column identifier is passed, else, provide one
        if ( typeof columnIdentifier === 'undefined' ) {
            columnIdentifier = settings.map.column;
        }

        this.data( 'snowgrid-column-identifier', columnIdentifier );

        // Ensure the contianer is positioned relativly.
        if ( this.css( 'position' ) != 'relative' &&
             this.css( 'position' ) != 'absolute' &&
             this.css( 'position' ) != 'fixed' ) {

              this.css( 'position', 'relative' );

        }

        // Show that this is a snowgtid.
        this.data( 'is-snowgrid', true );

        // Set the positions to absolute, note that any dynamically appended
        // must be positioned absolutly.
        this.find( columnIdentifier ).each(function() {
            $( this ).css( 'position', 'absolute' );
        });

        var performAlignment = function() {

            this.snowgridRefresh();

        }.bind( this );

        // Origionally resize the grid to scale.
        $( window ).endResize( performAlignment );
        performAlignment();


        // Ensure that that endResize event loaded properly.
        setTimeout(performAlignment, 1000);
        setTimeout(performAlignment, 2500);

        // Tell self that snowgrid is loaded.
        this.addClass( 'loaded' );

        return this;
    };

})( jQuery );



jQuery(document).ready(function($) {
    /**
     * Creats some default class implementation of the snowgrid.
     */
    $( '.snowgrid' ).each( function() {

        if ( $( this ).attr( 'first-large' ) ) {

            var fl = $( this ).attr( 'first-large' );

            if ( fl < 2 ) {
                fl = 2;
            }

            var elem = $( this ).find('*[class^=column]:first');

            if ( elem.hasClass( 'has-post-thumbnail' ) ) {
                elem.addClass( 'column-' + fl );
            }
        }

        $( this ).snowgrid( '*[class^=column]' );
    } );
});
