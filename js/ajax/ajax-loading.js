(function( $ ) {
    /**
     * jQuery plugin to implement default ajax loading for the appending of
     * ajax loaded content to a given container.
     *
     * October 28, 2015 Sequoia Snow
     */
    $.fn.ajaxLoadPosts = function( params, loaded ) {
        // Check if loaded is a function.
        if ( typeof loaded === 'undefined' ) {
            loaded = function() { };
        }

        var s = _.extend({
            scrollContainer: $( '#page' ),
            postNumber: 10
        }, params);

        // Create a loading animations
        this.append($(
            '<div class="ajax-loading">'+
                '<div class="letters">'+
                    '<div class="letter">G</div>'+
                    '<div class="letter">N</div>'+
                    '<div class="letter">I</div>'+
                    '<div class="letter">D</div>'+
                    '<div class="letter">A</div>'+
                    '<div class="letter">O</div>'+
                    '<div class="letter">L</div>'+
                '</div>'+
            '</div>'
        ));

        var ajaxLoadingDiv = this.find('.ajax-loading').first();


        var t = this;

        var numberReceived = 0;

        var refreshPosts = function() {
            console.log( 'Fetching more data' );

            var queryParams = _.clone( s );

            delete queryParams.postFormat;
            delete queryParams.scrollContainer;
            delete queryParams.postNumber;


            $.ajax({
        		url: ajaxinfo.url,
        		type: 'post',
        		data: {
        			action: 'ajax_post_loading',
                    postFormat: s.postFormat,
                    skipTo: numberReceived,
                    postNumber: s.postNumber,
                    queryParams: queryParams
        		},
        		success: function( result ) {
                    console.log( result );

                    r = $( result );

                    var resultNumb = $( '<div></div>' ).append( r.clone() ).children().length;

                    // Check if the response is actually valid
                    if ( ! result.length ) {
                        console.log( 'No more posts to load' );

                        ajaxLoadingDiv.unbind( 'inview', checkShouldRefresh );
                        ajaxLoadingDiv.remove();
                        return;
                    }

                    console.log( resultNumb + ' More posts loaded' );

                    ajaxLoadingDiv.before( r );

                    numberReceived += s.postNumber;

                    // Call loaded callback, if available.
                    loaded.call( t );


                    if ( resultNumb < s.postNumber ) {
                        // End of cycle, not all children asked for returned.
                        ajaxLoadingDiv.unbind( 'inview', checkShouldRefresh );
                        ajaxLoadingDiv.remove();

                        console.log( 'No more posts to load' );
                    }
        		},
                error: function( error ) {
                    console.log( 'Data Fetch failed' + error );
                }
        	});
        };

        /**
         * Ensures that the ajax loading should indeed proceed.
         */
        var checkShouldRefresh = function(e, isInView) {

            if ( isInView ) {
                console.log( 'Attempting Data Fetch...' );
                refreshPosts();
            }
        };

        refreshPosts();

        $( ajaxLoadingDiv ).bind( 'inview', checkShouldRefresh );
    }
})(jQuery);

/**
 * Load the front page content using ajax, this script should only be used
 * on the front page but is not relegated to that instance...
 */
jQuery(document).ready(function( $ ) {
    $( '*[ajax-load-posts]' ).each(function() {
        $( this ).ajaxLoadPosts( JSON.parse( $( this ).attr( 'ajax-load-posts' ) ) );
    });
});
