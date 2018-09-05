<?php
/*
 * Powerpress-lite Main Sidebar
 */
function powerpress_lite_widgets_init() {
    register_sidebar(array(
        'name' => __('Main Sidebar', 'powerpress-lite'),
        'id' => 'sidebar-1',
        'description' => __('Main sidebar that appears on the right.', 'powerpress-lite'),
        'before_widget' => '<aside id="%1$s" class="menu-left widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h6>',
        'after_title' => '</h6>',
    ));
    register_sidebar(array(
        'name' => __('Footer 1', 'powerpress-lite'),
        'id' => 'footer-1',
        'description' => __('Footer that appears on the down.', 'powerpress-lite'),
        'before_widget' => '<aside id="%1$s" class="footer-widget widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h6>',
        'after_title' => '</h6>',
    ));
    register_sidebar(array(
        'name' => __('Footer 2', 'powerpress-lite'),
        'id' => 'footer-2',
        'description' => __('Footer that appears on the down.', 'powerpress-lite'),
        'before_widget' => '<aside id="%1$s" class="footer-widget widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h6>',
        'after_title' => '</h6>',
    ));
    register_sidebar(array(
        'name' => __('Footer 3', 'powerpress-lite'),
        'id' => 'footer-3',
        'description' => __('Footer that appears on the down.', 'powerpress-lite'),
        'before_widget' => '<aside id="%1$s" class="footer-widget widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h6>',
        'after_title' => '</h6>',
    ));
    register_sidebar(array(
        'name' => __('Footer 4', 'powerpress-lite'),
        'id' => 'footer-4',
        'description' => __('Footer that appears on the down.', 'powerpress-lite'),
        'before_widget' => '<aside id="%1$s" class="footer-widget widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h6>',
        'after_title' => '</h6>',
    ));    
}
add_action('widgets_init', 'powerpress_lite_widgets_init');


/*
* TGM plugin activation register hook 
*/
add_action( 'tgmpa_register', 'powerpress_lite_action_tgm_plugin_active_register_required_plugins' );
function powerpress_lite_action_tgm_plugin_active_register_required_plugins() {
    if(class_exists('TGM_Plugin_Activation')){
      $plugins = array(
        array(
           'name'      => __('Page Builder by SiteOrigin','powerpress-lite'),
           'slug'      => 'siteorigin-panels',
           'required'  => false,
        ),
        array(
           'name'      => __('SiteOrigin Widgets Bundle','powerpress-lite'),
           'slug'      => 'so-widgets-bundle',
           'required'  => false,
        ), 
        array(
           'name'      => __('Contact Form 7','powerpress-lite'),
           'slug'      => 'contact-form-7',
           'required'  => false,
        ),
      );
      $config = array(
        'default_path' => '',
        'menu'         => 'Powerpress-lite-install-plugins',
        'has_notices'  => true,
        'dismissable'  => true,
        'dismiss_msg'  => '',
        'is_automatic' => false,
        'message'      => '',
        'strings'      => array(
           'page_title'                      => __( 'Install Recommended Plugins', 'powerpress-lite' ),
           'menu_title'                      => __( 'Install Plugins', 'powerpress-lite' ),
           
        )
      );
      tgmpa( $plugins, $config );
    }
}

/*
 * Function For Tag Meta List
 */

function powerpress_lite_excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  } 
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
} 

