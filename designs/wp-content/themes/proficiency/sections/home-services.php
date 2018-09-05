<?php
$proficiency_service_enable = get_theme_mod('proficiency_service_enable'); 
$proficiency_service_background_color = get_theme_mod('proficiency_service_background_color',' ');
$proficiency_service_text_color = get_theme_mod('proficiency_service_text_color',' ');
?>

<style>
  #service .proficiency-heading h3.proficiency-heading-inner {
    color: <?php echo $proficiency_service_text_color ?>;
  }
  #service .proficiency-heading .proficiency-heading-inner::before {
    border-color: <?php echo $proficiency_service_text_color ?>;
  }  
</style>

<?php if($proficiency_service_enable)
{
$proficiency_service_button = get_theme_mod('proficiency_service_button','Load More'); ?>

<!--==================== SERVICE SECTION ====================-->
<section id="service" class="proficiency-section text-center" style="background: <?php echo $proficiency_service_background_color ?>;">
  <div class="container">
    <div class="row">
      <div class="col-md-12 padding-bottom-20">
        <div class="proficiency-heading">
          <?php $proficiency_service_title = get_theme_mod('proficiency_service_title',__('Our <span>Services</span>','proficiency'));
					
			if( !empty($proficiency_service_title) ):

				echo '<h3 class="proficiency-heading-inner">'.$proficiency_service_title.'</h3>';

			endif; ?>
        
        <?php $proficiency_service_subtitle = get_theme_mod('proficiency_service_subtitle',__('we offer totally integrated service beyond the web','proficiency'));

			if( !empty($proficiency_service_subtitle) ): ?>

				<p style="color: <?php echo $proficiency_service_text_color ?>;"><?php echo $proficiency_service_subtitle ?></p>
        </div>

			<?php endif; ?>
      </div>
    </div>
    <div class="row">
      <?php 
		if(is_active_sidebar( 'sidebar-service' )):
						
			dynamic_sidebar( 'sidebar-service' );

			else: ?>
            <div class="margin-bottom-50"> 
           <?php echo "Please Add Service Widgets"; ?>
            </div>
        <?php
		endif;
	  ?>
    </div>
  </div>
</section>
<?php } ?>