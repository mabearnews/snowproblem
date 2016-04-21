jQuery(document).ready(function($) {
    // Ensure the social share functionality exists.
    if ( ! $( '#social-share' ).length ) {
        return;
    }

    // Ensure that this is a standard post that requires this functionality.
    if ( ! $( 'body.single-format-standard ' ).length ) {
        return;
    }

    /**
     * Ensures windows open as popups to share a story.
     *
     * This uses the window.open method to override default link behavior.
     */
    $('#social-share a').click(function() {
        newwindow=window.open( $(this).attr('href'), 'name', 'height=450,width=750');
        if ( window.focus ) { newwindow.focus() }
        return false;
    });


    var socialShare   = $('#social-share');
    var postHeight    = $( '.post-content' ).height();
    var offsetInitial = socialShare.offset().top - $( '.post-content' ).offset().top;
    var initialLeft   = socialShare.css('left');
    var socialHeight  = socialShare.height();

    /**
     * Adjusts the height of the social share based off of its position in
     * the scroll heirarchy.
     */
    var adjustSocialShare = function() {
        var o = $('.post-content').offset().top;
        var s = $(this).scrollTop();

        // if ( s > postHeight - socialHeight - offsetInitial ) {
        //     return socialShare.css({
        //         'top': ( postHeight - socialHeight - offsetInitial ) + 'px',
        //         'left': initialLeft,
        //         'position': 'absolute'
        //     });
        // }

        if ( o < 0 ) {
            return socialShare.css({
                'top': offsetInitial + 'px',
                'position': 'fixed',
                left: $('#site-navigation > .wrapper').offset().left + 'px'
            });
        }

        return socialShare.css({
            'top': offsetInitial + 'px',
            'position': 'absolute',
            'left': initialLeft
        });

    };

    $('#page').scroll(adjustSocialShare);
});
