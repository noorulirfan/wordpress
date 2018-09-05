<?php 

/**
 * Template Name: Home Page
 */
		 get_header(); 
		
		//=========== Get Home Slider ===========//
		get_template_part('sections/home','slider');
		
		//=========== Get Home Slider ===========//
		get_template_part('sections/home','services');
	
		//=========== Get Index News ===========//
		get_template_part('sections/home', 'callout');	

		//=========== Get Index callout ===========//
		get_template_part('sections/home', 'blog');	
		
		//=========== Get Index contact ===========//
		get_template_part('sections/home', 'contact');
					

get_footer(); 
?>