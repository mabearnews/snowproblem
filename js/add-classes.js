// Generated by CoffeeScript 1.9.3
(function() {
  var classes, scrollSelectorArray, scrollSelectors;

  classes = {
    clicked: {
      selector: 'click',
      toggle: true
    }
  };

  scrollSelectorArray = ["table", ".home article.post", ".draw-text", ".add-animated", ".toggle-animated", ".entry-header"];

  scrollSelectorArray.map(function(e) {
    return e + ":not(.animated)";
  });

  scrollSelectors = scrollSelectorArray.join(', ');

  (function($) {
    return $(function() {
      var addAnimatedClasses, attrs, classname;
      for (classname in classes) {
        attrs = classes[classname];
        $(".toggle-" + classname + ", .recieves-toggles, nav#site-navigation .menu li").on(attrs.selector, function(event) {
          var $t;
          if ($(this).hasClass('container')) {
            return true;
          }
          event.stopPropagation();
          $t = $(this);
          if ($t.data('toggled')) {
            if (attrs.toggle) {
              $t.data('toggled', false);
            }
            return $t.removeClass(classname);
          } else {
            $("." + classname).each(function() {
              return $(this).removeClass(classname);
            });
            if (attrs.toggle) {
              $t.data('toggled', true);
            }
            return $t.addClass(classname);
          }
        });
      }
      $.fn.cssClick = function(value) {
        var $t;
        if (value == null) {
          value = true;
        }
        $t = this;
        $t.data('toggled', value);
        if (value) {
          if (!$t.hasClass('clicked')) {
            return $t.addClass('clicked');
          }
        } else {
          if ($t.hasClass('clicked')) {
            return $t.removeClass('clicked');
          }
        }
      };
      addAnimatedClasses = function() {
        var $page, win_height_padded;
        $page = $('#page');
        win_height_padded = $(window).height() * 0.9;
        return $(scrollSelectors).each(function() {
          var $t, offsetTop;
          $t = $(this);
          offsetTop = $t.offset().top;
          if (offsetTop < win_height_padded) {
            if (!$t.hasClass('animated')) {
              return $t.addClass('animated');
            }
          }
        });
      };
      $('#page').scroll(addAnimatedClasses);
      $(window).resize(addAnimatedClasses);
      return addAnimatedClasses();
    });
  })(jQuery);

}).call(this);