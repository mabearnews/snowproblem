var React = require('react');

var Colors   = require('../helpers/colors.js');
var Category = require('./category.jsx');

var Featured = React.createClass({
    render: function() {
        var categories = this.props.categories;

        var styles = {};

        if ( this.props.background ) {
            styles = { backgroundImage: 'url(' + this.props.background + ')' };
        } else {
            styles = { background: Colors.next() };
        }

        return (
            <article style={styles} className="featured-post">

                <header>
                    <h1>{this.props.title}</h1>
                </header>

                <div className="categories">
                    {categories.map(function(cat) {
                      return <Category href={cat.href} key={cat.name} name={cat.name} />;
                    })}
                </div>

            </article>
        );
    }
});

module.exports = Featured;
