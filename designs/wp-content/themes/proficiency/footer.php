<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @package proficiency
 */

?>
<!--==================== proficicnecy-FOOTER AREA ====================-->
<footer> 
  <div class="overlay"> 
  <!--Start proficiency-footer-widget-area-->
  <?php if ( is_active_sidebar( 'footer_widget_area' ) ) { ?>
  <div class="proficiency-footer-widget-area">
    <div class="container">
      <div class="row">
        <?php  dynamic_sidebar( 'footer_widget_area' ); ?>
      </div>
    </div>
  </div>
  <?php } ?>
  <!--End proficiency-footer-widget-area-->
  <div class="proficiency-footer-copyright">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-sm-6 text-center-xs">

        <?php if( get_theme_mod( 'hide_copyright' ) != 'false') { ?>
			
			<?php echo get_theme_mod('proficiency_footer_copyright_setting','<p><i class="fa fa-copyright"></i> Copyright 2017 by <a href="#">proficiency</a>. All Rights Reserved.</p>' );?>
				
		<?php } ?>

        </div>
        <div class="col-md-6 col-sm-6 text-right text-center-xs">
          <?php if ( has_nav_menu( 'social' ) ) : ?>
          <nav class="ta-social-navigation" role="navigation" aria-label="<?php _e( 'Footer Social Links Menu', 'proficiency' ); ?>">
            <?php
              wp_nav_menu( array(
                'theme_location' => 'social',
                'menu_class'     => 'social-links-menu',
                'depth'          => 1,
                'link_before'    => '<span class="screen-reader-text">',
                'link_after'     => '</span>' . proficiency_include_svg_icons( array( 'icon' => 'chain' ) ),
              ) );
            ?>
          </nav><!-- .social-navigation -->
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  </div>
</footer>
</div>
<!--Scroll To Top--> 
<a href="#" class="ta_scroll bounceInRight  animated"><i class="fa fa-angle-up"></i></a> 
<!--/Scroll To Top-->
<?php wp_footer(); ?>
</body>
</html>