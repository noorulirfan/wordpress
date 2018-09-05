<?php
/**
 * DesignStudio functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 */

require_once( trailingslashit( get_template_directory() ) . 'inc/customize-pro/class-customize.php' );

if ( ! function_exists( 'designstudio_setup' ) ) :
	/**
	 * DesignStudio setup.
	 *
	 * Set up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support post thumbnails.
	 *
	 */
	function designstudio_setup() {

		/*
		 * Make theme available for translation.
		 *
		 * Translations can be filed in the /languages/ directory
		 *
		 * If you're building a theme based on DesignStudio, use a find and replace
		 * to change 'designstudio' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'designstudio' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 */
		add_theme_support( 'post-thumbnails' );

		add_image_size( 'designstudio-thumbnail-avatar', 100, 100, true );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, and column width.
	 	 */
		add_editor_style( array( 'assets/css/editor-style.css', 
								 get_template_directory_uri() . '/assets/css/font-awesome.css',
								 designstudio_fonts_url()
						  ) );

		/*
		 * Set Custom Background
		 */				 
		add_theme_support( 'custom-background', array ('default-color'  => '#ffffff') );

		// Set the default content width.
		$GLOBALS['content_width'] = 900;

		// This theme uses wp_nav_menu() in header menu
		register_nav_menus( array(
			'primary'   => __( 'Primary Menu', 'designstudio' ),
			'footer'    => __( 'Footer Menu', 'designstudio' ),
		) );

		$defaults = array(
	        'flex-height' => false,
	        'flex-width'  => false,
	        'header-text' => array( 'site-title', 'site-description' ),
	    );
	    add_theme_support( 'custom-logo', $defaults );
	}
endif; // designstudio_setup
add_action( 'after_setup_theme', 'designstudio_setup' );

if ( ! function_exists( 'designstudio_fonts_url' ) ) :
	/**
	 *	Load google font url used in the DesignStudio theme
	 */
	function designstudio_fonts_url() {

	    $fonts_url = '';
	 
	    /* Translators: If there are characters in your language that are not
	    * supported by Questrial, translate this to 'off'. Do not translate
	    * into your own language.
	    */
	    $questrial = _x( 'on', 'Questrial font: on or off', 'designstudio' );

	    if ( 'off' !== $questrial ) {
	        $font_families = array();
	 
	        $font_families[] = 'Raleway';
	 
	        $query_args = array(
	            'family' => urlencode( implode( '|', $font_families ) ),
	        );
	 
	        $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
	    }
	 
	    return $fonts_url;
	}
endif; // designstudio_fonts_url

if ( ! function_exists( 'designstudio_load_scripts' ) ) :
	/**
	 * the main function to load scripts in the DesignStudio theme
	 * if you add a new load of script, style, etc. you can use that function
	 * instead of adding a new wp_enqueue_scripts action for it.
	 */
	function designstudio_load_scripts() {

		// load main stylesheet.
		wp_enqueue_style( 'font-awesome',
			get_template_directory_uri() . '/assets/css/font-awesome.css', array( ) );

		wp_enqueue_style( 'animate-css',
			get_template_directory_uri() . '/assets/css/animate.css', array( ) );

		wp_enqueue_style( 'designstudio-style', get_stylesheet_uri(), array() );
		
		wp_enqueue_style( 'designstudio-fonts', designstudio_fonts_url(), array(), null );
		
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		wp_enqueue_script( 'viewportchecker',
			get_template_directory_uri() . '/assets/js/viewportchecker.js',
			array( 'jquery' ) );

		// Load Slider JS Scripts
		wp_enqueue_script( 'modernizr.custom.26887',
			get_template_directory_uri() . '/assets/js/modernizr.custom.26887.min.js',
			array( 'jquery' ) );

		wp_enqueue_script( 'jquery.imgslider',
			get_template_directory_uri() . '/assets/js/jquery.imgslider.js',
			array( 'jquery', 'modernizr.custom.26887', ) );
		
		// Load Utilities JS Script
		wp_enqueue_script( 'designstudio-utilities',
			get_template_directory_uri() . '/assets/js/utilities.js',
			array( 'jquery', 'viewportchecker', 'jquery.imgslider', ) );

		$data = array(
	        'loading_effect' => ( get_theme_mod('designstudio_animations_display', 1) == 1 ),
	    );
	    wp_localize_script('designstudio-utilities', 'designstudio_options', $data);
	}
endif; // designstudio_load_scripts
add_action( 'wp_enqueue_scripts', 'designstudio_load_scripts' );

if ( ! function_exists( 'designstudio_widgets_init' ) ) :
	/**
	 *	widgets-init action handler. Used to register widgets and register widget areas
	 */
	function designstudio_widgets_init() {
		
		// Register Sidebar Widget.
		register_sidebar( array (
							'name'	 		 =>	 __( 'Sidebar Widget Area', 'designstudio'),
							'id'		 	 =>	 'sidebar-widget-area',
							'description'	 =>  __( 'The sidebar widget area', 'designstudio'),
							'before_widget'	 =>  '',
							'after_widget'	 =>  '',
							'before_title'	 =>  '<div class="sidebar-before-title"></div><h3 class="sidebar-title">',
							'after_title'	 =>  '</h3><div class="sidebar-after-title"></div>',
						) );

		/**
		 * Add Homepage Columns Widget areas
		 */
		register_sidebar( array (
								'name'			 =>  __( 'Homepage Column #1', 'designstudio' ),
								'id' 			 =>  'homepage-column-1-widget-area',
								'description'	 =>  __( 'The Homepage Column #1 widget area', 'designstudio' ),
								'before_widget'  =>  '',
								'after_widget'	 =>  '',
								'before_title'	 =>  '<h2 class="sidebar-title">',
								'after_title'	 =>  '</h2><div class="sidebar-after-title"></div>',
							) );
							
		register_sidebar( array (
								'name'			 =>  __( 'Homepage Column #2', 'designstudio' ),
								'id' 			 =>  'homepage-column-2-widget-area',
								'description'	 =>  __( 'The Homepage Column #2 widget area', 'designstudio' ),
								'before_widget'  =>  '',
								'after_widget'	 =>  '',
								'before_title'	 =>  '<h2 class="sidebar-title">',
								'after_title'	 =>  '</h2><div class="sidebar-after-title"></div>',
							) );

		register_sidebar( array (
								'name'			 =>  __( 'Homepage Column #3', 'designstudio' ),
								'id' 			 =>  'homepage-column-3-widget-area',
								'description'	 =>  __( 'The Homepage Column #3 widget area', 'designstudio' ),
								'before_widget'  =>  '',
								'after_widget'	 =>  '',
								'before_title'	 =>  '<h2 class="sidebar-title">',
								'after_title'	 =>  '</h2><div class="sidebar-after-title"></div>',
							) );

		// Register Footer Column #1
		register_sidebar( array (
								'name'			 =>  __( 'Footer Column #1', 'designstudio' ),
								'id' 			 =>  'footer-column-1-widget-area',
								'description'	 =>  __( 'The Footer Column #1 widget area', 'designstudio' ),
								'before_widget'  =>  '',
								'after_widget'	 =>  '',
								'before_title'	 =>  '<h2 class="footer-title">',
								'after_title'	 =>  '</h2><div class="footer-after-title"></div>',
							) );
		
		// Register Footer Column #2
		register_sidebar( array (
								'name'			 =>  __( 'Footer Column #2', 'designstudio' ),
								'id' 			 =>  'footer-column-2-widget-area',
								'description'	 =>  __( 'The Footer Column #2 widget area', 'designstudio' ),
								'before_widget'  =>  '',
								'after_widget'	 =>  '',
								'before_title'	 =>  '<h2 class="footer-title">',
								'after_title'	 =>  '</h2><div class="footer-after-title"></div>',
							) );
		
		// Register Footer Column #3
		register_sidebar( array (
								'name'			 =>  __( 'Footer Column #3', 'designstudio' ),
								'id' 			 =>  'footer-column-3-widget-area',
								'description'	 =>  __( 'The Footer Column #3 widget area', 'designstudio' ),
								'before_widget'  =>  '',
								'after_widget'	 =>  '',
								'before_title'	 =>  '<h2 class="footer-title">',
								'after_title'	 =>  '</h2><div class="footer-after-title"></div>',
							) );
	}
endif; // designstudio_widgets_init
add_action( 'widgets_init', 'designstudio_widgets_init' );

if ( ! function_exists( 'designstudio_show_copyright_text' ) ) :
	/**
	 *	Displays the copyright text.
	 */
	function designstudio_show_copyright_text() {

		$footerText = get_theme_mod('designstudio_footer_copyright', null);

		if ( !empty( $footerText ) ) {

			echo esc_html( $footerText ) . ' | ';		
		}
	}
endif; // designstudio_show_copyright_text

if ( ! function_exists( 'designstudio_display_slider' ) ) :
	/**
	 * Displays the slider
	 */
	function designstudio_display_slider() { ?>
		 
		<div class="fs-slider" id="fs-slider">
			<?php
				// display slides
				for ( $i = 1; $i <= 5; ++$i ) {
				
						$defaultSlideImage = get_template_directory_uri().'/images/slider/' . $i .'.jpg';
						$slideImage = get_theme_mod( 'designstudio_slide'.$i.'_image', $defaultSlideImage );
					?>
						<figure>
							<img src="<?php echo esc_url( $slideImage ); ?>" />
						</figure>
	<?php		} ?>
		</div><!-- #fs-slider -->
	<?php  
	}
endif; // designstudio_display_slider

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Plugin Recommendation
*/
require get_template_directory() . '/inc/tgmpa/recommended-plugins.php';

