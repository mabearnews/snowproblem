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
            postFormat: 'search',
            scrollContainer: $( '#page' ),
            posts_per_page: 10
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


        var t = this;

        var numberReceived = 0;

        var refreshPosts = function() {
            var queryParams = _.clone( s );

            delete queryParams.postFormat;
            delete queryParams.scrollContainer;


            $.ajax({
        		url: ajaxinfo.url,
        		type: 'post',
        		data: {
        			action: 'ajax_post_loading',
                    postFormat: s.postFormat,
                    skipTo: numberReceived,
                    queryParams: queryParams
        		},
        		success: function( result ) {

                    // Check if the response is actually valid
                    if ( ! result.length ) {
                        $( s.scrollContainer ).unbind( 'scroll', checkShouldRefresh );
                    }

                    t.find('.ajax-loading').first().before( $( result ) );

                    numberReceived += s.posts_per_page;

                    // Call loaded callback, if available.
                    loaded.call( t );
        		}
        	});
        };

        /**
         * Ensures that the ajax loading should indeed proceed.
         */
        var checkShouldRefresh = function() {
            if ( $( this ).scrollTop() + $( this ).innerHeight() >= this.scrollHeight ) {
                // End reached...
                refreshPosts();
            }
        };

        refreshPosts();

        $( s.scrollContainer ).bind( 'scroll', checkShouldRefresh );
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
