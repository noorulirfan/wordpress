<?php
//Pro Button

function proficiency_pro_customizer( $wp_customize ) {
    class WP_Pro_Customize_Control extends WP_Customize_Control {
    public $type = 'new_menu';
    /**
    * Render the control's content.
    */
    public function render_content() {
    ?>
     <div class="pro-box">
       <a href="<?php echo esc_url( __('http://themeansar.com/themes/', 'proficiency'));?>" target="_blank" class="upgrade" id="review_pro"><?php _e( 'Explore Our Themes','proficiency' ); ?></a>
		
	</div>
    <?php
    }
}
    $wp_customize->add_section( 'proficiency_pro_section' , array(
		'title' => __('Themeansar Store', 'proficiency'),
		'priority' => 2100,
   	) );

    $wp_customize->add_setting('upgrade_pro', array(
        'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new WP_Pro_Customize_Control( $wp_customize, 'upgrade_pro', array(
		'label' => __('Discover proficiency Pro','proficiency'),
        'section' => 'proficiency_pro_section',
		'setting' => 'upgrade_pro',)
    ) );

class WP_Review_Customize_Control extends WP_Customize_Control {
    public $type = 'new_menu';
    /**
    * Render the control's content.
    */
    public function render_content() {
    ?>
	<div class="pro-box">
        <a href="<?php echo esc_url( __('https://wordpress.org/support/theme/proficiency', 'proficiency'));?>" target="_blank" class="review" id="review_pro"><?php _e( 'Support Form','proficiency' ); ?></a>
	</div>
    <?php
    }
}

    $wp_customize->add_setting( 'pro_Review', array(
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( new WP_Review_Customize_Control( $wp_customize, 'pro_Review', array(	
		'label' => __('Discover proficiency Pro','proficiency'),
        'section' => 'proficiency_pro_section',
		'setting' => 'pro_Review',)
    ) );

class WP_document_Customize_Control extends WP_Customize_Control {
    public $type = 'new_menu';
    /**
    * Render the control's content.
    */
    public function render_content() {
    ?>
      <div class="pro-box">
	 <a href="<?php echo esc_url( __('http://docs.themeansar.com/', 'proficiency'));?>" target="_blank" class="document" id="review_pro"><?php _e( 'Online Documenation','proficiency' ); ?></a>
	 
	 <div>
    <?php
    }
}

    $wp_customize->add_setting( 'doc_Review', array(
        'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( new WP_document_Customize_Control( $wp_customize, 'doc_Review', array(	
		'label' => __('Discover proficiency Pro','proficiency'),
        'section' => 'proficiency_pro_section',
		'setting' => 'doc_Review',)
    ) );

}
add_action( 'customize_register', 'proficiency_pro_customizer' );
?>