<?php
/**
 * proficiency functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package proficiency
 */


	$proficiency_theme_path = get_template_directory() . '/inc/ansar/';

	require( $proficiency_theme_path . '/widget/proficiency-service.php');
	require( $proficiency_theme_path . '/widget/proficiency-contact.php');
	require( $proficiency_theme_path . '/widget/proficiency-slider.php');
	require( $proficiency_theme_path . 'proficiency_nav_walker.php' );
	require( $proficiency_theme_path .'default_menu_walker.php');
	require( $proficiency_theme_path . '/widget/proficiency-custom.php');
	
	
	require( $proficiency_theme_path . '/font/font.php');

	/*-----------------------------------------------------------------------------------*/
	/*	Enqueue scripts and styles.
	/*-----------------------------------------------------------------------------------*/
	require( $proficiency_theme_path .'/enqueue.php');
	/* ----------------------------------------------------------------------------------- */
	/* Customizer */
	/* ----------------------------------------------------------------------------------- */
	
	require( $proficiency_theme_path . '/customize/ta_customize_copyright.php');
	require( $proficiency_theme_path  . '/customize/ta_customize_header.php');
	require( $proficiency_theme_path . '/customize/ta_customize_homepage.php');
	require( $proficiency_theme_path . '/customize/ta_customize_pro.php');
	require( $proficiency_theme_path . '/customize/ta_customize_selective.php');
	require( $proficiency_theme_path . '/icon-functions.php');
	require_once( get_template_directory() . '/wp-pre-image/demo-priview.php' );
	require( get_template_directory() . '/proficiency-info/theme-info.php');
	
	

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function proficiency_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on proficiency, use a find and replace
	 * to change 'proficiency' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'proficiency', get_template_directory() . '/languages' );

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
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary menu', 'proficiency' ),
		'social' => __( 'Social Links Menu', 'proficiency' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'proficiency_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

    // Set up the woocommerce feature.
    add_theme_support( 'woocommerce');
	
	
	//Custom logo
	add_theme_support( 'custom-logo');

}
add_action( 'after_setup_theme', 'proficiency_setup' );


function proficiency_the_custom_logo() {
	
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}

	}

	add_filter('get_custom_logo','proficiency_logo_class');


	function proficiency_logo_class($html)
	{
	$html = str_replace('custom-logo-link', 'navbar-brand', $html);
	return $html;
	}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function proficiency_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'proficiency_content_width', 640 );
}
add_action( 'after_setup_theme', 'proficiency_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function proficiency_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'proficiency' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="proficiency-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6>',
		'after_title'   => '</h6>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area', 'proficiency' ),
		'id'            => 'footer_widget_area',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="col-md-3 col-sm-6 rotateInDownLeft animated proficiency-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6>',
		'after_title'   => '</h6>',
	) );

}
add_action( 'widgets_init', 'proficiency_widgets_init' );


add_action('widgets_init', 'proficiency_register_widgets');

function proficiency_register_widgets() {    

    register_widget('proficiency_service_widget');
	register_widget('proficiency_slider_widget');
	register_widget('proficiency_custom_widget');
	
	
	$proficiency_sidebars = array ( 'sidebar-slider' => 'sidebar-slider','sidebar-service' => 'sidebar-service' , 'sidebar-contact' => 'sidebar-contact',  );
	
	/* Register sidebars */
	foreach ( $proficiency_sidebars as $proficiency_sidebar ):
	
		
		if( $proficiency_sidebar == 'sidebar-slider' ):
        
            $proficiency_name = __('Slider Section Widgets', 'proficiency');
			
		elseif( $proficiency_sidebar == 'sidebar-service' ):
        
            $proficiency_name = __('Service Section Widgets', 'proficiency');

		elseif( $proficiency_sidebar == 'sidebar-contact' ):
        
            $proficiency_name = __('Contact Section Widgets', 'proficiency');
			
		else:
		
			$proficiency_name = $proficiency_sidebar;
			
		endif;
		
        register_sidebar(
            array (
                'name'          => $proficiency_name,
                'id'            => $proficiency_sidebar,
                'before_widget' => '<div id="%1$s" class="ta-widget %2$s">',
                'after_widget'  => '</div>'
            )
        );
		
    endforeach;
	
}
add_action( 'wp_enqueue_scripts', 'proficiency_scripts' );

function proficiency_enqueue_customizer_controls_styles() {
  wp_register_style( 'proficiency-customizer-controls', get_template_directory_uri() . '/css/customizer-controls.css', NULL, NULL, 'all' );
  wp_enqueue_style( 'proficiency-customizer-controls' );
  }
add_action( 'customize_controls_print_styles', 'proficiency_enqueue_customizer_controls_styles' );



/* Custom template tags for this theme. */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Replace excerpt "Read More" text with a link.
 */
function proficiency_excerpt_more( $more ) {
	global $post;
	if ( ( ( 'page' === get_option( 'show_on_front' ) ) ) || is_single() || is_archive() || is_home() ) {
		return '<a class="moretag" href="' . esc_url( get_permalink( $post->ID ) ) . '"> ' . esc_html__( 'Read more', 'proficiency' ) . '</a>';
	}
	return $more;
}
add_filter( 'excerpt_more', 'proficiency_excerpt_more' );

// display custom admin notice
function proficiency_custom_admin_notice() { ?>
	
		<div class="notice notice-success is-dismissible">
		<h3>How to Create homepage like this <a href="<?php echo esc_url('https://themeansar.com/demo/wp/proficiency/default/'); ?>"> link </a> following <a href="<?php echo  esc_url( admin_url( 'themes.php?page=proficiency-info' ) ); ?>"> Documentaion </a></h3>
		</div>
		
		<div class="notice notice-success is-dismissible">
		<h3>Use all the sections of the homepage while using  <a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>">  customize settings </a></h3>
		</div>
		
	
<?php }
add_action('admin_notices', 'proficiency_custom_admin_notice');