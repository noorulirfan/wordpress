(function($) {
  "use strict";
/* =================================
===         PARLLEX MENU        ====
=================================== */
$(function() {
    $('.menu-item a').on('click', function(event) {
        var $anchor = $(this);
        var nav_height = $('.navbar').innerHeight();
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top - nav_height
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });
    $('body').scrollspy({
        target: '.navbar-wp',
        offset: 60
    })
}); 
/* =================================
===         SCROLL TOP       ====
=================================== */
jQuery(".ta_scroll").hide();	
function tascroll() {
	jQuery(window).on('scroll', function() {
		if (jQuery(this).scrollTop() > 500) {
				jQuery('.ta_scroll').fadeIn();
		} else {
			jQuery('.ta_scroll').fadeOut();
		}
	});		
	jQuery('a.ta_scroll').on('click', function () {
		jQuery('body,html').animate({
			scrollTop: 0
		}, 800);
		return false;
	});
}    
tascroll();
})(jQuery);

 (function($) {
  "use strict";
/* =================================
===         HOME SLIDER        ====
=================================== */
function homeslider() {
  jQuery("#proficiency-slider").owlCarousel({
      animateOut: 'slideOutDown',
      animateIn: 'flipInX',
      navigation : true, // Show next and prev buttons
       slideSpeed : 300,
      pagination : true,
      paginationSpeed : 400,
      singleItem:true,
      autoPlay : true,
      transitionStyle : "backSlide",
      navigationText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ]
  });
}
homeslider();
})(jQuery);


/* =================================
===      SERVICE LOAD MORE      ====
=================================== */
function taservice() {
  jQuery(".proficiency-service").slice(0, 3).show(); // select the first ten
  jQuery("#load-service").on('click',function(e){ // click event for load more
      e.preventDefault();
      jQuery( "#proficiency-port-load-ser" ).addClass("proficiency-port-load-show-ser");
      jQuery( "#proficiency-port-load-ser" ).animate(
          { 
              display:"block"
          }
          , 500, 
      function() {
          // Animation complete.
          jQuery(".proficiency-service:hidden").slice(0, 4).show(); // select next 10 hidden divs and show them
          if(jQuery(".proficiency-service:hidden").length === 0){ // check if any hidden divs still exist
              jQuery("#load-service").text("No more"); // alert if there are none left
              }
          jQuery( "#proficiency-port-load-ser" ).removeClass("proficiency-port-load-show-ser");
          }
      ); 
  });
}  
taservice(); 
