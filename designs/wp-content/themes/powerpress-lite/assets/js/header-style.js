/* Start Menu */
(function ($) {
    $.fn.menumaker = function (options) {
        var cssmenu = jQuery(this),
            settings = jQuery.extend({
                title: "",
                format: "dropdown",
                sticky: false
            }, options);
        return this.each(function () {
            cssmenu.prepend('<div id="menu-button">' + settings.title + '</div>');
            jQuery(this).find("#menu-button").on('click', function () {
                jQuery(this).toggleClass('menu-opened');
                var mainmenu = jQuery(this).next('ul');
                if (mainmenu.hasClass('open')) {
                    mainmenu.removeClass('open');
                } else {
                    mainmenu.addClass('open');
                    if (settings.format === "dropdown") {
                        mainmenu.find('ul').show();
                    }
                }
            });
            cssmenu.find('li ul').parent().addClass('has-sub');
            multiTg = function () {
                cssmenu.find(".has-sub").prepend('<span class="submenu-button"></span>');
                cssmenu.find('.submenu-button').on('click', function () {
                    jQuery(this).toggleClass('submenu-opened');
                    if (jQuery(this).siblings('ul').hasClass('open')) {
                        jQuery(this).siblings('ul').removeClass('open').hide();
                    } else {
                        jQuery(this).siblings('ul').addClass('open').show();
                    }
                });
            };
            if (settings.format === 'multitoggle') multiTg();
            else cssmenu.addClass('dropdown');
            if (settings.sticky === true) cssmenu.css('position', 'fixed');
            if (settings.sticky === true) cssmenu.css('position', 'fixed');
            if (settings.sticky === true) cssmenu.css('position', 'fixed');
            if (settings.sticky === true) cssmenu.css('position', 'fixed');
            resizeFix = function () {
                if (jQuery(window).width() > 767) {
                   // cssmenu.find('ul').show();
                }
                if (jQuery(window).width() <= 767) {
                    cssmenu.find('ul').removeClass('open');
                    jQuery('#menu-button').removeClass('menu-opened');
                }
            };
            resizeFix();
            return jQuery(window).on('resize', resizeFix);
        });
    };
})(jQuery);
(function ($) {
    jQuery(document).ready(function () {
        jQuery(document).ready(function () {
            jQuery("#cssmenu").menumaker({
                title: "<span></span><span></span><span></span><span></span><span></span><span></span>",
                format: "multitoggle"
            });
            jQuery("#cssmenu").prepend("");
        });
        if(!jQuery('div').hasClass('heading-layer')){
          //  jQuery('#powerpress_navigation').addClass('fixed-header');
            //jQuery('.blog-wrapper').css('padding-top','40px');
        }
        if(jQuery('div').hasClass('transparent')){
           // jQuery('#powerpress_navigation').removeClass('fixed-header');
            //jQuery('.blog-wrapper').css('padding-top','0');
        }
        
        /** Set Position of Sub-Menu **/
        var wapoMainWindowWidth = jQuery(window).width();
        jQuery('#cssmenu ul ul li').mouseenter(function () {
            var subMenuExist = jQuery(this).find('.sub-menu').length;
            if (subMenuExist > 0) {
                var subMenuWidth = jQuery(this).find('.sub-menu').width();
                var subMenuOffset = jQuery(this).find('.sub-menu').parent().offset().left + subMenuWidth;
                if ((subMenuWidth + subMenuOffset) > wapoMainWindowWidth) {
                    jQuery(this).find('.sub-menu').removeClass('submenu-left');
                    jQuery(this).find('.sub-menu').addClass('submenu-right');
                } else {
                    jQuery(this).find('.sub-menu').removeClass('submenu-right');
                    jQuery(this).find('.sub-menu').addClass('submenu-left');
                }
            }
        });
        lightbox.option({
            'showImageNumberLabel': false,
        });        
    });
})(jQuery);




jQuery(document).ready(function () {
    /*carousel start*/
    /*carousel end*/
    /*Nav Active start*/
    jQuery('#cssmenu ul li a').click(function (e) {
        // e.preventDefault(); //prevent the link from being followed
        jQuery('#cssmenu ul li a').removeClass('active');
        jQuery(this).addClass('active');
    });
    /*Nav Active end*/
    /*Nav Active start*/
    jQuery('.active-menu ul li').click(function (e) {
        // e.preventDefault(); //prevent the link from being followed
        jQuery('.active-menu ul li').removeClass('active');
        jQuery(this).addClass('active');
    });
    /*Nav Active end*/  
    
    
});

/*Appear start*/

(function ($) {
    $.fn.appear = function (fn, options) {

        var settings = $.extend({

            //arbitrary data to pass to fn
            data: undefined,

            //call fn only on the first appear?
            one: true,

            // X & Y accuracy
            accX: 0,
            accY: 0

        }, options);

        return this.each(function () {

            var t = $(this);

            //whether the element is currently visible
            t.appeared = false;

            if (!fn) {

                //trigger the custom event
                t.trigger('appear', settings.data);
                return;
            }

            var w = $(window);

            //fires the appear event when appropriate
            var check = function () {

                //is the element hidden?
                if (!t.is(':visible')) {

                    //it became hidden
                    t.appeared = false;
                    return;
                }

                //is the element inside the visible window?
                var a = w.scrollLeft();
                var b = w.scrollTop();
                var o = t.offset();
                var x = o.left;
                var y = o.top;

                var ax = settings.accX;
                var ay = settings.accY;
                var th = t.height();
                var wh = w.height();
                var tw = t.width();
                var ww = w.width();

                if (y + th + ay >= b &&
                    y <= b + wh + ay &&
                    x + tw + ax >= a &&
                    x <= a + ww + ax) {

                    //trigger the custom event
                    if (!t.appeared) t.trigger('appear', settings.data);

                } else {

                    //it scrolled out of view
                    t.appeared = false;
                }
            };

            //create a modified fn with some additional logic
            var modifiedFn = function () {

                //mark the element as visible
                t.appeared = true;

                //is this supposed to happen only once?
                if (settings.one) {

                    //remove the check
                    w.unbind('scroll', check);
                    var i = $.inArray(check, $.fn.appear.checks);
                    if (i >= 0) $.fn.appear.checks.splice(i, 1);
                }

                //trigger the original fn
                fn.apply(this, arguments);
            };

            //bind the modified fn to the element
            if (settings.one) t.one('appear', settings.data, modifiedFn);
            else t.bind('appear', settings.data, modifiedFn);

            //check whenever the window scrolls
            w.scroll(check);

            //check whenever the dom changes
            $.fn.appear.checks.push(check);

            //check now
            (check)();
        });
    };

    //keep a queue of appearance checks
    $.extend($.fn.appear, {

        checks: [],
        timeout: null,

        //process the queue
        checkAll: function () {
            var length = $.fn.appear.checks.length;
            if (length > 0)
                while (length--)($.fn.appear.checks[length])();
        },

        //check the queue asynchronously
        run: function () {
            if ($.fn.appear.timeout) clearTimeout($.fn.appear.timeout);
            $.fn.appear.timeout = setTimeout($.fn.appear.checkAll, 20);
        }
    });

    //run checks when these methods are called
    $.each(['append', 'prepend', 'after', 'before', 'attr',
        'removeAttr', 'addClass', 'removeClass', 'toggleClass',
        'remove', 'css', 'show', 'hide'], function (i, n) {
        var old = $.fn[n];
        if (old) {
            $.fn[n] = function () {
                var r = old.apply(this, arguments);
                $.fn.appear.run();
                return r;
            }
        }
    });

})(jQuery);

jQuery(window).load(function() {
    jQuery(".preloader").delay(400).fadeOut(500);
});