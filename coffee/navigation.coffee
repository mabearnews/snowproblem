( ($) ->
    $ ->
        # The dom is loaded

        # Adds in some basic styling to make the nested navigation possible.
        nestedNavFunctionality = () ->
            # Adds given functionality to the children.
            $('#site-navigation-more a').on 'click', (e) ->
                $t = $ this
                if $t.siblings( 'ul' ).length
                    $t.parent().click()
                    return false

            $('#site-navigation-more li').on 'click', ->
                $t = $ this
                $p = $ '#site-navigation-more'

                $p.attr 'data-color', $t.index() % 10

                # Apply content to the navigation bar.
                $children = if $t.siblings('ul').length
                    $t.siblings 'ul'
                else
                    $t.children 'ul'

                $p.html ''
                $p.empty().append $children.clone()

                $currentPage = $('<section class="current-page"></section>').append $t.children('a:first').clone()

                $p.prepend $currentPage

                # Ensures transitions apply.
                setTimeout ->
                    $p.children( 'ul' ).addClass 'come-in'

                    nestedNavFunctionality()
                , 1

        # Simply makes the navigation bar visible, does not add content.
        toggleMoreNavVisible = ($t) ->
            $p = $ '#site-navigation-more'

            if $t.hasClass 'clicked'
                $p.addClass 'visible' unless $p.hasClass 'visible'
                $('#base-wrapper').addClass 'nav-visible'
                $( 'nav#site-navigation .menu-toggle' ).cssClick true
            else
                $p.removeClass 'visible' if $p.hasClass 'visible'
                $('#base-wrapper').removeClass 'nav-visible'
                $( 'nav#site-navigation .menu-toggle' ).cssClick false
                return


            # Add styling relative to this element to the #site-navigation
            $p.attr 'data-color', $t.index() % 10

        # Toggles hiding and showing more navigation.
        toggleMoreNav = (children = []) ->
            $t = $ this
            $p = $ '#site-navigation-more'

            toggleMoreNavVisible $t

            # Apply content to the navigation bar.
            $children = if $t.siblings('ul').length
                $t.siblings 'ul'
            else
                $t.children 'ul'

            $p.html ''
            $p.empty().append $children.clone()

            $currentPage = $('<section class="current-page"></section>').append $t.children('a:first').clone()

            $p.prepend $currentPage

            # Ensures transitions apply.
            setTimeout ->
                $p.children( 'ul' ).addClass 'come-in'

                nestedNavFunctionality()
            , 1

        # Add in the toggle for the burger menu.
        $( 'nav#site-navigation .menu-toggle' ).click ->
            $t = $ this
            $p = $ '#site-navigation-more'

            if $t.hasClass 'clicked' && $p.hasClass 'visible'
                $p.removeClass 'visible'
                $('#base-wrapper').removeClass 'nav-visible'
                return true

            toggleMoreNavVisible $t

            $elements = $ 'nav#site-navigation .menu > ul'

            $p.html ''
            $p.empty().append $elements.clone()

            # Ensures transitions apply.
            setTimeout ->
                $p.children( 'ul' ).addClass 'come-in'


                nestedNavFunctionality()
            , 1


        # Handels the showing and hiding of the extended navigation.
        $( 'nav#site-navigation li' ).on 'click', toggleMoreNav


        # Hides the navigation more view on outside click.
        $(document).on 'mouseup', (e) ->
            # Check if the clicked item is not already in conformity with
            # the hiding and displaying of the navigation bar.
            if $(e.target).is( 'nav#site-navigation *, #site-navigation-more, #site-navigation-more *' )
                return true


            $c = $ '#site-navigation-more'

            # if the target of the click isn't the container or a child.
            if !$c.is(e.target) && $c.has(e.target).length == 0
                $c.removeClass 'visible' if $c.hasClass 'visible'
                $('#base-wrapper').removeClass 'nav-visible'

                # Ensure proper toggling.
                $( 'nav#site-navigation li.clicked' ).each ->
                    $(this).click()

        # Prevent default hyperlinking behavior for the nav bar.
        $( 'nav#site-navigation a').on 'click', (e) ->
            $t = $ this
            if $t.siblings( 'ul' ).length
                # Allow the parent link to be followed.
                $t.parent().click()

                # Prevent the href to be followed.
                return false
            else
                # Continue as one would normally.

        # Add in elements to display the menu toggle button properly.
        createRow = (numElems) ->
            row = $ '<div class="row"></div>'

        if $( 'nav#site-navigation .menu-toggle .toggle' ).length
            $mt = $( 'nav#site-navigation .menu-toggle .toggle' )
            for _ in [0...3]
                $mt.append createRow(3)

        # Handels the navigation toggle for the sidebar.
        $('#sidebar-toggle').click ->

            if $('#base-wrapper').hasClass 'sidebar-display'
                $('#base-wrapper').removeClass 'sidebar-display'
                $('#sidebar').removeClass 'sidebar-display'
            else
                $('#base-wrapper').addClass 'sidebar-display'
                $('#sidebar').addClass 'sidebar-display'

        $(document).on 'mouseup', (e) ->
            if !$('#sidebar').is(e.target) && $('#sidebar').has(e.target).length == 0 && $('#sidebar').hasClass('sidebar-display')
                $('#sidebar-toggle').click()


) jQuery
