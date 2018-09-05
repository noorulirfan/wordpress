<?php

/*
 * photographer Enqueue css and js files
 */
function powerpress_lite_enqueue() {
   
    wp_enqueue_style('powerpress-lite-font-montserrat', '//fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i', array(),null);
    wp_enqueue_style('powerpress-lite-font-pt-sans', '//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i', array(),null);

    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css', array(),null);

    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.css', array(),null);    

    wp_enqueue_style('lightbox', get_template_directory_uri() . '/assets/css/lightbox.css', array(),null);

    wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/assets/css/owl.carousel.css', array(),null);

    wp_enqueue_style('animate', get_template_directory_uri() . '/assets/css/animate.css', array(),null);

    /*widgets styles*/
    wp_register_style('powerpress-lite-widget-homepage-slider', get_template_directory_uri().'/assets/css/customizer-option/homepage-slider-style.css',array(),null, false);
    wp_register_style( 'powerpress-lite-widget-aboutus-style', get_template_directory_uri().'/assets/css/customizer-option/aboutus-style.css',array(),null, false);
    wp_register_style( 'powerpress-lite-widget-portfolio-style', get_template_directory_uri().'/assets/css/customizer-option/portfolio-style.css',array(),null, false);
    wp_register_style( 'powerpress-lite-widget-testimonials-style', get_template_directory_uri().'/assets/css/customizer-option/testimonials-style.css',array(),null, false);
    wp_register_style( 'powerpress-lite-widget-add-profile-details-style', get_template_directory_uri().'/assets/css/customizer-option/add-profile-details-style.css',array(),null, false);
    wp_register_style( 'powerpress-lite-widget-latest-blog-style', get_template_directory_uri().'/assets/css/customizer-option/latest-blog-style.css',array(),null, false);
    /**/

    wp_enqueue_style('powerpress-lite-main-style', get_template_directory_uri() . '/assets/css/default.css', array(),null);
       
    wp_enqueue_style('powerpress-lite-header-style', get_template_directory_uri() . '/assets/css/header-style.css', array(),null);
    wp_enqueue_style('powerpress_lite_blog_layout_css', get_template_directory_uri(). '/assets/css/blog-layout.css', array(),null);   

    wp_enqueue_script("comment-reply");

    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.js',array('jquery'), false, true );

    wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.js', array('jquery'), false, true);    
    wp_enqueue_script('lightbox', get_template_directory_uri() . '/assets/js/lightbox.js', array('jquery'),false,true);
    
    /*widgets scripts*/
    wp_register_script('powerpress-lite-widget-homepage-slider', get_template_directory_uri() .'/assets/js/customizer-option/homepage-slider.js', array('jquery'), null, true);
    /**/

    wp_enqueue_script('powerpress-lite-script-header-style', get_template_directory_uri() . '/assets/js/header-style.js', false, true, array('jquery'));
    wp_localize_script('powerpress-lite-script-header-style', 'powerpress_lite_script_handler', array());
    
    powerpress_lite_custom_css();
}
add_action('wp_enqueue_scripts', 'powerpress_lite_enqueue');
