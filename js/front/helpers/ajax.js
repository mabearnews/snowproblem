// Assume jquery is loaded.

// ajaxinfo is an array of information concerning js provided by php.

var Ajax = {
    /**
     * Perforns an ajax query to inc/ajax-loading.php. This wil return a json
     * object for the post as teh result and is largelly used for data retension
     * on the side of react.js front page.
     */
    query: function(data, callback) {

        // Further manipulate the additional data, as it is the data that will
        // be sent with the post request.
        data['action'] = 'ajax_data_get';

        jQuery.post(ajaxinfo.url, data, callback, 'json');
    }
};

module.exports = Ajax;
