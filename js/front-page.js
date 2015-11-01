jQuery(document).ready(function($) {
    $( '#recent-posts' ).data( 'ajax-load-posts-done', function() {
        this.snowgridRefresh();
        this.find( '.ajax-loading' ).first().css({
            position: 'absolute',
            bottom: '0'
        });
    } );
});
