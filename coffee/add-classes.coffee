# Adds the given classes upon the selector event.
# If the toggle is set to true, the second click of that object will remove the
# class.
classes =
    clicked:
        selector: 'click'
        toggle: true

scrollSelectorArray = [
    "table"
    ".home article.post"
    ".draw-text"
    ".add-animated"
    ".toggle-animated"
    ".entry-header"
    "#comments .comment"
]

scrollSelectorArray.map (e) -> "#{e}:not(.animated)"
scrollSelectors = scrollSelectorArray.join ', '

(($) ->
    $ ->
        # adds in all the classes on jQuery selectors.
        for classname, attrs of classes
            $( ".toggle-#{classname}, .recieves-toggles, nav#site-navigation .menu li" ).on attrs.selector, (event) ->
                # Checks if the selector needs to propogate as usual.
                if $(this).hasClass 'container'
                    return true

                # Stops the event from propograting up.
                event.stopPropagation();

                $t  = $ this

                if $t.data 'toggled'
                    $t.data 'toggled', false if attrs.toggle
                    $t.removeClass classname
                else
                    # Remove click if clicked on anything else other than this.
                    $(".#{classname}").each ->
                        $(this).removeClass classname

                    $t.data 'toggled', true if attrs.toggle
                    $t.addClass classname

        # Add in a plugin to temporarily set the state to clicked
        $.fn.cssClick = (value = true) ->
            $t = this
            $t.data 'toggled', value

            if value
                $t.addClass 'clicked' unless $t.hasClass 'clicked'
            else
                $t.removeClass 'clicked' if $t.hasClass 'clicked'

        # Adds in .animated class when item becomes visisble by scrolling.'
        addAnimatedClasses = ->
            $page = $ '#page'

            win_height_padded = $(window).height() * 0.9

            $(scrollSelectors).each ->
                $t     = $ this
                offsetTop = $t.offset().top

                if offsetTop < win_height_padded
                   $t.addClass 'animated' unless $t.hasClass 'animated'

        $( '#page' ).scroll addAnimatedClasses
        $( window ).resize addAnimatedClasses

        # Inits the page scroll for primary elements.
        addAnimatedClasses()
) jQuery
