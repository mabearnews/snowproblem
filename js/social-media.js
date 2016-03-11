jQuery(document).ready(function($) {
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


    var socialShare = $('#social-share');

    var offsetInitial = socialShare.offset().top - $( '.post-content' ).offset().top;

    /**
     * Adjusts the height of the social share based off of its position in
     * the scroll heirarchy.
     */
    var adjustSocialShare = function() {
        var o = $('.post-content').offset().top;
        var s = $(this).scrollTop();

        var d =  o < 0 ? -o + offsetInitial : offsetInitial;

        var maxDist = $( '.post-content' ).height() - offsetInitial * 2;

        if ( d > maxDist ) d = maxDist;

        socialShare.css('top', d + 'px');
    };

    $('#page').scroll(adjustSocialShare);
});
