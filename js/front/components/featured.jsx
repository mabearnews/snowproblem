var React = require('react');

var Ajax     = require('../helpers/ajax.js');
var Feature  = require('./feature.jsx');

var Featured = React.createClass({
    getInitialState: function() {
        return {
            posts: []
        };
    },

    componentDidMount: function() {
        Ajax.query({
            category_name: 'featured',
            orderby: 'date',
            order: 'DESC',
            post_number: 5,
            what: {
                'categories': 'categories',
                'post_title': 'title',
                'get_permalink': 'href',
                'featured_image': 'background'
            }
        }, function(posts) {

            if (this.isMounted()) {
                this.setState({
                  posts: posts
                });
            }

        }.bind(this));
    },

    render: function() {
        var posts = this.state.posts;

        return (
            <section id="featured-container">

                <div className="top-block split-vertical">

                    <Feature {...posts[1]} />
                    <Feature {...posts[3]} />

                </div>
                <div className="top-block">

                    <Feature {...posts[0]} />

                </div>
                <div className="top-block split-vertical">

                    <Feature {...posts[2]} />
                    <Feature {...posts[4]} />

                </div>

            </section>
        );
    }
});

module.exports = Featured;
