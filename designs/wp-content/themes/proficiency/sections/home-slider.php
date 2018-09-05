<?php 
$slider_overlay = get_theme_mod('proficiency_overlay_slider_color_control',''); 
$proficiency_slider_enable = get_theme_mod('proficiency_slider_enable');
$proficiency_slider_category = get_theme_mod('slider_category');
if($proficiency_slider_enable){?>
<!--==================== SLIDER SECTION ====================-->  
<section class="proficiency-slider-warraper">
  <div id="proficiency-slider" class="owl-carousel">
    <?php if(is_active_sidebar( 'sidebar-slider' )):
            dynamic_sidebar( 'sidebar-slider' ); endif; ?>
  </div>
</section>
<?php } ?>
<div class="clearfix"></div>