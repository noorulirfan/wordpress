<?php
/**
* Powerpress Lite Customization options
*
* Add postMessage support for site title and description for the Theme Customizer.
*
* @param WP_Customize_Manager $wp_customize Theme Customizer object.
*/
function powerpress_lite_customize_register( $wp_customize ) {
  $wp_customize->add_panel(
    'general',
    array(
        'title' => __( 'General', 'powerpress-lite' ),
        'description' => __('styling options','powerpress-lite'),
        'priority' => 20, 
    )
  );
   //All our sections, settings, and controls will be added here
  $wp_customize->add_section(
    'powerpressliteSocialLinks',
    array(
      'title' => __('Social Accounts', 'powerpress-lite'),
      'priority' => 120,
      'description' => __( 'In first input box, you need to add FONT AWESOME shortcode which you can find <a target="_blank" href="https://fortawesome.github.io/Font-Awesome/icons/">here</a> and in second input box, you need to add your social media profile URL.<br /> Enter the URL of your social accounts. Leave it empty to hide the icon.' , 'powerpress-lite'),
      'panel' => 'footer'
    )
  );
  $wp_customize->get_section('title_tagline')->panel = 'general';  
  $wp_customize->get_section('title_tagline')->title = __('Header & Logo','powerpress-lite');
 

$powerpress_lite_Social_Icon = array();
  for($i=1;$i <= 5;$i++):  
    $powerpress_lite_Social_Icon[] =  array( 'slug'=>sprintf('powerpressliteSocialIcon%d',$i),   
      'default' => '',   
      'label' => esc_html__( 'Social Account ', 'powerpress-lite' ) . $i,
      'priority' => sprintf('%d',$i) );  
  endfor;
  foreach($powerpress_lite_Social_Icon as $powerpress_lite_Social_Icons){
    $wp_customize->add_setting(
      $powerpress_lite_Social_Icons['slug'],
      array(
        'default' => '',
        'capability'     => 'edit_theme_options',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
      )
    );
    $wp_customize->add_control(
      $powerpress_lite_Social_Icons['slug'],
      array(
        'type'  => 'text',
        'section' => 'powerpressliteSocialLinks',
        'input_attrs' => array( 'placeholder' => esc_attr__('Enter Icon','powerpress-lite') ),
        'label'      =>   $powerpress_lite_Social_Icons['label'],
        'priority' => $powerpress_lite_Social_Icons['priority']
      )
    );
  }
  $powerpress_lite_Social_Icon_Link = array();
  for($i=1;$i <= 5;$i++):  
    $powerpress_lite_Social_Icon_Link[] =  array( 'slug'=>sprintf('powerpressliteSocialIconLink%d',$i),   
      'default' => '',   
      'label' => esc_html__( 'Social Link ', 'powerpress-lite' ) . $i,   
      'priority' => sprintf('%d',$i) );  
  endfor;
  foreach($powerpress_lite_Social_Icon_Link as $powerpress_lite_Social_Icon_Links){
    $wp_customize->add_setting(
      $powerpress_lite_Social_Icon_Links['slug'],
      array(
        'default' => '',
        'capability'     => 'edit_theme_options',
        'type' => 'theme_mod',
        'sanitize_callback' => 'esc_url_raw',
      )
    );
    $wp_customize->add_control(
      $powerpress_lite_Social_Icon_Links['slug'],
      array(
        'type'  => 'text',
        'section' => 'powerpressliteSocialLinks',
        'priority' => $powerpress_lite_Social_Icon_Links['priority'],
        'input_attrs' => array( 'placeholder' => esc_html__('Enter URL','powerpress-lite')),
      )
    );
  }
$wp_customize->add_section(
  'headerNlogo',
  array(
    'title' => __('Header & Logo','powerpress-lite'),
    'panel' => 'general'
  )
);

$wp_customize->add_setting('theme_header_fix', array(
        'default' => false,  
        'sanitize_callback' => 'powerpress_lite_field_sanitize_checkbox',
));
$wp_customize->add_control('theme_header_fix', array(
    'label'   => esc_html__('Header Fix','powerpress-lite'),
    'section' => 'title_tagline',
    'type'    => 'checkbox',
    'priority' => 49
));

//Multiple logo upload code
$wp_customize->add_setting(
  'theme_logo_height',
  array(
    'default' => '50',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'absint',
    )
  );
$wp_customize->add_control(
  'theme_logo_height',
  array(
    'section' => 'title_tagline',
    'label'      => __('Enter Logo Size', 'powerpress-lite'),
    'description' => __("Use if you want to increase or decrease logo size (optional) Don't enter `px` in the string. e.g. 20 (default: 10px)",'powerpress-lite'),
    'type'       => 'number',
    'priority'    => 50,
    )
  );
/*-------------------- Pre Loader Option --------------------------*/
$wp_customize->add_section( 'preloaderSection' , array(
    'title'       => __( 'Preloader', 'powerpress-lite' ),
    'priority'    => 32,
    'capability'     => 'edit_theme_options',
    'panel' => 'general',
) );
$wp_customize->add_setting(
    'preloader',
    array(
        'default' => '1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'powerpress_lite_sanitize_select',
        'priority' => 20, 
    )
);
$wp_customize->add_control(
    'preloader',
    array(
        'section' => 'preloaderSection',                
        'label'   => __('Preloader','powerpress-lite'),
        'type'    => 'radio',
        'choices'        => array(
            "1"   => esc_html__( "On ", 'powerpress-lite' ),
            "2"   => esc_html__( "Off", 'powerpress-lite' ),
        ),
    )
);

$wp_customize->add_setting( 'customPreloader', array(
    'sanitize_callback' => 'esc_url_raw',
    'capability'     => 'edit_theme_options',
    'priority' => 40,
));

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'customPreloader', array(
    'label'    => __( 'Upload Custom Preloader', 'powerpress-lite' ),
    'section'  => 'preloaderSection',
    'settings' => 'customPreloader',
) ) );

/*-------------------- Home Page Option Setting --------------------------*/
$wp_customize->add_panel(
    'frontpage_section',
    array(
        'title' => __( 'Front Page Options', 'powerpress-lite' ),
        'description' => __('Front Page options','powerpress-lite'),
        'priority' => 20, 
    )
  );

$wp_customize->add_section( 'frontpage_slider_section' ,
   array(
      'title'       => __( 'Front Page : Slider', 'powerpress-lite' ),
      'priority'    => 32,
      'capability'     => 'edit_theme_options', 
      'panel' => 'frontpage_section'   
  )
);

$wp_customize->add_setting(
    'powerpress_lite_homepage_sliderswitch',
    array(
        'default' => '1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'powerpress_lite_sanitize_select',
    )
);
$wp_customize->add_control(
    'powerpress_lite_homepage_sliderswitch',
    array(
        'section' => 'frontpage_slider_section',
        'label'      => __('Slider Section', 'powerpress-lite'),
        'description' => __('Slider Section hide or show .','powerpress-lite'),
        'type'       => 'select',
        'choices' => array(
          "1"   => esc_html__( "Show", 'powerpress-lite' ),
          "2"   => esc_html__( "Hide", 'powerpress-lite' ),      
        ),
    )
);

$wp_customize->add_setting(
  'powerpress_lite_homepage_slider_category',
  array(
    'default' => 0 ,
    'sanitize_callback' => 'powerpress_lite_sanitize_select',
    'capability'  => 'edit_theme_options',
  )
);
$wp_customize->add_control(
  'powerpress_lite_homepage_slider_category',
  array(
    'label' => __('Select Category For Slider','powerpress-lite'),
    'section' => 'frontpage_slider_section',
    'type'    => 'select',
    'choices' => powerpress_lite_posts_category(),
  )
);

/* Front page Service section */
$wp_customize->add_section( 'frontpage_service_section' ,
   array(
      'title'       => __( 'Front Page : Service Section', 'powerpress-lite' ),
      'priority'    => 32,
      'capability'     => 'edit_theme_options', 
      'panel' => 'frontpage_section'   
  )
);

/*powerpress_lite_homepage_sectionswitch*/
$wp_customize->add_setting(
    'powerpress_lite_homepage_sectionswitch',
    array(
        'default' => '1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'powerpress_lite_sanitize_select',
    )
);
$wp_customize->add_control(
    'powerpress_lite_homepage_sectionswitch',
    array(
        'section' => 'frontpage_service_section',
        'label'      => __('Service Section', 'powerpress-lite'),
        'description' => __('Service Section hide or show .','powerpress-lite'),
        'type'       => 'select',
        'choices' => array(
          "1"   => esc_html__( "Show", 'powerpress-lite' ),
          "2"   => esc_html__( "Hide", 'powerpress-lite' ),      
        ),
    )
);

$wp_customize->add_setting(
  'powerpress_lite_homepage_service_category',
  array(
    'default' => 0,
    'sanitize_callback' => 'powerpress_lite_sanitize_select',
    'capability'  => 'edit_theme_options',
  )
);
$wp_customize->add_control(
  'powerpress_lite_homepage_service_category',
  array(
    'label' => __('Select Category For Service','powerpress-lite'),
    'section' => 'frontpage_service_section',
    'type'    => 'select',
    'choices' => powerpress_lite_posts_category(),
  )
);

for($i=1;$i <= 4;$i++):

$wp_customize->add_setting(
    'powerpress_lite_homepage_section'.$i.'_icon',
    array(
        'default'           => 'fa fa-bell',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage'
    )
);

$wp_customize->add_control(
    new powerpress_lite_Fontawesome_Icon_Chooser(
    $wp_customize,
    'powerpress_lite_homepage_section'.$i.'_icon',
        array(
            'settings'      => 'powerpress_lite_homepage_section'.$i.'_icon',
            'section'       => 'frontpage_service_section',
            'label'         => $i. __( ' Service Icon ', 'powerpress-lite' ),
        )
    )
);
endfor;

/*Front Page : About us Section*/
$wp_customize->add_section(
  'powerpress_lite_aboutus_section',
  array(
    'title' => __('Front Page : About Us Section','powerpress-lite'),
    'panel' => 'frontpage_section',
    'description' => __('Using this option you can display the category wise posts on about us Section.','powerpress-lite'),
  )
);

$wp_customize->add_setting(
    'powerpress_lite_aboutus_sectionswitch',
    array(
        'default' => '1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'powerpress_lite_sanitize_select',
    )
);
$wp_customize->add_control(
    'powerpress_lite_aboutus_sectionswitch',
    array(
        'section' => 'powerpress_lite_aboutus_section',
        'label'      => __('AboutUs Section', 'powerpress-lite'),
        'description' => __('about us Section hide or show .','powerpress-lite'),
        'type'       => 'select',
        'choices' => array(
          "1"   => esc_html__( "Show", 'powerpress-lite' ),
          "2"   => esc_html__( "Hide", 'powerpress-lite' ),      
        ),
    )
);

$wp_customize->add_setting(
  'powerpress_lite_aboutus_category',
  array(
    'default' => 0,
    'sanitize_callback' => 'powerpress_lite_sanitize_select',
    'capability'  => 'edit_theme_options',
  )
);
$wp_customize->add_control(
  'powerpress_lite_aboutus_category',
  array(
    'label' => __('Select Category For AboutUs','powerpress-lite'),
    'section' => 'powerpress_lite_aboutus_section',
    'type'    => 'select',
    'choices' => powerpress_lite_posts_category(),
  )
);
$wp_customize->add_setting(
  'powerpress_lite_aboutus_category_title',
  array(
    'default' => 'About Us',
    'sanitize_callback' => 'sanitize_text_field',
    'capability'  => 'edit_theme_options',
  )
);
$wp_customize->add_control(
  'powerpress_lite_aboutus_category_title',
  array(
    'label' => __('Section Title','powerpress-lite'),   
    'section' => 'powerpress_lite_aboutus_section',
    'type'    => 'text',
  )
);


/*Front Page : Team Section*/
$wp_customize->add_section(
  'powerpress_lite_team_section',
  array(
    'title' => __('Front Page : Team Section','powerpress-lite'),
    'panel' => 'frontpage_section',
    'description' => __('Using this option you can display Team Section.','powerpress-lite'),
  )
);

/*powerpress_lite_Team_sectionswitch*/
$wp_customize->add_setting(
    'powerpress_lite_team_sectionswitch',
    array(
        'default' => '1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'powerpress_lite_sanitize_select',
    )
);
$wp_customize->add_control(
    'powerpress_lite_team_sectionswitch',
    array(
        'section' => 'powerpress_lite_team_section',
        'label'      => __('Team Section', 'powerpress-lite'),
        'description' => __('Team Section hide or show .','powerpress-lite'),
        'type'       => 'select',
        'choices' => array(
          "1"   => esc_html__( "Show", 'powerpress-lite' ),
          "2"   => esc_html__( "Hide", 'powerpress-lite' ),      
        ),
    )
);

$wp_customize->add_setting( 'powerpress_lite_team_title',
    array(
        'default' => 'Meet Our Team',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        'priority' => 20, 
    )
);
$wp_customize->add_control( 'powerpress_lite_team_title',
    array(
        'section' => 'powerpress_lite_team_section',                
        'label'   => __('Team Section Title ','powerpress-lite'),
        'type'    => 'text',
    )
);

$wp_customize->add_setting(
  'powerpress_lite_team_category',
  array(
    'default' => 0,
    'sanitize_callback' => 'powerpress_lite_sanitize_select',
    'capability'  => 'edit_theme_options',
  )
);
$wp_customize->add_control(
  'powerpress_lite_team_category',
  array(
    'label' => __('Select Category For Team','powerpress-lite'),
    'section' => 'powerpress_lite_team_section',
    'type'    => 'select',
    'choices' => powerpress_lite_posts_category(),
  )
);

for($i=1;$i <= 3;$i++):    
    for($j=1;$j<=3;$j++):
      $wp_customize->add_setting(
          'powerpress_lite_team_'.$i.$j.'_icon',
          array(
              'default'           => 'fa fa-facebook',
              'sanitize_callback' => 'sanitize_text_field',
              'transport'         => 'postMessage'
          )
      );
      $wp_customize->add_control(
          new powerpress_lite_Fontawesome_Icon_Chooser(
          $wp_customize,
          'powerpress_lite_team_'.$i.$j.'_icon',
              array(
                  'settings'      => 'powerpress_lite_team_'.$i.$j.'_icon',
                  'section'       => 'powerpress_lite_team_section',
                  'label'         => $i. __( ' Team Member Social Icon ', 'powerpress-lite' ).$j,
              )
          )
      );
      $wp_customize->add_setting( 'powerpress_lite_team_'.$i.$j.'_link',
          array(
              'capability'     => 'edit_theme_options',
              'sanitize_callback' => 'esc_url_raw',
              'priority' => 20, 
          )
      );
      $wp_customize->add_control( 'powerpress_lite_team_'.$i.$j.'_link',
          array(
              'section' => 'powerpress_lite_team_section',                
              'label'   => $i. __(' Team Member Social Link ','powerpress-lite').$j,
              'type'    => 'text',
          )
      );
    endfor;
endfor;


/*Front Page : Portfolio Section*/
$wp_customize->add_section(
  'powerpress_lite_portfolio_section',
  array(
    'title' => __('Front Page : Portfolio Section','powerpress-lite'),
    'panel' => 'frontpage_section',
    'description' => __('Using this option you can display the category wise posts on Portfolio Section.','powerpress-lite'),
  )
);

$wp_customize->add_setting(
    'powerpress_lite_portfolio_sectionswitch',
    array(
        'default' => '1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'powerpress_lite_sanitize_select',
    )
);
$wp_customize->add_control(
    'powerpress_lite_portfolio_sectionswitch',
    array(
        'section' => 'powerpress_lite_portfolio_section',
        'label'      => __('Portfolio Section', 'powerpress-lite'),
        'description' => __('Portfolio Section hide or show .','powerpress-lite'),
        'type'       => 'select',
        'choices' => array(
          "1"   => esc_html__( "Show", 'powerpress-lite' ),
          "2"   => esc_html__( "Hide", 'powerpress-lite' ),      
        ),
    )
);

$wp_customize->add_setting(
  'powerpress_lite_portfolio_category',
  array(
    'default' => 0,
    'sanitize_callback' => 'powerpress_lite_sanitize_select',
    'capability'  => 'edit_theme_options',
  )
);
$wp_customize->add_control(
  'powerpress_lite_portfolio_category',
  array(
    'label' => __('Select Category For Portfolio','powerpress-lite'),
    'section' => 'powerpress_lite_portfolio_section',
    'type'    => 'select',
    'choices' => powerpress_lite_posts_category(),
  )
);
$wp_customize->add_setting(
  'powerpress_lite_portfolio_category_title',
  array(
    'default' => 'Our Work Experiences',
    'sanitize_callback' => 'sanitize_text_field',
    'capability'  => 'edit_theme_options',
  )
);
$wp_customize->add_control(
  'powerpress_lite_portfolio_category_title',
  array(
    'label' => __('Section Title','powerpress-lite'),   
    'section' => 'powerpress_lite_portfolio_section',
    'type'    => 'text',
  )
);


/*Front Page : Testimonials Section*/
$wp_customize->add_section(
  'powerpress_lite_testimonials_section',
  array(
    'title' => __('Front Page : Testimonials Section','powerpress-lite'),
    'panel' => 'frontpage_section',
    'description' => __('Using this option you can display the category wise posts on Testimonials Section.','powerpress-lite'),
  )
);

$wp_customize->add_setting(
    'powerpress_lite_testimonials_sectionswitch',
    array(
        'default' => '1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'powerpress_lite_sanitize_select',
    )
);
$wp_customize->add_control(
    'powerpress_lite_testimonials_sectionswitch',
    array(
        'section' => 'powerpress_lite_testimonials_section',
        'label'      => __('Testimonials Section', 'powerpress-lite'),
        'description' => __('Testimonials Section hide or show .','powerpress-lite'),
        'type'       => 'select',
        'choices' => array(
          "1"   => esc_html__( "Show", 'powerpress-lite' ),
          "2"   => esc_html__( "Hide", 'powerpress-lite' ),      
        ),
    )
);

$wp_customize->add_setting(
  'powerpress_lite_testimonials_category',
  array(
    'default' => 0,
    'sanitize_callback' => 'powerpress_lite_sanitize_select',
    'capability'  => 'edit_theme_options',
  )
);
$wp_customize->add_control(
  'powerpress_lite_testimonials_category',
  array(
    'label' => __('Select Category For Testimonials','powerpress-lite'),
    'section' => 'powerpress_lite_testimonials_section',
    'type'    => 'select',
    'choices' => powerpress_lite_posts_category(),
  )
);
$wp_customize->add_setting(
  'powerpress_lite_testimonials_title',
  array(
    'default' => 'Our Client Says',
    'sanitize_callback' => 'sanitize_text_field',
    'capability'  => 'edit_theme_options',
  )
);
$wp_customize->add_control(
  'powerpress_lite_testimonials_title',
  array(
    'label' => __('Testimonial Title','powerpress-lite'), 
    'section' => 'powerpress_lite_testimonials_section',
    'type'    => 'text',
  )
);

/*Front Page : Latest Blog Section*/
$wp_customize->add_section(
  'powerpress_lite_latest_blog_section',
  array(
    'title' => __('Front Page : Latest Blog Section','powerpress-lite'),
    'panel' => 'frontpage_section',
    'description' => __('Using this option you can display the category wise posts on latest_blog Section.','powerpress-lite'),
  )
);

$wp_customize->add_setting(
    'powerpress_lite_latest_blog_sectionswitch',
    array(
        'default' => '1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'powerpress_lite_sanitize_select',
    )
);
$wp_customize->add_control(
    'powerpress_lite_latest_blog_sectionswitch',
    array(
        'section' => 'powerpress_lite_latest_blog_section',
        'label'      => __('latest_blog Section', 'powerpress-lite'),
        'description' => __('latest_blog Section hide or show .','powerpress-lite'),
        'type'       => 'select',
        'choices' => array(
          "1"   => esc_html__( "Show", 'powerpress-lite' ),
          "2"   => esc_html__( "Hide", 'powerpress-lite' ),      
        ),
    )
);

$wp_customize->add_setting(
  'powerpress_lite_latest_blog_category',
  array(
    'default' => 0,
    'sanitize_callback' => 'powerpress_lite_sanitize_select',
    'capability'  => 'edit_theme_options',
  )
);
$wp_customize->add_control(
  'powerpress_lite_latest_blog_category',
  array(
    'label' => __('Select Category For latest_blog','powerpress-lite'),
    'section' => 'powerpress_lite_latest_blog_section',
    'type'    => 'select',
    'choices' => powerpress_lite_posts_category(),
  )
);
$wp_customize->add_setting(
  'powerpress_lite_latest_blog_category_title',
  array(
    'default' => 'Our latest blog',
    'sanitize_callback' => 'sanitize_text_field',
    'capability'  => 'edit_theme_options',
  )
);
$wp_customize->add_control(
  'powerpress_lite_latest_blog_category_title',
  array(
    'label' => __('Section Title','powerpress-lite'),   
    'section' => 'powerpress_lite_latest_blog_section',
    'type'    => 'text',
  )
);
/*-------------------- Home Page Option Setting End --------------------------*/

/*-------------------- Color Option --------------------------*/
//Colors section

$wp_customize->add_setting(
    'themeColor',
    array(
        'default' => '#ff4e00',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'themeColor',
    array(
        'label'      => __('Theme Color ', 'powerpress-lite'),
        'section' => 'colors',
        'priority' => 10
    )
  )
);
$wp_customize->add_setting(
  'secondaryColor',
  array(
      'default' => '#000000',
      'capability'     => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'secondaryColor',
    array(
        'label'      => __('Secondary Color', 'powerpress-lite'),
        'section' => 'colors',
        'priority' => 11
    )
  )
);

//Menu Text Color
$wp_customize->add_setting(
  'menuTextColor',
  array(
      'default' => '#ffffff',
      'capability'     => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'menuTextColor',
    array(
        'label'      => __('Menu Text Color', 'powerpress-lite'),
        'section' => 'colors',
        'priority' => 11
    )
  )
);
//Menu Text Color
$wp_customize->add_setting(
  'menuTextColorScroll',
  array(
      'default' => '#ffffff',
      'capability'     => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'menuTextColorScroll',
    array(
        'label'      => __('Menu Text Color(after scroll)', 'powerpress-lite'),
        'section' => 'colors',
        'priority' => 11
    )
  )
);

//Menu Background Color
$wp_customize->add_setting(
  'menubackgroundcolor',
  array(
      'default' => '#000000',
      'capability'     => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'menubackgroundcolor',
    array(
        'label'      => __('Menu Background Color', 'powerpress-lite'),
        'section' => 'colors',
        'priority' => 11
    )
  )
);
//Menu Background Color (Scroll)
$wp_customize->add_setting(
  'menuBackgroundColorScroll',
  array(
      'default' => '#ff4e00',
      'capability'     => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'menuBackgroundColorScroll',
    array(
        'label'      => __('Menu Background Color (after scroll)', 'powerpress-lite'),
        'section' => 'colors',
        'priority' => 11
    )
  )
);

//Body Background Color
$wp_customize->add_setting(
  'bodyBackgroundColor',
  array(
      'default' => '#ffffff',
      'capability'     => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'bodyBackgroundColor',
    array(
        'label'      => __('Body Background Color', 'powerpress-lite'),
        'section' => 'colors',
        'priority' => 11
    )
  )
);
//Body Text Color
$wp_customize->add_setting(
  'bodyTextColor',
  array(
      'default' => '#4d4d4d',
      'capability'     => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'bodyTextColor',
    array(
        'label'      => __('Body Text Color', 'powerpress-lite'),
        'section' => 'colors',
        'priority' => 11
    )
  )
);
//Footer Background Color
$wp_customize->add_setting(
  'footerBackgroundColor',
  array(
      'default' => '#000000',
      'capability'     => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'footerBackgroundColor',
    array(
        'label'      => __('Footer Background Color', 'powerpress-lite'),
        'section' => 'colors',
        'priority' => 11
    )
  )
);

//Footer Text Color
$wp_customize->add_setting(
  'footerTextColor',
  array(
      'default' => '#ffffff',
      'capability'     => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'footerTextColor',
    array(
        'label'      => __('Footer Text Color', 'powerpress-lite'),
        'section' => 'colors',
        'priority' => 11
    )
  )
);

//Footer Link Color
$wp_customize->add_setting(
  'footerLinkColor',
  array(
      'default' => '#ffffff',
      'capability'     => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'footerLinkColor',
    array(
        'label'      => __('Footer Link Color', 'powerpress-lite'),
        'section' => 'colors',
        'priority' => 11
    )
  )
);

//Footer Link Hover Color
$wp_customize->add_setting(
  'footerLinkHoverColor',
  array(
      'default' => '#ff4e00',
      'capability'     => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'footerLinkHoverColor',
    array(
        'label'      => __('Footer Link Hover Color', 'powerpress-lite'),
        'section' => 'colors',
        'priority' => 11
    )
  )
);

//Footer Background Color
$wp_customize->add_setting(
  'footerBackgroundColor',
  array(
      'default' => '#000000',
      'capability'     => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'footerBackgroundColor',
    array(
        'label'      => __('Footer Background Color', 'powerpress-lite'),
        'section' => 'colors',
        'priority' => 11
    )
  )
);

//Footer Copyright Background Color
$wp_customize->add_setting(
  'copyrightBackgroundColor',
  array(
      'default' => '#ff4e00',
      'capability'     => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'copyrightBackgroundColor',
    array(
        'label'      => __('Copyright Background Color', 'powerpress-lite'),
        'section' => 'colors',
        'priority' => 11
    )
  )
);
//Copyright Text Color
$wp_customize->add_setting(
  'copyrightTextColor',
  array(
      'default' => '#ffffff',
      'capability'     => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'copyrightTextColor',
    array(
        'label'      => __('Copyright Text Color', 'powerpress-lite'),
        'section' => 'colors',
        'priority' => 11
    )
  )
);

//Copyright Link Color
$wp_customize->add_setting(
  'copyrightLinkColor',
  array(
      'default' => '#ffffff',
      'capability'     => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'copyrightLinkColor',
    array(
        'label'      => __('Copyright Link Color', 'powerpress-lite'),
        'section' => 'colors',
        'priority' => 11
    )
  )
);

//Copyright Link Hover Color
$wp_customize->add_setting(
  'copyrightLinkHoverColor',
  array(
      'default' => '#000',
      'capability'     => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'copyrightLinkHoverColor',
    array(
        'label'      => __('Copyright Link Hover Color', 'powerpress-lite'),
        'section' => 'colors',
        'priority' => 11
    )
  )
);
/*-------------------- Color Option --------------------------*/
/*-------------------- BLog Page Option --------------------------*/
$wp_customize->add_section(
    'blogThemeOption',
    array(
        'title' => __( 'Blog (Archive) Options', 'powerpress-lite' ),
        'description' => __('Blog page option settings. ','powerpress-lite'),
        'panel' => 'general',
        'priority' => 20,
       
    )
);
$wp_customize->add_setting(
    'blogsidebar',
    array(
        'default' => '2',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'powerpress_lite_sanitize_select',
    )
);
$wp_customize->add_control(
    'blogsidebar',
    array(
        'section' => 'blogThemeOption',
        'label'      => __('Blog (Archive) : Sidebar Option', 'powerpress-lite'),
        'description' => __('Select blog page layout. Only applied to the main blog page and not individual posts.','powerpress-lite'),
        'type'       => 'select',
        'choices' => array(
          "1"   => esc_html__( "Left Sidebar", 'powerpress-lite' ),
          "2"   => esc_html__( "Right Sidebar", 'powerpress-lite' ),
          "3"   => esc_html__( "Full Sidebar", 'powerpress-lite' ),
        ),
    )
);

$wp_customize->add_setting(
    'blogMetaTag',
    array(
        'default' => '1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'powerpress_lite_sanitize_select',
    )
);
$wp_customize->add_control(
    'blogMetaTag',
    array(
        'section' => 'blogThemeOption',
        'label'      => __('Blog (Archive) :  Meta Tag Option', 'powerpress-lite'),
        'description' => __('Blog Page Meta Tag section hide or show .','powerpress-lite'),
        'type'       => 'select',
        'choices' => array(
          "1"   => esc_html__( "Show", 'powerpress-lite' ),
          "2"   => esc_html__( "Hide", 'powerpress-lite' ),      
        ),
    )
);

$wp_customize->add_setting(
    'blogPostExcerpt',
    array(
        'default' => '1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'powerpress_lite_sanitize_select',
    )
);
$wp_customize->add_control(
    'blogPostExcerpt',
    array(
        'section' => 'blogThemeOption',
        'label'      => __('Blog (Archive) : Excerpt Option', 'powerpress-lite'),
        'description' => __('Blog Page Excerpt section hide or show .','powerpress-lite'),
        'type'       => 'select',
        'choices' => array(
          "1"   => esc_html__( "Show", 'powerpress-lite' ),
          "2"   => esc_html__( "Hide", 'powerpress-lite' ),      
        ),
    )
);

$wp_customize->add_setting(
    'blogPostExcerptTextLimit',
    array(
        'default' => '20',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'blogPostExcerptTextLimit',
    array(
        'section' => 'blogThemeOption',
        'label'      => __('Blog (Archive) : Excerpt String Limit Option', 'powerpress-lite'),
        'description'      => __('Control how much content you want to show from each post on the main blog page.', 'powerpress-lite'),        
        'type'       => 'number',        
    )
);

$wp_customize->add_setting(
    'blogPostReadMore',
    array(
        'default' => '1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'powerpress_lite_sanitize_select',
    )
);
$wp_customize->add_control(
    'blogPostReadMore',
    array(
        'section' => 'blogThemeOption',
        'label'      => __('Blog (Archive) : Read More Option', 'powerpress-lite'),
        'description' => __('Blog Page Read More Button section hide or show .','powerpress-lite'),
        'type'       => 'select',
        'choices' => array(
          "1"   => esc_html__( "Show", 'powerpress-lite' ),
          "2"   => esc_html__( "Hide", 'powerpress-lite' ),      
        ),
    )
);

/*Single Post*/
$wp_customize->add_setting(
    'blogsinglesidebar',
    array(
        'default' => '2',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'powerpress_lite_sanitize_select',
    )
);
$wp_customize->add_control(
    'blogsinglesidebar',
    array(
        'section' => 'blogThemeOption',
        'label'      => __('Single Post : Sidebar Option', 'powerpress-lite'),
        'description' => __('Select Single Post layout. Only applied to individual posts.','powerpress-lite'),
        'type'       => 'select',
        'choices' => array(
          "1"   => esc_html__( "Left Sidebar", 'powerpress-lite' ),
          "2"   => esc_html__( "Right Sidebar", 'powerpress-lite' ),
          "3"   => esc_html__( "Full Sidebar", 'powerpress-lite' ),
        ),
    )
);

$wp_customize->add_setting(
    'blogSingleMetaTag',
    array(
        'default' => '1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'powerpress_lite_sanitize_select',
    )
);
$wp_customize->add_control(
    'blogSingleMetaTag',
    array(
        'section' => 'blogThemeOption',
        'label'      => __('Single Post : Meta Tag Option', 'powerpress-lite'),
        'description' => __('Single Post Meta Tag section hide or show .','powerpress-lite'),
        'type'       => 'select',
        'choices' => array(
          "1"   => esc_html__( "Show", 'powerpress-lite' ),
          "2"   => esc_html__( "Hide", 'powerpress-lite' ),      
        ),
    )
);

/*-------------------- Page Option --------------------------*/
$wp_customize->add_section(
    'pageThemeOption',
    array(
        'title' => __( 'Page Options', 'powerpress-lite' ),
        'panel' => 'general',
        'description' => __('Page option settings. ','powerpress-lite'),
        'priority' => 20,
       
    )
);

$wp_customize->add_setting(
    'pageSidebar',
    array(
        'default' => '2',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'powerpress_lite_sanitize_select',
    )
);
$wp_customize->add_control(
    'pageSidebar',
    array(
        'section' => 'pageThemeOption',
        'label'      => __('Page : Sidebar Option', 'powerpress-lite'),
        'description' => __('Select Single Page layout. Only applied to individual page.','powerpress-lite'),
        'type'       => 'select',
        'choices' => array(
          "1"   => esc_html__( "Left Sidebar", 'powerpress-lite' ),
          "2"   => esc_html__( "Right Sidebar", 'powerpress-lite' ),
          "3"   => esc_html__( "Full Sidebar", 'powerpress-lite' ),
        ),
    )
);

/*------------------------ Blog  Page option End ----------------------------*/

//Footer Section
$wp_customize->add_panel(
    'footer',
    array(
        'title' => __( 'Footer', 'powerpress-lite' ),
        'description' => __('Footer options','powerpress-lite'),
        'priority' => 105, 
    )
);
$wp_customize->add_section( 'footerWidgetArea' , array(
    'title'       => __( 'Footer Widget Area', 'powerpress-lite' ),
    'priority'    => 135,
    'capability'     => 'edit_theme_options',
    'panel' => 'footer'
) );

$wp_customize->add_section( 'footerSocialSection' , array(
    'title'       => __( 'Social Settings', 'powerpress-lite' ),
    'description' => __( 'In first input box, you need to add FONT AWESOME shortcode which you can find <a target="_blank" href="https://fortawesome.github.io/Font-Awesome/icons/">here</a> and in second input box, you need to add your social media profile URL.' , 'powerpress-lite'),
    'priority'    => 135,
    'capability'     => 'edit_theme_options',
    'panel' => 'footer'
) );
$wp_customize->add_section( 'footerCopyright' , array(
    'title'       => __( 'Footer Copyright Area', 'powerpress-lite' ),
    'priority'    => 135,
    'capability'     => 'edit_theme_options',
    'panel' => 'footer'
) );
$wp_customize->add_setting(
  'hideFooterWidgetBar',
  array(
      'default' => '1',
      'capability'     => 'edit_theme_options',
      'sanitize_callback' => 'powerpress_lite_sanitize_select',
      'priority' => 20, 
  )
);
$wp_customize->add_control(
  'hideFooterWidgetBar',
  array(
    'section' => 'footerWidgetArea',                
    'label'   => __('Hide Widget Area','powerpress-lite'),
    'type'    => 'select',
    'choices' => array(
        "1"   => esc_html__( "Show", 'powerpress-lite' ),
        "2"   => esc_html__( "Hide", 'powerpress-lite' ),
    ),
  )
);
$wp_customize->add_setting(
  'footerWidgetStyle',
  array(
      'default' => '3',
      'capability'     => 'edit_theme_options',
      'sanitize_callback' => 'powerpress_lite_sanitize_select',
      'priority' => 20, 
  )
);
$wp_customize->add_control(
  'footerWidgetStyle',
  array(
      'section' => 'footerWidgetArea',                
      'label'   => __('Select Widget Area','powerpress-lite'),
      'type'    => 'select',
      'choices'        => array(
          "1"   => esc_html__( "2 column", 'powerpress-lite' ),
          "2"   => esc_html__( "3 column", 'powerpress-lite' ),
          "3"   => esc_html__( "4 column", 'powerpress-lite' )
      ),
  )
);

$wp_customize->add_setting(
    'CopyrightAreaText',
    array(
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'wp_kses_post',
        'priority' => 20, 
    )
);
$wp_customize->add_control(
    'CopyrightAreaText',
    array(
        'section' => 'footerCopyright',                
        'label'   => __('Enter Copyright Text','powerpress-lite'),
        'type'    => 'textarea',
    )
);

}
add_action( 'customize_register', 'powerpress_lite_customize_register' );

function powerpress_lite_custom_css(){
  $themepre_set_color = get_theme_mod('text_pre_set_color',1);
  if($themepre_set_color==2 || $themepre_set_color==4){
     wp_enqueue_style( 'powerpress_lite_additional_css_style',get_template_directory_uri() . '/assets/css/additional-css.css', array());
  }
  wp_enqueue_style( 'powerpress_lite_style', get_stylesheet_uri() );
  $custom_css='';

  $custom_css.='
  .btn-lightborder:focus,.btn-lightborder:hover,.page-numbers:focus,.page-numbers:hover,.menu-left li:hover {
    border-left: 5px solid '.esc_attr(get_theme_mod('themeColor','#ff4e00')).';
  }
  .menu-left h6, .text-center p a, .text-center h3 a, .title-data h2 a, .page-numbers:hover, .menu-left li:hover a, .comment .comment-reply-link:hover {
    color: '.esc_attr(get_theme_mod('themeColor','#ff4e00')).';
  }
  .comment .comment-reply-link{
    color:'.esc_attr(get_theme_mod('secondaryColor','#000000')).';
  }
  .post-list .post-box .text-center p a.btn-light{
    background: '.esc_attr(get_theme_mod('themeColor','#ff4e00')).';
  }
  
  .comment-form input:focus,.comment-form textarea:focus {
    border-color: '.esc_attr(get_theme_mod('themeColor','#ff4e00')).';
  }
  .search-submit:hover {
    background: '.esc_attr(get_theme_mod('themeColor','#ff4e00')).';
  }
  .content-footer, .menu-left h6::before, .search-submit, .blog-menu-area .tagcloud a:hover {
    background-color: '.esc_attr(get_theme_mod('secondaryColor','#000000')).';
  }
  .blog-menu-area .tagcloud a:hover{
      border-color: '.esc_attr(get_theme_mod('secondaryColor','#000000')).';
  }
  *::-moz-selection {
    background: '.esc_attr(get_theme_mod('themeColor','#ff4e00')).';
  }

  *::selection {
      background-color: '.esc_attr(get_theme_mod('themeColor','#ff4e00')).';
  }
  .logo img { 
    max-height: '.esc_attr(get_theme_mod('theme_logo_height',50)).'px;
  }
   /* Menu Css Cutomization */
    
      /*main top menu text color*/
      #cssmenu > ul > li > a {
        color: '.esc_attr(get_theme_mod('menuTextColor','#ffffff')).';
      }

      /*sub menu text color*/

      #cssmenu ul ul li a {
        color: '.esc_attr(get_theme_mod('menuTextColor','#ffffff')).';
      }

      /*main top menu text Scroll color*/

      .fixed-header #cssmenu > ul > li > a {
        color: '.esc_attr(get_theme_mod('menuTextColorScroll','#ffffff')).';
      }

      /*sub menu text Scroll color*/
       .fixed-header #cssmenu ul ul li a {
        color: '.esc_attr(get_theme_mod('menuTextColorScroll','#ffffff')).';
      }

      /*sub menu background color*/
       #cssmenu ul ul li a
       {
        background-color: '.get_theme_mod('secondaryColor','#000000').';
      }

      /*sub menu Scroll background color*/
      .fixed-header #cssmenu ul ul li a
       {
        background-color: '.get_theme_mod('menuBackgroundColorScroll','#ffffff').';
      } 

      /*sub menu background hover color*/
       #cssmenu ul ul li a:hover
       {
        background-color: '.get_theme_mod('themeColor','#ff4e00').';
      }       

      /*all top menu hover effect border color*/

      #cssmenu > ul > li:hover > a, #cssmenu > ul > li.current-menu-item a
        {
           border-color: '.esc_attr(get_theme_mod('themeColor','#ff4e00')).';
        }
      
      
      @media only screen and (max-width: 1024px){
        
      /*all menu arrow background border color*/
      
      #cssmenu #menu-button span, #cssmenu #menu-button.menu-opened span:nth-child(1), #cssmenu #menu-button.menu-opened span:nth-child(6), #cssmenu #menu-button.menu-opened span:nth-child(2), #cssmenu #menu-button.menu-opened span:nth-child(5)
        {
          background-color: '.get_theme_mod('menuTextColor','#ffffff').';
        }

      /*all menu scroll arrow background border color*/
      
      .fixed-header #cssmenu #menu-button span, .fixed-header #cssmenu #menu-button.menu-opened span:nth-child(1), .fixed-header #cssmenu #menu-button.menu-opened span:nth-child(6), .fixed-header #cssmenu #menu-button.menu-opened span:nth-child(2), .fixed-header #cssmenu #menu-button.menu-opened span:nth-child(5), #cssmenu .submenu-button::after, #cssmenu .submenu-button::before
        {
          background-color: '.get_theme_mod('menuTextColorScroll','#ffffff').';
        } 


      /*mobile menu background color*/

      #cssmenu > ul > li > a, #cssmenu ul ul li a
        { 
           background-color: '.get_theme_mod('menuBackgroundColorScroll','#ffffff').';
           color: '.esc_attr(get_theme_mod('menuTextColorScroll','#4d4d4d')).';
        }      

      #cssmenu > ul > li > a:hover
        {
           background-color: '.get_theme_mod('themeColor','#ff4e00').';
        }
      .fixed-header #cssmenu > ul > li > a {
        background-color: '.get_theme_mod('themeColor','#ff4e00').';
      }
      }
      /*  Menu Css Cutomization */
  .fixed-header {background: '.esc_attr(get_theme_mod('menuBackgroundColorScroll','#ff4e00')).';}
  body {
      color : '.esc_attr(get_theme_mod('bodyTextColor','#4d4d4d')).';
      background: '.esc_attr(get_theme_mod('bodyBackgroundColor','#ffffff')).';
  }
  .footer-box {
    background-color: '.esc_attr(get_theme_mod('footerBackgroundColor','#000000')).';
  }
  .footer-box div, .footer-box .widget-title, .footer-box p, .footer-box .textwidget p, .footer-box div, .footer-box h1, .footer-box h2, .footer-box h3, .footer-box h4, .footer-box h5, .footer-box h6, .footer-box .calendar_wrap caption, .footer-box tfoot a, .footer-box .tagcloud > a, .footer-box .tagcloud > a:hover{
    color: '.esc_attr(get_theme_mod('footerTextColor','#ffffff')).';
  }
  .footer-box .tagcloud > a{
    border-color: '.esc_attr(get_theme_mod('footerTextColor','#ffffff')).';
  }
  .footer-box .footer-widget ul li a {
    color: '.esc_attr(get_theme_mod('footerLinkColor','#ffffff')).';
  }
  .footer-widget button.search-submit, .footer-box .tagcloud > a:hover{
     background-color: '.esc_attr(get_theme_mod('footerLinkHoverColor','#ff4e00')).';
  }
  .footer-widget button.search-submit:hover{
    color: '.esc_attr(get_theme_mod('footerBackgroundColor','#000000')).';
  }
  .footer-box .footer-widget ul li a:hover, .footer-box tfoot a:hover, .footer-widget h6::after{
    color: '.esc_attr(get_theme_mod('footerLinkHoverColor','#ff4e00')).';
  }
  .footer-wrap {
    background-color: '.esc_attr(get_theme_mod('copyrightBackgroundColor','#ff4e00')).';
  }
  .copyright.fadeIn.animated p, .powered-by.fadeIn.animated p {
    color: '.esc_attr(get_theme_mod('copyrightTextColor','#ffffff')).';
  }
  .copyright.fadeIn.animated p a,
  .footer-social-icon ul li a, .powered-by.fadeIn.animated p a {
    color: '.esc_attr(get_theme_mod('copyrightLinkColor','#ffffff')).';
  }
  .copyright.fadeIn.animated p a:hover,
  .footer-social-icon ul li a:hover, .powered-by.fadeIn.animated p a:hover {
    color: '.esc_attr(get_theme_mod('copyrightLinkHoverColor','#000')).';
  }
  ';
  if(has_header_image()){
        $url = get_header_image();
        $custom_css .= ".blog-heading-wrap {background-image:url(".esc_url_raw($url).");}";
    }
  
  wp_add_inline_style( 'powerpress_lite_style', $custom_css ); 

  $script_js = '';
  if(get_theme_mod('theme_header_fix',0))
  {
    $script_js .="jQuery(window).scroll(function () {
    if (jQuery(window).scrollTop() > 200) {
        jQuery('#powerpress_lite_navigation').addClass('fixed-header'); 

    } else {
        jQuery('#powerpress_lite_navigation').removeClass('fixed-header');
        //if title hide then change menu
        if(!jQuery('div').hasClass('heading-layer')){
            jQuery('#powerpress_lite_navigation').addClass('fixed-header');
        }
        if(jQuery('div').hasClass('transparent') || jQuery('div').hasClass('no-transparent')){
            jQuery('#powerpress_lite_navigation').removeClass('fixed-header');
        }
    }
  });";
  }

  wp_add_inline_script( 'powerpress-lite-script-header-style', $script_js );
}
function powerpress_lite_customize_scripts() {
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() .'/assets/css/font-awesome.css');   
    wp_enqueue_style( 'powerpress-lite-admin-style',get_template_directory_uri().'/assets/css/admin.css', '1.0', 'screen' );    
    wp_enqueue_script( 'powerpress-lite-admin-js', get_template_directory_uri().'/assets/js/admin.js', array( 'jquery' ), '', true );
}
add_action( 'customize_controls_enqueue_scripts', 'powerpress_lite_customize_scripts' );