var React = require('react');
var Ajax = require('../helpers/ajax.js');
var NewsCard = require('./newscard.jsx');

var RecentPosts = React.createClass({
    getInitialState: function() {
        return {
            posts: []
        };
    },

    componentDidMount: function() {
        Ajax.query({
            orderby: 'date',
            order: 'DESC',
            post_number: 4,
            what: {
                'get_the_author': 'author',
                'get_author_posts_url': 'authorLink',
                'featured_image': 'background',
                'get_permalink': 'href',
                'categories': 'categories',
                'post_title': 'title',
                'get_the_excerpt': 'excerpt',
                'post_date': 'postDate',
            }
        }, function(posts) {
            console.log(posts);

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
            <section id="recent-posts" className="snowgrid">
                {posts.map(function(post) {
                    return <NewsCard {...post} key={post.title} />
                })}
            </section>
        );
    }
});

module.exports = RecentPosts;
