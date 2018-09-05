<?php
/*
* Set up the content width value based on the theme's design.
*/                                                             

if (!function_exists('powerpress_lite_setup')) :
    function powerpress_lite_setup() {
        global $content_width;
        if (!isset($content_width)) {
            $content_width = 870;
        }
        // Make powerpress_lite theme available for translation.
        load_theme_textdomain('powerpress-lite', get_template_directory() . '/languages');

        // Add RSS feed links to <head> for posts and comments.
        add_theme_support('automatic-feed-links');

        // register menu 
        register_nav_menus(array(
            'primary' => __('Top Header Menu', 'powerpress-lite'),
        ));
        // Featured image support
        add_theme_support('post-thumbnails');
        add_theme_support('custom-logo', array(
            'height' => 120,
            'width' => 120,
            'flex-height' => true,
            'flex-width' => true,
            'priority' => 11,
            'header-text' => array('img-responsive', 'site-description'),
        ));
        add_image_size('powerpress-lite-ThumbnailImage', 840, 560, true);

        $powerpress_lite_defaults = array(
            'default-image'          => get_template_directory_uri().'/assets/images/powerpress-lite-bg.jpeg',
            'width'                  => 0,
            'height'                 => 0,
            'flex-height'            => 1400,
            'flex-width'             => 800,
            'uploads'                => true,
            'random-default'         => false,
            'header-text'            => false,
            'default-text-color'     => '',
            'wp-head-callback'       => '',
            'admin-head-callback'    => '',
            'admin-preview-callback' => '',
        );
        register_default_headers( array(
            'default-image' => array(
                'url'           => get_template_directory_uri().'/assets/images/powerpress-lite-bg.jpeg',
                'thumbnail_url' => get_template_directory_uri().'/assets/images/powerpress-lite-bg.jpeg',
                'description'   => __( 'Default Header Image', 'powerpress-lite' )
            ),
        ) );
        add_theme_support('custom-header',$powerpress_lite_defaults);
        // Switch default core markup for search form, comment form, and commen, to output valid HTML5.
        add_theme_support('html5', array(
             'comment-form', 'comment-list',
        ));
        // Add support for featured content.
        add_theme_support('featured-content', array(
            'featured_content_filter' => 'powerpress_lite_get_featured_posts',
            'max_posts' => 6,
        ));
        // This theme uses its own gallery styles.
        add_filter('use_default_gallery_style', '__return_false');
        /* slug setup */
        add_theme_support('title-tag');

    }

endif; // powerpress_lite_setup
add_action('after_setup_theme', 'powerpress_lite_setup');
add_filter('nav_menu_css_class', 'powerpress_lite_special_navclass', 10, 2);

function powerpress_lite_special_navclass($classes, $item) {
    if (in_array('current-menu-item', $classes)) {
        $classes[] = 'active ';
    }
    return $classes;
}
add_filter('get_custom_logo','powerpress_lite_change_logo_class');
function powerpress_lite_change_logo_class($html)
{
    $html = str_replace('class="custom-logo"', 'class="img-responsive logo-fixed"', $html);
    $html = str_replace('width=', 'original-width=', $html);
    $html = str_replace('height=', 'original-height=', $html);
    $html = str_replace('class="custom-logo-link"', 'class="img-responsive logo-fixed"', $html);
    return $html;
}
function powerpress_lite_default_menu() {
    $html = '<ul id="menu-top-header-menu" class="offside">';
        $html .= '<li class="menu-item menu-item-type-post_type menu-item-object-page">';
            $html .= '<a href="' . esc_url( home_url() ) . '" title="' . esc_attr__( 'Home', 'powerpress-lite' ) . '">';
                $html .= __( 'Home', 'powerpress-lite' );
            $html .= '</a>';
        $html .= '</li>';
    $html .= '</ul>';
    echo $html;
}

add_action( 'admin_menu', 'powerpress_lite_admin_menu');
function powerpress_lite_admin_menu( ) {
    add_theme_page( __('Pro Feature','powerpress-lite'), __('PowerPress Pro','powerpress-lite'), 'manage_options', 'powerpress-buynow', 'powerpress_lite_buy_now', 300 );   
}
function powerpress_lite_buy_now(){ ?>
<div class="powerpress_version">
  <a href="<?php echo esc_url('https://voilathemes.com/wordpress-themes/powerpress/'); ?>" target="_blank">
    <img src ="<?php echo esc_url(get_template_directory_uri() . '/assets/images/powerpress-features.jpg') ?>" width="100%" height="auto" />
  </a>
</div>
<?php
}

function powerpress_lite_excerpt_length( $length ) {
        return 30;
    }
add_filter( 'excerpt_length', 'powerpress_lite_excerpt_length', 999 );

require get_template_directory() . '/functions/class-tgm-plugin-activation.php';
require get_template_directory() . '/functions/theme-default-setup.php';
require get_template_directory() . '/functions/enqueue-files.php';
require get_template_directory() . '/functions/theme-customization.php';
require get_template_directory() . '/functions/options/op-homepage.php';
require get_template_directory() . '/functions/options/fontawasome.php';
require get_template_directory() . '/functions/options/sanitization-functions.php';