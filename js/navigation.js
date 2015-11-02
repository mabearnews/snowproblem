/**
 * The locally scoped jQuery element used for the manipulation of sate of
 * the navigation bar element.
 *
 * Ocotober 26, 2015 - Sequoia Snow
 */
var PrimaryNav = {};

(function( $ ) {

/**
 * Toggle the state of the expanded navigation, To open and close.
 */
PrimaryNav.toggleState = function( newState ) {
    this.state = ( typeof newState === 'undefined' ) ? ! this.state : newState;

    // Change the classes of the object.
    if ( this.state ) {
        this.elems.moreNav.addClass( this.props.visibleClass );
        this.elems.base.addClass( this.props.visibleClass );
    } else {
        this.elems.moreNav.removeClass( this.props.visibleClass );
        this.elems.base.removeClass( this.props.visibleClass );

        // Add in the finnal class for the removal of the more navigation bar.
        this.elems.base.addClass( this.props.visibleEndingClass );

        var ts = $( '#page' ).css( 'transition-duration' );
        ts = ts.substring(0, ts.length - 1);
        setTimeout( function() {
            this.elems.base.removeClass( this.props.visibleEndingClass );
        }.bind( this ), 1.4 * ts * 1000 );

    }
};

/**
 * Listen for outside clicks and destory the state of opened.
 */
PrimaryNav.allowDestroy = function() {
    var destroyFunc = function( e ) {
        var container = this.elems.moreNav;
        var nav = this.elems.primaryMenu;

        if ( ! container.is( e.target ) && container.has( e.target ).length === 0 &&
             ! nav.is( e.target ) && nav.is( e.target ) === 0 ) {
            this.toggleState( false );
        }

        $( document ).unbind( 'mouseup', destroyFunc );
    }.bind( this );

    $( document ).bind( 'mouseup', destroyFunc );
};

/**
 * Returns the submenu from a link.
 */
PrimaryNav.getLinkSubmenu = function( n ) {
    // Ensure n is jQuery.
    if ( typeof n !== 'jQuery' ) { n = $( n ) };


    if ( n.siblings( 'ul' ).length ) {
        return n.siblings( 'ul' ).first();
    } else if ( n.children( 'ul' ).length ) {
        return n.children( 'ul' ).first();
    } else {
        return false;
    }
};

/**
 * Malforms all of the links that would be bound to submenues.
 */
PrimaryNav.malformLinks = function() {
    var t = this;

    // Set an array to store the malformed links.
    this.props.malformedLinks = [];

    this.elems.navLinks.each(function() {
        // Check if has submenu...
        if ( ! t.getLinkSubmenu( this ) ) {
            // Does not have a submenu...
            return this;
        }

        // Check if has links...
        if ( $( this ).find( 'a' ).length ) {

            var link = $( this ).find( 'a' ).first();

            $.data( this, 'href', $( link ).attr( 'href' ) );

            link.removeAttr( 'href' );
        }

        // Save the link data for the element
        t.props.malformedLinks.push( $( this ) );
    });
}

/**
 * Toggle the content of the more nav.
 */
PrimaryNav.changeContent = function( content ) {

    console.log( content );

    this.elems.moreNav.empty();

    // Create a content wrapper.
    var w = $( '<div></div>', { class: 'more-nav-wrapper' } );

    w.append( content.clone() );
    this.elems.moreNav.append( w );
};

/**
 * Toggles the complete navigation bar events.
 */
PrimaryNav.showMore = function( data ) {
    this.toggleState( true );
    this.changeContent( data );
    this.allowDestroy( true );
};

/**
 * Initialize the primary navigation.
 */
PrimaryNav.init = function( elems ) {
    this.props = {};
    this.elems = elems;
    this.state = false;

    this.malformLinks();
}

PrimaryNav.addListeners = function() {
    var t = this;

    this.elems.navLinks.each(function() {
        $( this ).click(function() { t.showMore( t.getLinkSubmenu( this ) ); });
    });

    // Create the nav toggle event based rotation...
    this.elems.navToggle.click(function() {
        t.toggleState();

        if ( t.state === true ) {
            t.changeContent( t.elems.primaryMenu.children( 'ul' ).first().clone() );
            t.allowDestroy( true );
        }
    });
};

})( jQuery );



jQuery( document ).ready(function( $ ) {
    PrimaryNav.init({
        moreNav: $( '#site-navigation-more' ).first(),
        primaryMenu: $( '#primary-menu' ),
        navLinks: $( '#primary-menu ul > li' ),
        navToggle: $( '#menu-toggle' ),
        base: $( 'body' )
    });

    PrimaryNav.props.visibleClass = 'nav-visible';
    PrimaryNav.props.visibleEndingClass = 'nav-ending-visible';

    // Setup complete, add initiation.
    PrimaryNav.addListeners();
});