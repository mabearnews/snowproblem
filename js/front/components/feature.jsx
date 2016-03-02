var React = require('react');

var Colors   = require('../helpers/colors.js');
var Category = require('./category.jsx');

var Feature = React.createClass({
    getInitialState: function() {
        return {
            color: Colors.next()
        };
    },

    getDefaultProps: function() {
        return {
            categories: [],
            title: '',
            href: ''
        }
    },

    render: function() {
        var styles = {};

        if ( this.props.background ) {
            styles = { backgroundImage: 'url(' + this.props.background + ')' };
        } else {
            styles = { background: this.state.color };
        }

        return (
            <div className="featured-post-contianer">
                <a href={this.props.href}>
                    <article style={styles} className="featured-post">

                        <div className="title">
                            <span>{this.props.title}</span>
                        </div>

                    </article>
                </a>
            </div>
        );
    }
});

module.exports = Feature;
