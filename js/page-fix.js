jQuery(document).ready(function($) {
    // If the body has they type of a page, add some classes to make it appear
    // an image style post.
    if ( $('body.page').length ) {
        // Change the className of the actual page as well anywhere it may be
        // needed
        $('.page').addClass('post').removeClass('page');

        // Add the format image to the featured image.
        $('.type-page').removeClass('type-page').addClass('type-post').addClass('format-image');

        // Finnaly add the necessary classes to the body for an image post.
        $('body').addClass('single-format-image').addClass('single');
    }
});
