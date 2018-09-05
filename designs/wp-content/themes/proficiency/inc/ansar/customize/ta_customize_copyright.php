<?php
// Footer copyright section 
function proficiency_footer_copyright( $wp_customize ) {
	$wp_customize->add_panel('proficiency_copyright', array(
		'priority' => 600,
		'capability' => 'edit_theme_options',
		'title' => __('Footer Settings', 'proficiency'),
	) );
	
	$wp_customize->add_section('copyright_section_one', array(
        'title' => __('Footer Copyright Settings','proficiency'),
        'description' => __('This is a Footer section.','proficiency'),
        'priority' => 35,
		'panel' => 'proficiency_copyright',
    ) );

    $wp_customize->add_setting( 'hide_copyright',array(
        'default' => 'true',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control('hide_copyright', array(
        'label' => __('Hide/Show Copyright Text','proficiency'),
        'description'   => __('Hide/Show Footer Copyright Text', 'proficiency'),
        'section' => 'copyright_section_one',
        'type' => 'radio',
        'choices' => array('true'=>'On','false'=>'Off'),
    ) );

	$wp_customize->add_setting('proficiency_footer_copyright_setting', array(
        'sanitize_callback' => 'proficiency_footer_copyright_sanitize_text',
        'default' => __('<p>&copy; Copyright 2017 by <a href="#">proficiency</a>. All Rights Reserved. Powered by <a href="https://wordpress.org/">WordPress</a></p>','proficiency'),
    ) );
    $wp_customize->add_control('proficiency_footer_copyright_setting', array(
        'label' => __('Copyright text','proficiency'),
        'section' => 'copyright_section_one',
        'type' => 'textarea',
    ) );

	
	function proficiency_footer_copyright_sanitize_text( $input ) {

    return wp_kses_post( force_balance_tags( $input ) );

    }
    
    function proficiency_copyright_sanitize_checkbox( $input ) {
	// Boolean check 
	return ( ( isset( $input ) && true == $input ) ? true : false );
	}
	
}
add_action( 'customize_register', 'proficiency_footer_copyright' );
?>