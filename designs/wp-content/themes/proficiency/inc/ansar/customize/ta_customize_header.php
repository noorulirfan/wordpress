<?php function proficiency_header_setting( $wp_customize ) {
$wp_customize->remove_control('header_textcolor');
/*
     * Failsafe is safe
     */
    if ( ! isset( $wp_customize ) ) {
        return;
    }
    
    /**
     * Create a Radio-Image control
     * 
     * This class incorporates code from the Kirki Customizer Framework and from a tutorial
     * written by Otto Wood.
     * 
     * The Kirki Customizer Framework, Copyright Aristeides Stathopoulos (@aristath),
     * is licensed under the terms of the GNU GPL, Version 2 (or later).
     * 
     * @link https://github.com/reduxframework/kirki/
     * @link http://ottopress.com/2012/making-a-custom-control-for-the-theme-customizer/
     */
    class proficiency_Custom_Radio_Image_Control extends WP_Customize_Control {
        
        /**
         * Declare the control type.
         *
         * @access public
         * @var string
         */
        public $type = 'radio-image';
        
        /**
         * Enqueue scripts and styles for the custom control.
         * 
         * Scripts are hooked at {@see 'customize_controls_enqueue_scripts'}.
         * 
         * Note, you can also enqueue stylesheets here as well. Stylesheets are hooked
         * at 'customize_controls_print_styles'.
         *
         * @access public
         */
        public function enqueue() {
            wp_enqueue_script( 'jquery-ui-button' );
        }
        
        /**
         * Render the control to be displayed in the Customizer.
         */
        public function render_content() {
            if ( empty( $this->choices ) ) {
                return;
            }           
            
            $name = '_customize-radio-' . $this->id;
            ?>
            <span class="customize-control-title">
                <?php echo esc_attr( $this->label ); ?>
                <?php if ( ! empty( $this->description ) ) : ?>
                    <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                <?php endif; ?>
            </span>
            <div id="input_<?php echo $this->id; ?>" class="image">
                <?php foreach ( $this->choices as $value => $label ) : ?>
                    <input class="image-select" type="radio" value="<?php echo esc_attr( $value ); ?>" id="<?php echo $this->id . $value; ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?>>
                        <label for="<?php echo $this->id . $value; ?>">
                            <img src="<?php echo esc_html( $label ); ?>" alt="<?php echo esc_attr( $value ); ?>" title="<?php echo esc_attr( $value ); ?>">
                        </label>
                    </input>
                <?php endforeach; ?>
            </div>
            <script>jQuery(document).ready(function($) { $( '[id="input_<?php echo $this->id; ?>"]' ).buttonset(); });</script>
            <?php
        }
    }
    
    
    /**
     * Radio Image control.
     *
     * - Control: Radio Image
     * - Setting: Blog Layout
     * - Sanitization: select
     * 
     * Register "Theme_Slug_Custom_Radio_Image_Control" to be  used to configure
     * the Blog Posts Index Layout setting.
     * 
     * @uses $wp_customize->add_control() https://developer.wordpress.org/reference/classes/wp_customize_manager/add_control/
     * @link $wp_customize->add_control() https://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
     */

/* Header Section */
    $wp_customize->add_panel( 'header_options', array(
        'priority' => 450,
        'capability' => 'edit_theme_options',
        'title' => __('Header Settings', 'proficiency'),
    ) );
   
    $wp_customize->add_section( 'header_contact' , array(
        'title' => __('Header Info Details Setting', 'proficiency'),
        'panel' => 'header_options',
    ) );
   
    $wp_customize->add_setting(
        'proficiency_head_info_one', array(
        'default' => __('<a><i class="fa fa-clock-o "></i>Open-Hours:10 am to 7pm</a>','proficiency'),
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'proficiency_head_info_one', array(
        'label' => __('Info One:', 'proficiency'),
        'section' => 'header_contact',
        'type' => 'textarea',
    ) );
   
   
    $wp_customize->add_setting(
        'proficiency_head_info_two', array(
        'default' => __('<a href="mailto:info@themeansar.com" title="Mail Me"><i class="fa fa-envelope"></i> info@themeansar.com</a>','proficiency'),
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'proficiency_head_info_two', array(
        'label' => __('Info Two:', 'proficiency'),
        'section' => 'header_contact',
        'type' => 'textarea',
    ) );

    $wp_customize->add_section( 'header_contact' , array(
        'title' => __('Header Top Bar Setting', 'proficiency'),
        'panel' => 'header_options',
    ) );
    
    $wp_customize->add_setting(
        'proficiency_topbar_enable', array(
        'default'        => 'true',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'proficiency_topbar_enable', array(
        'label'   => __('Hide/Show Topbar', 'proficiency'),
        'section' => 'header_contact',
        'type'    => 'radio',
        'choices'=>array('true'=>'On','false'=>'Off'),
    ) );
   
    // add Search Bar Setting
 
    $wp_customize->add_section( 'search_bar_setting' , array(
        'title' => __('Search Bar Setting', 'proficiency'),
        'panel' => 'header_options',
        'priority'    => 600,
    ) );
 
   
    //Search bar hide/show
    $wp_customize->add_setting(
    'enable_search_bar',array(
    'default' => 'true',
    'sanitize_callback'=>'proficiency_header_sanitize_checkbox',
    ) );
 
    $wp_customize->add_control( 'enable_search_bar', array(
        'type' => 'checkbox',
        'label' => __('Hide/Show Search Bar','proficiency'),
        'section' => 'search_bar_setting',
         ) );
   
   
    $wp_customize->add_setting(
        'search_bar_placeholder_setting', array(
        'default' => __('Search Here','proficiency'),
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    ) );  
    $wp_customize->add_control(
        'search_bar_placeholder_setting', array(
        'label' => __('Search Bar Placeholder Label','proficiency'),
        'section' => 'search_bar_setting',
        'type' => 'text',
    ) );
 
    $wp_customize->add_setting(
        'search_bar_button_setting', array(
        'default' => __('<i class="fa fa-search"></i>','proficiency'),
        'capability'     => 'edit_theme_options',
        'sanitize_callback'=>'sanitize_text_field',
    ) );  
    $wp_customize->add_control(
        'search_bar_button_setting',array(
        'label'   => __('Search Bar Button Change Label and Icon','proficiency'),
        'section' => 'search_bar_setting',
        'type' => 'text',
    ) );
   
   
    function proficiency_header_sanitize_checkbox( $input ) {
    // Boolean check
    return ( ( isset( $input ) && true == $input ) ? true : false );
    }
 
 }
    add_action( 'customize_register', 'proficiency_header_setting' );
?>