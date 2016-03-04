jQuery(document).ready(function($) {
    var state = false;

    var toggleState = function() {
        state = ! state;

        if ( state ) {
            $( 'body' ).addClass( 'search-visible' );
            $( '#searchform .search-field' ).focus();
        } else {
            $( '#searchform .search-field' ).val('');
            $('#searchform .search-results').empty();
            $( 'body' ).removeClass( 'search-visible' );
        }
    };

    // Allows the toggle to do some toggling.
    $( '#search-toggle' ).on( 'click', toggleState );

    // Also on search exit button click...
    $( '#search-exit' ).on( 'click', toggleState );

    // Submit searchform on input enter.
    $( '#searchform .search-field' ).keydown(function (e) {
        if ( e.which == 13 ) {
            $('#searchform').submit();
            return false; // Ensure default is prevented.
        }

        // Load some posts form the field.
        var searchQuery = $(this).val();

        $.ajax({
    		url: ajaxinfo.url,
    		type: 'post',
    		data: {
    			action: 'ajax_post_loading',
                postFormat: 'search',
                skipTo: 0,
                postNumber: 100,
                queryParams: { s: searchQuery }
    		},
    		success: function( result ) {
                $('#searchform .search-results').html( result );
    		},
            error: function( error ) {
                console.log( 'Data Fetch failed' + error );
            }
    	});
    });

});
