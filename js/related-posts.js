jQuery(document).ready(function($) {
    function removeStyles(el) {
        if ( el.className == 'yuzo-img' ) {
            var imageUrl = (function(style) {
                var matches = style.match(/background(?:\-image)?\s*:url\('(.+)-\d+x\d+\.(.+)'\)/);

                if ( matches && matches.length > 1 ) {
                    return matches[1] + '.' + matches[2]
                }
                return '';
            })($(el).attr('style'));

            if ( imageUrl ) {
                $(el).attr('style', 'background-image: url('+imageUrl+')' );
            }
        } else {
            el.removeAttribute('style');
        }

        if(el.childNodes.length > 0) {
            for(var child in el.childNodes) {
                /* filter element nodes only */
                if(el.childNodes[child].nodeType == 1)
                    removeStyles(el.childNodes[child]);
            }
        }
    }

    if ( $('.yuzo_related_post').length ) {
        // Remove all other styling for this bloody yuzu posts.
        $( '.yuzo_related_post style' ).remove();

        // On resize, yuzo does some stuff, cause its evil, so remove styles.
        $( '.yuzo_related_post' ).unbind('equalizer');
        $( '.yuzo_related_post .yuzo_wraps' ).unbind('equalizer');

        // Remove all styles from yuzu related posts.
        removeStyles($('.yuzo_related_post')[0]);

        // Change the title from 'Related Post' -- Grammer much?
        $( '.yuzo_related_post .yuzo__title' ).text('Related Posts');
    }

});
