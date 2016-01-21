var React    = require('react');
var ReactDOM = require('react-dom');

var Featured = require('./components/featured.jsx');

var App = React.createClass({
    render: function() {
        return (
            <Featured />
        );
    }
});

ReactDOM.render(<App />, document.getElementById('react-container'));
