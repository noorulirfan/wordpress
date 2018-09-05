jQuery(document).ready(function(){
    jQuery('.homepage_slider .homepage_post_slider').owlCarousel({
        margin:0,
        loop:true,
        autoplay:true,
        responsiveClass:true,
        navText: ["<i class='fa fa-chevron-left homepage'></i>","<i class='fa fa-chevron-right homepage'></i>"],
        responsive:{
            0:{
                items:1,
                nav:true
            },
            768:{
                items:1,
                nav:false
            },
            1000:{
                items:1,
                nav:true
            }
        }
        })

});