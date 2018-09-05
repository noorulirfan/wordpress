<?php function proficiency_homepage_selective( $wp_customize ){
$wp_customize->selective_refresh->add_partial( 'proficiency_service_title', array(
		'selector'            => '.proficiency-section .proficiency-heading-inner',
		'settings'            => 'proficiency_service_title',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'proficiency_service_subtitle', array(
		'selector'            => '.proficiency-section p',
		'settings'            => 'proficiency_service_subtitle',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'proficiency_callout_title', array(
		'selector'            => '.proficiency-callout .padding-bottom-30',
		'settings'            => 'proficiency_callout_title',
	
	) );
	
	
	$wp_customize->selective_refresh->add_partial( 'proficiency_callout_description', array(
		'selector'            => '.proficiency-callout p',
		'settings'            => 'proficiency_callout_description',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'busiprof_theme_options[service_tagline]', array(
		'selector'            => '.service .section-title p',
		'settings'            => 'busiprof_theme_options[service_tagline]',
	
	) );
	
	
	$wp_customize->selective_refresh->add_partial( 'proficiency_callout_button_one_label', array(
		'selector'            => '.proficiency-callout a',
		'settings'            => 'proficiency_callout_button_one_label',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'proficiency_news_title', array(
		'selector'            => '.proficiency-blog-section h3',
		'settings'            => 'proficiency_news_title',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'proficiency_news_subtitle', array(
		'selector'            => '.proficiency-blog-section .proficiency-heading p',
		'settings'            => 'proficiency_news_subtitle',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'proficiency_contact_title', array(
		'selector'            => '.proficiency-contact h3',
		'settings'            => 'proficiency_contact_title',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'proficiency_contact_subtitle', array(
		'selector'            => '.proficiency-contact p',
		'settings'            => 'proficiency_contact_subtitle',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'proficiency_footer_copyright_setting', array(
		'selector'            => '.proficiency-footer-copyright p',
		'settings'            => 'proficiency_footer_copyright_setting',
	
	) );
	
	
	$wp_customize->selective_refresh->add_partial( 'proficiency_head_info_one', array(
		'selector'            => '.proficiency-head-detail .info-left',
		'settings'            => 'proficiency_head_info_one',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'proficiency_head_info_two', array(
		'selector'            => '.proficiency-head-detail .info-left li',
		'settings'            => 'proficiency_head_info_two',
	
	) );
	
}
add_action( 'customize_register', 'proficiency_homepage_selective' );