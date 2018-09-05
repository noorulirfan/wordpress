<?php
function proficiency_scripts() {
  wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css');

	wp_enqueue_style( 'proficiency-style', get_stylesheet_uri() );

	wp_enqueue_style('proficiency-color', get_template_directory_uri() . '/css/colors/default.css');
	
	wp_enqueue_style('font-awesome',get_template_directory_uri().'/css/font-awesome.css');

	wp_enqueue_style('carousel',get_template_directory_uri().'/css/owl.carousel.css');

	wp_enqueue_style('owl_transitions',get_template_directory_uri().'/css/owl.transitions.css');

	/* Js script */
    
  //wp_enqueue_script('jquery_script', get_template_directory_uri() . '/js/jquery/jquery.js', array('jquery'));
  
  wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array('jquery'));

	wp_enqueue_script('jquery-smartmenus', get_template_directory_uri() . '/js/jquery.smartmenus.js', array('jquery'));

	wp_enqueue_script('jquery-smartmenus-bootstrap', get_template_directory_uri() . '/js/jquery.smartmenus.bootstrap.js', array('jquery'));



	wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'));

	wp_register_script('proficiency_custom', get_template_directory_uri() . '/js/custom.js','','1.1', true);
	wp_enqueue_script('proficiency_custom');

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action('wp_enqueue_scripts', 'proficiency_scripts');
?>