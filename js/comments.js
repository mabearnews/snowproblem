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


    // Create the mechanics of moving the comment reply area, this should be
    // done by wordpress but this will override that functionality in return
    // for more accurate procedings.
    $( '#comments-container a.comment-reply-link' ).click(function(e) {
        // Find the comment container to attach the form to.
        var comment = $( this ).parents('article.comment');

        var parentId = comment.attr('id').match(/\D+-(.\d+)/)[1];

        // Add the form to the selected element.
        comment.after( $( '#respond' ).detach() );

        // Alter the form with the parent id.
        $( '#comment_parent' ).val( parentId );

        // Allow for the cancel reply link to be seen.
        $( '#cancel-comment-reply-link' ).css('display', 'inline-block');

        // Ensures the event will not propogate to following the link.
        return false;
    });

    // Allows the return of the respond comment option to its default state.
    $( '#cancel-comment-reply-link' ).click(function() {
        // Hide this link.
        $( this ).css('display', 'none');

        // Put the reply link back in its place!
        $( '#comments-container .comment-list' ).after( $( '#respond' ).detach() );

        return false;
    });
});

var addComment = {}; // This function has been decaprecated.
