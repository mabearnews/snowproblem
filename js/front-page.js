/* Implement the breaking news ticker... */
(function( $ ) {
    $.fn.breakingNewsTicker = function( contentContainer, settings ) {
        settings = _.extend({
            typeCharTime: 40,
            messageDelayTime: 4 * 1000
        }, settings );

        /**
         * The implementation is as followes:
         *
         * 1. Load the contents into arrays of data.
         * 2. Remove all of said contents except one, which shall retain the data.
         * 3. Animate the action of such data with the time provided.
         */

        // 2. Save an element to contain the data.
        var container = this.find( contentContainer ).first().clone().empty();

        // 1. Gather the data.
        var strings = [];

        this.find( contentContainer ).each(function() {
            strings.push( $( this ).text() );

            // 2. Remove this item from the parent.
            $( this ).remove();
        });

        // 2. Add the content container.
        this.append( container );

        // 2. Refresh container varable.
        container = this.find( contentContainer ).first();

        // 3. Proceed with the animations for the ticker.
        var animateString = function animateString( string, callback, numb ) {

            if ( ! numb ) { numb = 0; }
            if ( numb > string.length ) { callback(); return;  }

            container.text( string.substr( 0, numb ) );

            setTimeout( function() {
                animateString( string, callback, numb + 1 );
            }, settings.typeCharTime )
        };
        var changeAnimationSection = function changeAnimationSection( s, i, first ) {
            if ( i >= s.length ) { i = 0; }

            var performAct = function() {
                animateString( s[i], function() {
                    changeAnimationSection( s, i + 1, false);
                });
            };

            if ( first !== false ) {
                performAct();
            } else {
                setTimeout( performAct, settings.messageDelayTime );
            }
        };

        changeAnimationSection( strings, 0 );
    };
})( jQuery) ;



jQuery(document).ready(function($) {

    // Ajax load the recent posts.
    $( '#recent-posts' ).data( 'ajax-load-posts-done', function() {
        this.snowgridRefresh();
        this.find( '.ajax-loading' ).first().css({
            position: 'absolute',
            bottom: '0'
        });
    } );

    // Implement the news ticker if it is available
    if ( $( '#breaking-news-ticker' ).length ) {
        $( '#breaking-news-items' ).breakingNewsTicker( '.ticker-item' );
    }

    // Add the navigation bar below the react container. Make it relativly
    // postiioned and attach a window scroll event to change this status.
    if ( $('#react-container').length ) {
        // Detatch and reattache the react container and the page navigaiton
        // to the page.
        $( '#page' ).prepend( $( '#site-navigation' ).detach() );
        $( '#page' ).prepend( $( '#react-container' ).detach() );
        $( '#content-nav-bar-padding' ).height(0);

        var navIsRel = true;
        $( '#site-navigation' ).css('position', 'relative');

        $( '#page' ).on('scroll', function() {
            var nt = $( '#site-navigation' ).offset().top;
            var ft = $( '#react-container' ).offset().top;
            var fh = $( '#react-container' ).height();

            // Check if there should be a change.
            if ( ( nt > 0 || (fh + ft) > 0 ) && ! navIsRel ) {
                $( '#site-navigation' ).css('position', 'relative');
                navIsRel = true;
            } else if ( nt <= 0 && navIsRel ) {
                $( '#site-navigation' ).css('position', 'fixed');
                navIsRel = false;
            }
        });
    }
});
