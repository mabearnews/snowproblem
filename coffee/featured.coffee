###
Featured is a section, primarily displayed on the home page that is also
primarily used to show important posts. In addition to supporting showing these
posts featured show's their images. The purpose of this file is to change the
featured image and thus allow for a more concrete navigation.
###


# Constants
featuredImageSelector  = "#featured-image"
imageContainerSelector = ".post-featured-image"
postSelector           = "#featured .post"

selectedClass = "selected"

( ( $ ) ->

    $( document ).ready ->
        # Document has loaded.

        $( postSelector ).on 'mouseover', (e) ->
            id = $( @ ).attr 'id'
            $featuredContent = $("#featured-image .post-featured-image[data-post-id=#{id}]")

            # Remove all previously 'selected' elements
            $( ".#{selectedClass}" ).each -> $( @ ).removeClass selectedClass

            $featuredContent.addClass selectedClass
            $( @ ).addClass selectedClass


        # Dissallow hyperlinks of non selected elements.
        $( "#featured-image .post-featured-image:not(.selected) a" ).click (e) ->
            e.preventDefault();
            alert 'hello'


        # Set the images in order and inside the feaeturedImageSelector
        $( postSelector ).each ->
            $( featuredImageSelector ).append $( @ ).find( imageContainerSelector ).clone()

        # Set the first image to display.
        $( postSelector ).first().mouseover()



) jQuery
