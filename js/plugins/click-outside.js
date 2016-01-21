(function($) {
    /**
     * Detects a click outside of the current element by stopping
     * propogration of clicks of current element and only listing to
     * outer clicks.
     */
    $.fn.clickOutside = function( callback ) {
        var stopClick = function( event ) {
            event.stopPropagation();
        };

        var outsideClick = function() {
            $('html').unbind('click', outsideClick);
            $(this).unbind('click', stopClick)
            callback.call(this);
        };

        $('html').bind('click', outsideClick);
        this.bind('click', stopClick);
    }
})(jQuery);
