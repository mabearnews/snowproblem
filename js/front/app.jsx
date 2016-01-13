var React    = require('react');
var ReactDOM = require('react-dom');

var Featured = require('./components/featured.jsx');

var App = React.createClass({
    render: function() {
        var categories = [
            {name: 'This Post', href: 'www.apple.com'},
            {name: 'Another Post', href: ''},
        ];

        return (
            <section id="featured-container">
                <div className="top-block split-vertical">
                    <div className="split-horizontal">
                        <Featured title="A Featured Post" categories={categories} />
                        <Featured title="A Featured Post" categories={categories} />
                    </div>
                    <Featured title="A Featured Post" categories={categories} />
                </div>
                <div className="top-block">
                    <Featured title="A Featured Post" categories={categories} />
                </div>
                <div className="top-block split-vertical">
                    <Featured title="A Featured Post" categories={categories} />
                    <div className="split-horizontal">
                        <Featured title="A Featured Post" categories={categories} />
                        <Featured title="A Featured Post" categories={categories} />
                    </div>
                </div>

            </section>
        );
    }
});

ReactDOM.render(<App />, document.getElementById('react-container'));
