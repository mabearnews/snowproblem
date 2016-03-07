jQuery(document).ready(function($) {
    // The class that will indicat the state of activeness of a given story.
    var ACTIVE_CLASS = 'active';

    // The information concerning the index and number of posts shown in top stories.
    var currentIndex = 0,
        container = $('#top-stories-container'),
        posts = $('#top-stories-container .post-popular'),
        numbPosts = posts.length,
        controlOptions = $('#top-stories-controller .option');

    // Will alter the display of the posts to the current.
    var showPost = function(postIndex) {
        $('.'+ACTIVE_CLASS).removeClass(ACTIVE_CLASS);
        $(posts[postIndex]).addClass(ACTIVE_CLASS);
        $(controlOptions[postIndex]).addClass(ACTIVE_CLASS);

        container.removeClass(function (index, css) {
            return (css.match (/(^|\s)active-\S+/g) || []).join(' ');
        });
        container.addClass(ACTIVE_CLASS + '-' + postIndex);
    };

    // Creates / resets the interval which is used to autorotate informations.
    var interval;
    var resetInterval = function() {
        clearInterval(interval);

        interval = setInterval(function () {
            currentIndex = currentIndex + 1 >= numbPosts ? 0 : currentIndex + 1;
            showPost(currentIndex);
        }, 12000);
    }
    resetInterval();
    showPost(0);

    $('#top-stories-controller .option').on('click', function() {
        showPost($(this).index());
        resetInterval();
    });

    $( '#top-stories-arrows .left' ).on('click', function() {
        currentIndex = currentIndex - 1 < 0 ? numbPosts : currentIndex - 1;
        showPost(currentIndex);
        resetInterval();
    });

    $( '#top-stories-arrows .right' ).on('click', function() {
        currentIndex = currentIndex + 1 >= numbPosts ? 0 : currentIndex + 1;
        showPost(currentIndex);
        resetInterval();
    });
});
