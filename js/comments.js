jQuery(document).ready(function($) {
    var commentsVisible = false;

    var toggle = function() {
        commentsVisible = ! commentsVisible;

        if ( commentsVisible ) {
            $( 'body' ).addClass('comments-visible');
        } else {
            $( 'body' ).removeClass('comments-visible');
        }
    }

    $( '.comments-toggle' ).click(toggle);
    $( '#comments-close' ).click(toggle);
});
