var React = require('react');

var Category = require('./category.jsx');

var NewsCard = React.createClass({
    getDefaultProps: function() {
        return {
            background: '',
            categories: '',
            title: '',
            href: '',
            excerpt: '',
            postDate: '',
            author: '',
            authorLink: ''
        };
    },

    getInitialState: function() {
        return {
            postDate: {}
        };
    },

    componentDidMount: function() {
        var monthNames = [ "Jan", "Feb", "Mar", "Apr", "May", "Jun",
                          "Jul", "Aug", "Sep", "Oct", "Nov", "Dec" ];

        var date = this.props.postDate;

        console.log(date);
        console.log(monthNames[parseInt(date.substring(5, 7), 10)]);

        var postDate = {
            month: monthNames[ parseInt(date.substring(5, 7), 10) - 1 ],
            year: parseInt(date.substring(0, 4), 10),
            day: parseInt(date.substring(6, 8), 10)
        };

        this.setState({
            postDate: postDate
        });
    },

    render: function() {
        var imageContainer = '';

        if (this.props.background) {

            imageContainer = (
                <section className="entry-image-placeholder">

                </section>
            );

        }

        return (
            <article className="newscard" style={{backgroundImage: 'url(' + this.props.background + ')'}}>

                {imageContainer}

                <div className="post-date">
                    <span className="month">{this.state.postDate.month}</span>
                    <span className="day">{this.state.postDate.day}</span>
                    <span className="year">{this.state.postDate.year}</span>
                </div>

                <div className="post">

                    <section className="categories">
                        {this.props.categories.map(function(cat) {
                            return <Category href={cat.href} key={cat.name} name={cat.name} />;
                        })}
                    </section>

                    <header>
                        <a href={this.props.href}>
                            {this.props.title}
                        </a>
                    </header>

                    <section className="post-content">

                        <p>{this.props.excerpt}</p>

                    </section>

                    <footer>
                        <a className="author-name" href={this.props.authorLink}>
                            {this.props.author}
                        </a>
                    </footer>

                </div>
            </article>
        );
    }

});

module.exports = NewsCard;
