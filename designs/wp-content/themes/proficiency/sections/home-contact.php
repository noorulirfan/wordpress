  <?php  $proficiency_contact_enable = get_theme_mod('proficiency_contact_enable');
  if($proficiency_contact_enable)
  {
  
  $proficiency_contact_background = get_theme_mod('proficiency_contact_background','');
  $proficiency_contact_text = get_theme_mod('proficiency_contact_text','');
  $proficiency_overlay_contact_color_control = get_theme_mod('proficiency_overlay_contact_color_control','');
  ?>
  <style>
  .proficiency-contact .proficiency-heading h3.proficiency-heading-inner, .proficiency-contact h5, .proficiency-contact .proficiency-widget-address > li, .proficiency-contact {
    color: <?php echo $proficiency_contact_text ?>;
  }
  .proficiency-contact .proficiency-heading .proficiency-heading-inner::before { border-color: <?php echo $proficiency_contact_text ?>; }  
  </style>
  <!--==================== CONTACT SECTION ====================-->
  <?php if($proficiency_contact_background != '') { ?>
  <section id="contact" class="proficiency-contact" style="background-image:url('<?php echo $proficiency_contact_background;?>');">
  <?php } else { ?>
  <section id="contact" class="proficiency-contact">
  <?php } ?>
  <div class="overlay" style="background-color:<?php echo $proficiency_overlay_contact_color_control;?>">
    <div class="container">
      <div class="row">
        <div class="col-md-12 wow fadeInDown animated padding-bottom-50 text-center">
          <div class="proficiency-heading">
            <?php $proficiency_contact_title = get_theme_mod('proficiency_contact_title',__('Get in <span>touch</span>','proficiency'));
          
            if( !empty($proficiency_contact_title) ):

              echo '<h3 class="proficiency-heading-inner">'.$proficiency_contact_title.'</h3>';

            endif; ?>
          
          <?php $proficiency_contact_subtitle = get_theme_mod('proficiency_contact_subtitle',__('Have Questions','proficiency'));

            if( !empty($proficiency_contact_subtitle) ):

              echo '<p class="padding-bottom-30">'.$proficiency_contact_subtitle.'</p>';

            endif; ?></div>
        </div>
      </div>
      <div class="row">
        <?php if ( is_active_sidebar( 'sidebar-contact' ) ) { ?>
        <?php  dynamic_sidebar( 'sidebar-contact' ); ?>
        <?php } ?>
      </div>
    </div>
  </div>
</section>
  <?php } ?>