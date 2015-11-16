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

        columnGap: 0,

        map: {
            'column': 'column',

            'column-1': 'column-1',
            'column-2': 'column-2',
            'column-3': 'column-3',
            'column-4': 'column-4',

            'column-full': 'column-full'
        },

        animationDuration: 2000
    };

    $.fn.snowgridRefresh = function() {
        var settings         = this.data( 'snowgrid-setting' );
        var colGap           = settings.columnGap;
        var columnIdentifier = this.data( 'snowgrid-column-identifier' );
        var width            = this.width();
        var numbColumns      = Math.floor( width / settings.minWidth )
        var colWidth         = ( width - colGap ) / numbColumns - colGap;
        var columns          = this.find( columnIdentifier );

        // Set all the next top variables to zero by default.
        var nextTop = [];

        for ( var i = 0; i < numbColumns; i++ ) { nextTop.push( colGap ); }

        var children = [];

        // Set the positions to absolute, note that any dynamically appended
        // must be positioned absolutly.
        columns.each(function( i ) {
            $( this ).css( 'position', 'absolute' );

            // Select the shortest column...
            var top = _.min( nextTop );
            var col = _.indexOf( nextTop, top );

            var left  = col * ( colGap + colWidth ) + colGap;
            var width = colWidth;

            // Set the widths
            $( this ).outerWidth( width );

            // Create a child element to apply after all calculations...
            var child = {
                obj: $( this ),
                x:  left,
                y: top,
                w: width,
                h: $( this ).outerHeight(),
                n: i
            };

            nextTop[col] = child.y + child.h + colGap;
            children.push( child );
        });

        columns.each(function( i ) {
            $( this ).stop( 1, 1 ).animate({
                left: children[i].x,
                top: children[i].y,
                width: children[i].w
            }, settings.animationDuration);
        });

        this.height( _.max( nextTop ) );
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

        // Show that this is a snowgrid.
        this.data( 'is-snowgrid', true );

        var arrange = function() {
            this.snowgridRefresh();
        }.bind( this );

        // Origionally resize the grid to scale.
        $( window ).endResize( arrange );
        this.snowgridRefresh();

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
        var overrides = {};

        _.each( snowgridsettings, function( num, key ) {

            if ( $( this ).attr( 'snowgrid-' + key ) ) {
                overrides[key] = $( this ).attr( 'snowgrid-' + key );
            }

        });

        console.log( overrides );

        $( this ).snowgrid( '*[class^=column]', overrides );
    } );
});
