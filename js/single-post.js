/**
 * If a single page post, then effect various changes to the functionality it
 * entails.
 */
jQuery(document).ready(function($) {

if ( $( 'body' ).hasClass( 'single' ) ) {

/**
 * Add in support for the featured image change in size based off of the
 * evaluation of that image to change that value.
 */
if ( $( '.featured-image' ).length ) {
    var fi = $( '.featured-image' ).first();

    var url = fi.attr( 'image-url' );

    if ( url ) {

        // Create the image to figure out the size.
        var img = new Image();
        img.src = url;

        img.onload = function() {
        // Change the height of the Featured Image...
        if ( this.width && this.height ) {
            fi.css( 'height', this.width / this.height * 100   + 'vw' );
        }
        };
    }
}



}

});
