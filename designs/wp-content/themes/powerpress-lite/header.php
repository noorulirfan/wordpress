<?php
/*
 * The Header template for our theme
 */ ?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>   
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="<?php bloginfo( 'charset' ); ?>" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
    <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <?php wp_head(); ?>  
</head>
<body <?php body_class();?>> 
    <?php if(get_theme_mod('preloader') != 2) :
        if(get_theme_mod('customPreloader') == '') { ?>
            <div class="preloader">
                <span class="preloader-gif">
                    <?php  get_template_part('assets/images/loader.svg'); ?>
                </span>
            </div>
        <?php } else{ ?>
            <div class="preloader"><span class="preloader-gif" style="background: url(<?php echo esc_url(get_theme_mod('customPreloader')); ?>) no-repeat;background-size: contain;animation: none;"></span></div>
    <?php } endif; 
    $header_menu=1;
    if($header_menu != 0 || is_front_page()) : ?>

    <header>
        <div id="powerpress_lite_navigation" class="navbar transparent">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                        <!-- Logo start -->
                        <div class="logo">
                            <?php                                
                            if(has_custom_logo()){
                                the_custom_logo();            
                            }
                            if (get_theme_mod('header_text',true)):?>
                                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" id='brand' class="custom-logo-link"><span class="site-title"><h4><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h4><small class="site-description"><?php echo esc_html( get_bloginfo( 'description' ) ); ?></small></span></a>   
                            <?php endif; ?> 
                        </div>
                        <!-- Logo start -->
                        <!-- Menu start -->
                        <div id="cssmenu">                    
                            <?php
                                if (has_nav_menu('primary')) {
                                    $powerpress_defaults = array(
                                    'theme_location' => 'primary',
                                    'container' => 'none',
                                    'items_wrap' => '<ul class="offside">%3$s</ul>',
                                );
                                    wp_nav_menu($powerpress_defaults);                                        
                                }else{
                                        wp_nav_menu(
                                            array(
                                                'theme_location' => 'primary',
                                                'fallback_cb'    => 'powerpress_lite_default_menu'
                                            )
                                        );
                                    } 
                            ?>
                        </div>
                        <!-- Menu end -->
                    </div>
                </div>
            </div>
        </div>
    </header>    
    <?php endif; ?>    