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
            <article style={styles} className="featured-post">

                <header>
                    <a href={this.props.href}>{this.props.title}</a>
                </header>

                <div className="categories">
                    {this.props.categories.map(function(cat) {
                      return <Category href={cat.url} key={cat.name} name={cat.name} />;
                    })}
                </div>

            </article>
        );
    }
});

module.exports = Feature;
