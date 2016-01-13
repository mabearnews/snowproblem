/**
 * Specifies all the colors used on the website, this must be kept in sync with
 * sass/utils/_variables.scss
 *
 * Colors are given in standard rgb format. There are methods to get a random
 * color,
 */
var Colors = {
    /// An array of all colors in the object. This is used as the primary
    /// lokup table for ites and should be syncd in accordance with sass
    /// colors.
    all: {
        'white': 'rgb(255, 255, 255)',

        'lightgrey': 'rgb(189, 195, 199)',
        'grey': 'rgb(149, 165, 166)',
        'darkgrey': 'rgb(127, 140, 141)',

        'lightyellow': 'rgb(241, 196, 15)',
        'yellow': 'rgb(241, 196, 15)',
        'darkyellow': 'rgb(241, 196, 15)',

        'lightorange': 'rgb(243, 156, 18)',
        'orange': 'rgb(230, 126, 34)',
        'darkorange': 'rgb(211, 84, 0)',

        'lightblue': 'rgb(26, 188, 156)',
        'blue': 'rgb(52, 152, 219)',
        'darkblue': 'rgb(41, 128, 185)',

        'lightred': 'rgb(231, 76, 60)',
        'red': 'rgb(231, 76, 60)',
        'darkred': 'rgb(192, 57, 43)',

        'lightpurple': 'rgb(155, 89, 182)',
        'purple': 'rgb(155, 89, 182)',
        'darkpurple': 'rgb(142, 68, 173)',

        'lightgreen': 'rgb(46, 204, 113)',
        'green': 'rgb(39, 174, 96)',
        'darkgreen': 'rgb(22, 160, 133)',

        'black': 'rgb(0, 0, 0)',
    },

    /// An array of all colors that have not yet been returned.
    usedColors: [],

    /**
     * Returned the given color for the key provided or undefined.
     *
     * @param string color
     *
     * @return string
     */
    get: function(color) {
        return this.all[color];
    },

    /**
     * Returns the next color in an array of random colors that is setup by
     * the used colors array.
     *
     * @return string
     */
    next: function() {
        if ( this.usedColors.length <= 0 ) {
            this.usedColors = Object.keys(this.all).sort(function() {
                return 0.5 - Math.random();
            });

            console.log('reset');
        }

        console.log(this.usedColors);

        return this.all[this.usedColors.pop()];
    }
};

module.exports = Colors;
