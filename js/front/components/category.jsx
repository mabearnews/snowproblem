var React = require('react');

var Category = React.createClass({
    render: function() {
        return (
            <div className="category">
                <a href={this.props.href}>{this.props.name}</a>
            </div>
        );
    }
});

module.exports = Category;
