<?php 
$proficiency_callout_enable = get_theme_mod('proficiency_callout_enable');
if($proficiency_callout_enable)
{
$proficiency_callout_background = get_theme_mod('proficiency_callout_background','');
$proficiency_overlay_callout_color_control = get_theme_mod('proficiency_overlay_callout_color_control','');
$proficiency_callout_button_one_label = get_theme_mod('proficiency_callout_button_one_label','Know More');
$proficiency_callout_button_one_link = get_theme_mod('proficiency_callout_button_one_link','#');
$proficiency_callout_button_one_target = get_theme_mod('proficiency_callout_button_one_target','true');
$proficiency_callout_button_two_label = get_theme_mod('proficiency_callout_button_two_label','');
$proficiency_callout_button_two_link = get_theme_mod('proficiency_callout_button_two_link','#');
$proficiency_callout_button_two_target = get_theme_mod('proficiency_callout_button_two_target','true');
$proficiency_feature_enable = get_theme_mod('proficiency_feature_enable','true');
$proficiency_callout_text_color = get_theme_mod('proficiency_callout_text_color','');
$proficiency_callout_text_align = get_theme_mod('proficiency_callout_text_align','right');
?>
<style>
.proficiency-callout .overlay h3, .proficiency-callout .overlay p   { color: <?php echo $proficiency_callout_text_color ?>; }
</style>
<!--==================== CALLOUT SECTION ====================-->
<?php if($proficiency_callout_background != '') { ?>

<section class="proficiency-callout" style="background-image:url('<?php echo esc_url($proficiency_callout_background);?>');">
<?php } else { ?>
<section class="proficiency-callout">
  <?php } ?>
  <div class="overlay" style="background-color:<?php echo esc_html($proficiency_overlay_callout_color_control);?>">
    <div class="container">
      <div class="row">
        <!--proficiency-callout-inner-->
        <div class="proficiency-callout-inner text-xs text-<?php echo $proficiency_callout_text_align; ?>">
          <?php $proficiency_callout_title = get_theme_mod('proficiency_callout_title',__('we design digital <span>products</span> that make peoples lives easier','proficiency'));
          
            if( !empty($proficiency_callout_title) ):

              echo '<h3 class="padding-bottom-30">'.$proficiency_callout_title.'</h3>';

            endif; ?>
          <?php $proficiency_callout_description = get_theme_mod('proficiency_callout_description',__('I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness.','proficiency'));

            if( !empty($proficiency_callout_description) ):

              echo '<p>'.$proficiency_callout_description.'</p>';

            endif; ?>
            <div class="padding-top-20">
          <?php if( !empty($proficiency_callout_button_one_label) ): ?>
      		  <a href="<?php echo $proficiency_callout_button_one_link; ?>" <?php if( $proficiency_callout_button_one_target == true) { echo "target='_blank'"; } ?> class="btn btn-theme">
      		<?php echo $proficiency_callout_button_one_label; ?></a>
      		<?php
      		endif;

          if( !empty($proficiency_callout_button_two_label) ): ?>
      		  <a href="<?php echo $proficiency_callout_button_two_link; ?>" <?php if( $proficiency_callout_button_two_target ==true) { echo "target='_blank'"; } ?> class="btn btn-theme-two"><?php echo $proficiency_callout_button_two_label; ?></a>
    		  <?php endif; ?>	
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php } ?>
