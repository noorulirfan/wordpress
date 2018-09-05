<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package proficiency
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>
<?php $theme_layout = get_theme_mod('proficiency_theme_layout_options','wide'); ?>

<?php 
	$theme_layout = get_theme_mod('proficiency_theme_layout_options','wide');
	if($theme_layout == "boxed")
	{ $class="boxed"; }
	else
	{ $class="wide"; }
 ?>
<body <?php body_class($class); ?> >
<div class="wrapper">
<a style="display:none;" class="skip-link screen-reader-text" href="#content">
<?php esc_html_e( 'Skip to content', 'proficiency' ); ?>
</a>
<header> 
  <!--==================== TOP BAR ====================-->
  <div class="proficiency-head-detail hidden-xs hidden-sm">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6 col-xs-12 col-sm-6">
          <ul class="info-left">
            <?php 
              $proficiency_head_info_one = get_theme_mod('proficiency_head_info_one','<a><i class="fa fa-clock-o "></i>Open-Hours:10 am to 7pm</a>','proficiency');
              $proficiency_head_info_two = get_theme_mod('proficiency_head_info_two','<a href="mailto:info@themeansar.com" title="Mail Me"><i class="fa fa-envelope"></i> info@themeansar.com</a>','proficiency');
            ?>
            <li><?php echo $proficiency_head_info_one; ?></li>
            <li><?php echo $proficiency_head_info_two; ?></li>
          </ul>
        </div>
        <div class="col-md-6 col-xs-12 col-sm-6">
        <?php 
              wp_nav_menu( 
              array(  
              'theme_location'  => 'top',
              'container'     => '',
              'menu_class'    => 'info-right',
              'fallback_cb'     => 'proficiency_nav_walker',
              'walker'      => new proficiency_nav_walker()
            ) );
          
        ?>
          </div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="proficiency-main-nav">
    <nav class="navbar navbar-default navbar-wp">
      <div class="container-fluid">
         <div class="navbar-header"> 
            <!-- Logo -->
            <?php
            if(has_custom_logo())
            {
            // Display the Custom Logo
            the_custom_logo();
            }
             else { ?>
            <a class="navbar-brand" href="<?php echo esc_url(home_url( '/' )); ?>"><?php bloginfo('name'); ?>
			<br>
            <span class="site-description"><?php echo  get_bloginfo( 'description', 'display' ); ?></span>   
            </a>      
            <?php } ?>
            <!-- Logo -->
			<!-- navbar-toggle -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          <!-- /navbar-toggle -->
            </div>
        <!-- /navbar-toggle --> 
        
        <!-- Navigation -->
        <div class="collapse navbar-collapse" id="navbar-wp">
				<?php wp_nav_menu( array(  
				'theme_location' => 'primary',
				'container'  => '',
				'menu_class' => 'nav navbar-nav navbar-right',
				'fallback_cb' => 'proficiency_fallback_page_menu',
				'walker' => new proficiency_nav_walker()
				 ) );
				?>
        </div>
        <!-- /Navigation --> 
      </div>
    </nav>
  </div>
</header>
<!-- #masthead --> 