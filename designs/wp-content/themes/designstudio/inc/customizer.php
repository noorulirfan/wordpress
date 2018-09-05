<?php

if ( ! function_exists( 'designstudio_sanitize_checkbox' ) ) :
	/**
	 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
	 * as a boolean value, either TRUE or FALSE.
	 *
	 * @param bool $checked Whether the checkbox is checked.
	 * @return bool Whether the checkbox is checked.
	 */
	function designstudio_sanitize_checkbox( $checked ) {
		// Boolean check.
		return ( ( isset( $checked ) && true == $checked ) ? true : false );
	}
endif; // designstudio_sanitize_checkbox

if ( ! function_exists( 'designstudio_customize_register' ) ) :
	/**
	 * Add postMessage support for site title and description for the Theme Customizer.
	 *
	 */
	function designstudio_customize_register( $wp_customize ) {

		/**
		 * Add Slider Section
		 */
		$wp_customize->add_section(
			'designstudio_slider_section',
			array(
				'title'       => __( 'Slider', 'designstudio' ),
				'capability'  => 'edit_theme_options',
			)
		);

		$wp_customize->add_setting(
				'designstudio_slider_display',
				array(
						'default'           => 0,
						'sanitize_callback' => 'designstudio_sanitize_checkbox',
				)
		);

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'designstudio_slider_display',
								array(
									'label'          => __( 'Display Slider', 'designstudio' ),
									'section'        => 'designstudio_slider_section',
									'settings'       => 'designstudio_slider_display',
									'type'           => 'checkbox',
								)
							)
		);
		
		for ($i = 1; $i <= 5; ++$i) {
		
			$slideImageId = 'designstudio_slide'.$i.'_image';
			$defaultSliderImagePath = get_template_directory_uri().'/images/slider/'.$i.'.jpg';
			
			// Add Slide Background Image
			$wp_customize->add_setting( $slideImageId,
				array(
					'default' => $defaultSliderImagePath,
					'sanitize_callback' => 'esc_url_raw'
				)
			);

			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $slideImageId,
					array(
						'label'   	 => sprintf( esc_html__( 'Slide #%s Image', 'designstudio' ), $i ),
						'section' 	 => 'designstudio_slider_section',
						'settings'   => $slideImageId,
					) 
				)
			);
		}

		/**
	     * Add Animations Section
	     */
	    $wp_customize->add_section(
	        'designstudio_animations_display',
	        array(
	            'title'       => __( 'Animations', 'designstudio' ),
	            'capability'  => 'edit_theme_options',
	        )
	    );

	    // Add display Animations option
	    $wp_customize->add_setting(
	            'designstudio_animations_display',
	            array(
	                    'default'           => 1,
	                    'sanitize_callback' => 'designstudio_sanitize_checkbox',
	            )
	    );

	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize,
	                        'designstudio_animations_display',
	                            array(
	                                'label'          => __( 'Enable Animations', 'designstudio' ),
	                                'section'        => 'designstudio_animations_display',
	                                'settings'       => 'designstudio_animations_display',
	                                'type'           => 'checkbox',
	                            )
	                        )
	    );

		/**
		 * Add Footer Section
		 */
		$wp_customize->add_section(
			'designstudio_footer_section',
			array(
				'title'       => __( 'Footer', 'designstudio' ),
				'capability'  => 'edit_theme_options',
			)
		);
		
		// Add Footer Copyright Text
		$wp_customize->add_setting(
			'designstudio_footer_copyright',
			array(
			    'default'           => '',
			    'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'designstudio_footer_copyright',
	        array(
	            'label'          => __( 'Copyright Text', 'designstudio' ),
	            'section'        => 'designstudio_footer_section',
	            'settings'       => 'designstudio_footer_copyright',
	            'type'           => 'text',
	            )
	        )
		);
	}
endif; // designstudio_customize_register
add_action( 'customize_register', 'designstudio_customize_register' );
