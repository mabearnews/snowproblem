(function( $ ) {
    /**
     * jQuery plugin to implement default ajax loading for the appending of
     * ajax loaded content to a given container.
     *
     * October 28, 2015 Sequoia Snow
     */
    $.fn.ajaxLoadPosts = function( params, loaded ) {
        var paramsIsString = false;

        // Check if params are a function.
        if ( typeof params === 'undefined' ) {
            var attrVal = this.attr( 'ajax-load-posts' );

            if ( attrVal.charAt(0) == '[' || attrVal.charAt(0) == '{' ) {
                params = JSON.parse( attrVal );
            } else {
                params = attrVal;
                paramsIsString = true;
            }
        }

        // Check if loaded is a function.
        if ( typeof loaded === 'undefined' ) {
            if ( this.data( 'ajax-load-posts-done' ) ) {
                loaded = this.data( 'ajax-load-posts-done' );
            } else {
                loaded = function() {};
            }

        }


        var s = {
            scrollContainer: $( '#page' ),
            postNumber: 10,
            excludeIDS: [],
        };

        if ( ! paramsIsString ) {
            s = _.extend( s, params );
        }

        // Create a loading animations
        this.append($(
            '<div class="ajax-loading column">'+
                '<div class="letters">'+
                    '<span class="letter">L</span>'+
                    '<span class="letter">O</span>'+
                    '<span class="letter">A</span>'+
                    '<span class="letter">D</span>'+
                    '<span class="letter">I</span>'+
                    '<span class="letter">N</span>'+
                    '<span class="letter">G</span>'+
                '</div>'+
            '</div>'
        ));

        var ajaxLoadingDiv = this.find('.ajax-loading').first();

        var t = this;

        var numberReceived = 0;

        var refreshPosts = function() {
            console.log( 'Fetching more data' );

            var queryParams;

            if ( paramsIsString ) {
                queryParams = params;
            } else {
                queryParams = _.clone( s );

                delete queryParams.postFormat;
                delete queryParams.scrollContainer;
                delete queryParams.postNumber;
                delete queryParams.excludeIDS;
            }

            $.ajax({
        		url: ajaxinfo.url,
        		type: 'post',
        		data: {
        			action: 'ajax_post_loading',
                    postFormat: s.postFormat,
                    skipTo: numberReceived,
                    postNumber: s.postNumber,
                    queryParams: queryParams,
                    excludeIDS: s.excludeIDS
        		},
        		success: function( result ) {
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
                    ajaxLoadingDiv.removeClass( 'inview' );

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
                $( this ).addClass( 'inview' );

                console.log( 'Attempting Data Fetch...' );
                refreshPosts();
            }
        };

        $( ajaxLoadingDiv ).bind( 'inview', checkShouldRefresh );
    }
})(jQuery);

/**
 * Load the front page content using ajax, this script should only be used
 * on the front page but is not relegated to that instance...
 */
jQuery(document).ready(function( $ ) {
    $( '*[ajax-load-posts]' ).each(function() {
        $( this ).ajaxLoadPosts();
    });
});
