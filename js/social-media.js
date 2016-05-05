jQuery(document).ready(function($) {
    // Ensure the social share functionality exists.
    if ( ! $( '#social-share' ).length ) {
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

    // Ensure that this is a standard post that requires this functionality.
    if ( ! $( 'body.single-format-standard ' ).length ) {
        return;
    }

    var socialShare   = $('#social-share');
    var centerElement = $('#main .center-element');
    var page          = $('#page');
    var postContent   = $('.post-content');
    var postHeight    = $('.post-content').height();

    socialShare.css({
        position: 'absolute',
        left: '10px'
    });

    /**
     * Adjusts the height of the social share based off of its position in
     * the scroll heirarchy.
     */
    var adjustSocialShare = function() {
        var o = postContent.offset().top;
        var s = $(this).scrollTop();

        if ( o < 0 ) {
            var left = ( (page.width() - centerElement.width()) / 2 );
            if ( left < 0 ) left = 10; // for padding

            return socialShare.css({
                position: 'fixed',
                left: left + '10px'
            });
        }''

        return socialShare.css({
            position: 'absolute',
            left: '10px'
        });

    };

    $('#page').scroll(adjustSocialShare);
});
