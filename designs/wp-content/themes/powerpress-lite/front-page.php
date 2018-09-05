<?php 
/* 
*Template: PowerPress Lite
*/ 
get_header(); 
  if ( 'posts' == get_option( 'show_on_front' ) ): ?>
    <div class="heading-wrap blog-heading-wrap" >
        <div class="heading-layer">
            <div class="heading-title">
                <h4><?php esc_html_e('Blog ','powerpress-lite'); ?></h4>
            </div>
        </div>
    </div> 
    <?php get_template_part('/template-parts/content'); 
  else :
    /* Custom Slider */ powerpress_lite_customizer_sliderhome(); ?>
    <?php if ( is_front_page() )  : ?>
      <div class="container">
      	<?php   /*  Keyfeature Section */ powerpress_lite_customizer_homepagesection(); ?>
      </div>
        <?php   /* About Page Section */ powerpress_lite_customizer_aboutpagesection(); ?>    
      <div class="container">
        <?php   
              /*  Team Section */ powerpress_lite_customizer_team();
              /*  Portfolio Section  */ powerpress_lite_customizer_portfolio(); 
              /*  Testimonial Section  */ powerpress_lite_customizer_testimonials();
              /*  Latest Blog Section  */ powerpress_lite_customizer_latest_blog();
        ?>
      </div>
    <?php endif; 
endif;
get_footer();