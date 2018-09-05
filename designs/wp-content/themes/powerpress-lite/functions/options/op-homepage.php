<?php
/**
 * Homepage functions.
 *
 * @package PowerPress Lite
 */

/* ----------------------------------------------------------------------------------
	ENABLE SLIDER - HOMEPAGE & INNER-PAGES
---------------------------------------------------------------------------------- */

// Add full width slider class to body
function powerpress_lite_customizer_sliderclass($classes){

// Get theme options values.
$powerpress_lite_homepage_sliderswitch      = get_theme_mod ( 'powerpress_lite_homepage_sliderswitch',1 );
$powerpress_lite_homepage_sliderpresetwidth = get_theme_mod ( 'powerpress_lite_homepage_sliderpresetwidth' );

	if ( is_front_page() ) {
		if ( empty( $powerpress_lite_homepage_sliderswitch ) or $powerpress_lite_homepage_sliderswitch == 'option1' or $powerpress_lite_homepage_sliderswitch == 'option4' ) {
			if ( empty( $powerpress_lite_homepage_sliderpresetwidth ) or $powerpress_lite_homepage_sliderpresetwidth == '1' ) {
				$classes[] = 'slider-full';
			} else {
				$classes[] = 'slider-boxed';
			}
		}
	}
	return $classes;
}
add_action( 'body_class', 'powerpress_lite_customizer_sliderclass');


/* ----------------------------------------------------------------------------------
	ENABLE HOMEPAGE SLIDER
---------------------------------------------------------------------------------- */

// Content for slider layout - Standard
function powerpress_lite_customizer_sliderhomepage() {

// Get theme options values.
$category = get_theme_mod ( 'powerpress_lite_homepage_slider_category',0);
$arg = ($category>0)?array('post_type' => 'post' ,'post_status' => 'publish', 'posts_per_page' => 3,'category__in' => array($category)):array('post_type' => 'post' ,'post_status' => 'publish', 'posts_per_page' => 3);

$section_sliderhomepage = new WP_Query($arg);
$num = $section_sliderhomepage->post_count;
	while ( $section_sliderhomepage->have_posts() ) : $section_sliderhomepage->the_post();
	$featured_img_url = (has_post_thumbnail())?get_the_post_thumbnail_url(get_the_ID(),'full'):get_template_directory_uri().'/assets/images/no-feature-image.png';
		echo '<div class="tg_module_grid tg_module_grid--full">	
			<div class="overlay-slider"></div>
            <img src="'.esc_url($featured_img_url).'" class="wp-homepage-slider-image">
            <div class="homepage-module-info">                   
                <h1 class="homepage-post-title">'.esc_html(get_the_title()).'</h1>
                <div class="slider-content">';             	
              echo '<a class="read-more" href="'.esc_url(get_the_permalink()).'">
                		'.esc_html__('Read More','powerpress-lite').'
                	</a>';            
			echo'</div>
            </div>		                
        </div>';
	endwhile; wp_reset_postdata();
	if( $num ==1 ){
		while ( $section_sliderhomepage->have_posts() ) : $section_sliderhomepage->the_post();
	$featured_img_url = (has_post_thumbnail())?get_the_post_thumbnail_url(get_the_ID(),'full'):get_template_directory_uri().'/assets/images/no-feature-image.png';
		echo '<div class="tg_module_grid tg_module_grid--full">	
			<div class="overlay-slider"></div>
            <img src="'.esc_url($featured_img_url).'" class="wp-homepage-slider-image">
            <div class="homepage-module-info">                   
                <h1 class="homepage-post-title">'.esc_html(get_the_title()).'</h1>
                <div class="slider-content">'; 
            	the_excerpt();
              echo '<a class="read-more" href="'.esc_url(get_the_permalink()).'">
                		'.esc_html__('Read More','powerpress-lite').'
                	</a>';            
			echo'</div>
            </div>		                
        </div>';
	endwhile; wp_reset_postdata();	
	}
}

// Add Slider - Homepage
function powerpress_lite_customizer_sliderhome() {

// Get theme options values.
$powerpress_lite_homepage_sliderswitch       = get_theme_mod ( 'powerpress_lite_homepage_sliderswitch','1' );
$category = get_theme_mod ( 'powerpress_lite_homepage_slider_category',0);

$powerpress_lite_class_fullwidth = NULL;
$slider_default          = NULL;

	if ( is_front_page() ) {
		if ( ( current_user_can( 'edit_theme_options' ) and empty( $powerpress_lite_homepage_sliderswitch ) ) or $powerpress_lite_homepage_sliderswitch == '1' ) {
	
			wp_enqueue_style( 'powerpress-lite-widget-homepage-slider');
        	wp_enqueue_script( 'powerpress-lite-widget-homepage-slider');
        	// Check if page slider has been set			
			if($category<0)
			{
				// Set default slider
				$slider_default .= '
					<div class="tg_module_grid tg_module_grid--full">
						<div class="overlay-slider"></div>				                
		                <img src="'.esc_url(get_template_directory_uri()).'/assets/images/slideshow/slide_demo3.jpeg" class="wp-homepage-slider-image">
		                <div class="homepage-module-info">                   
		                    <h1 class="homepage-post-title">'.esc_html__('Slider 1','powerpress-lite').'</h1>
		                    <div class="slider-content">
			                    <a class="read-more" href="#">
                        		'.esc_html__( 'Read More','powerpress-lite' ).'
                        		</a>
                    		</div>
		                </div>
		            </div>';
				$slider_default .= '
					<div class="tg_module_grid tg_module_grid--full">
						<div class="overlay-slider"></div>				                
		                <img src="'.esc_url(get_template_directory_uri()).'/assets/images/slideshow/slide_demo2.jpeg" class="wp-homepage-slider-image">
		                <div class="homepage-module-info">                   
		                    <h1 class="homepage-post-title">'.esc_html__('Slider 2','powerpress-lite').'</h1>
		                    <div class="slider-content">
			                    <a class="read-more" href="#">
                        		'.esc_html__( 'Read More','powerpress-lite' ).'
                        		</a>
                    		</div>
		                </div>
		            </div>'; ?>

				<div class="homepage_slider_main">
		            <div class="elementor-widget-container">
		                <div class="tg-row thinner">
		                    <div class="tg-col-control homepage_slider">
		                        <div id="homepage_slider" class="homepage_post_slider owl-carousel bx-wrapper">
									<?php echo $slider_default; ?>
						        </div>
						    </div>
						</div>
					</div>
				</div>
			<?php } else { ?>
				<div class="homepage_slider_main">
		            <div class="elementor-widget-container">
		                <div class="tg-row thinner">
		                    <div class="tg-col-control homepage_slider">
		                        <div id="homepage_slider" class="homepage_post_slider owl-carousel bx-wrapper">			
									<?php echo powerpress_lite_customizer_sliderhomepage(); ?>
								</div>
						    </div>
						</div>
					</div>
				</div>
			<?php }
		}
	}
}

//----------------------------------------------------------------------------------
//	ENABLE HOMEPAGE CONTENT
//----------------------------------------------------------------------------------

function powerpress_lite_customizer_homepagesection() {

// Get theme options values.
$powerpress_lite_homepage_sectionswitch  = get_theme_mod ( 'powerpress_lite_homepage_sectionswitch',1 );
$category = get_theme_mod ( 'powerpress_lite_homepage_service_category',0);
// Output featured content areas
	if ( is_front_page() ) {
		if ( ( current_user_can( 'edit_theme_options' ) and empty( $powerpress_lite_homepage_sectionswitch ) ) or $powerpress_lite_homepage_sectionswitch == '1' ) {		

		$arg = ($category>0)?array('post_type' => 'post' ,'post_status' => 'publish', 'posts_per_page' => 4,'category__in' => array($category)):array('post_type' => 'post' ,'post_status' => 'publish', 'posts_per_page' => 4);

		$section_servicehomepage = new WP_Query($arg);
		$powerpress_lite_homepage_service_columns = 3;

		$powerpress_lite_homepage_service_icon[]  = get_theme_mod ( 'powerpress_lite_homepage_section1_icon','fa fa-thumbs-up' );
		$powerpress_lite_homepage_service_icon[]  = get_theme_mod ( 'powerpress_lite_homepage_section2_icon','fa fa-desktop' );
		$powerpress_lite_homepage_service_icon[]  = get_theme_mod ( 'powerpress_lite_homepage_section3_icon','fa fa-gears' );
		$powerpress_lite_homepage_service_icon[]  = get_theme_mod ( 'powerpress_lite_homepage_section4_icon','fa fa-users' );

		$counter= 0;
		echo '<div id="section-home"><div id="section-home-inner" class="row">';

		while ( $section_servicehomepage->have_posts() ) : $section_servicehomepage->the_post();
		$featured_img_url = (has_post_thumbnail())?get_the_post_thumbnail_url(get_the_ID(),'full'):get_template_directory_uri().'/assets/images/no-feature-image.png';

			echo '<article class="section1 col-md-'.esc_attr($powerpress_lite_homepage_service_columns).' col-sm-6 col-xs-12">',
						'<div class="services-builder style1">',
						'<div class="iconimage">';
							echo '<a href="' . esc_url( get_the_permalink() ) . '"><i class="'.esc_attr( $powerpress_lite_homepage_service_icon[$counter] ).' fa-2x"></i></a>';
				echo	'</div>',
						'<div class="iconmain">',
						'<h3>' . esc_html( get_the_title() ) . '</h3>' . wp_kses_post ( get_the_excerpt() ) ;
						
							echo '<p class="iconurl"><a class="themebutton2" href="' . esc_url( get_the_permalink() ) . '">' . esc_html__( 'Read More', 'powerpress-lite' ) . '</a></p>';
						
				echo	'</div>',
						'</div>',
					'</article>';
		$counter++; endwhile; wp_reset_postdata();

		echo '<div class="clearboth"></div></div></div>';

		}
	}

	// Set default values for titles
	// Theme Options , Setup Slider , Create Services , Create Team

	// Set default values for descriptions
	//To begin customizing your site go to Appearance &#45;&#62; Customizer and select Theme Options. Here&#39;s you&#39;ll find custom options to help build your site
	//To add a slider go to Theme Options &#45;&#45;&#62; Front Page and choose page slider. The slider will use the title, slider image for the slides, title and link.
	//To add Services content go to Theme Options &#45;&#62; Front Page (Services Section) and select show then add the content you want for each section.	
	//To add Team content go to Theme Options &#45;&#45;&#62; Front Page (Team Section) and select show then add the content you want for each section.

}

/* ----------------------------------------------------------------------------------
	About Us - Section
---------------------------------------------------------------------------------- */
function powerpress_lite_customizer_aboutpagesection() {	
	if(is_front_page()): 		
		$powerpress_lite_aboutus_sectionswitch  = get_theme_mod ( 'powerpress_lite_aboutus_sectionswitch' ,1);
		if ( ( current_user_can( 'edit_theme_options' ) and empty( $powerpress_lite_aboutus_sectionswitch ) ) or $powerpress_lite_aboutus_sectionswitch == '1' ) :

		wp_enqueue_style( 'powerpress-lite-widget-aboutus-style');
		$category = get_theme_mod ( 'powerpress_lite_aboutus_category',0);		
		$arg = ($category>0)?array('post_type' => 'post' ,'post_status' => 'publish', 'posts_per_page' => 1,'category__in' => array($category)):array('post_type' => 'post' ,'post_status' => 'publish', 'posts_per_page' => 1);

		$section_aboutus = new WP_Query($arg);
        $num = $section_aboutus->post_count; 
        $counter = 1; 
        while ( $section_aboutus->have_posts() ) : $section_aboutus->the_post();       
           $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); ?>
          <div class="aboutus-section" style="background: url('<?php echo esc_url($featured_img_url);?>')center/cover no-repeat fixed transparent;"> 
          	<div class="image-overlay">
          	<div class="container">
       			<div class="row">	            		
            		<div class="col-md-12 col-sm-12 col-xs-12 ">
            			<div class="about-content">
			          		<h2><?php echo esc_html(get_theme_mod('powerpress_lite_aboutus_category_title',esc_html__('About Us','powerpress-lite'))); ?>
			          		</h2>
				            <div class="aboutus-section-main">
				             	<h4>
					             	<?php echo esc_html(mb_strimwidth(get_the_title(), 0, 45, '...')); ?>
				             	</h4>
				             	<?php the_excerpt();?>
				             	<a class="about-read-more" href="<?php the_permalink(); ?>"> <?php esc_html_e('Read More','powerpress-lite'); ?></a>  
				            </div>
				        </div>
              		</div>
            	</div>
            </div>
        </div>
          </div>
          <?php $counter++; endwhile; wp_reset_postdata();
	  endif; 
	  endif;
}

/* ----------------------------------------------------------------------------------
	Portfolio - Section
---------------------------------------------------------------------------------- */
function powerpress_lite_customizer_portfolio() {	
	if(is_front_page()): 		
		$powerpress_lite_portfolio_sectionswitch  = get_theme_mod ( 'powerpress_lite_portfolio_sectionswitch',1 );
		if ( ( current_user_can( 'edit_theme_options' ) and empty( $powerpress_lite_portfolio_sectionswitch ) ) or $powerpress_lite_portfolio_sectionswitch == '1' ) :

		wp_enqueue_style( 'powerpress-lite-widget-portfolio-style');
		$category = get_theme_mod ( 'powerpress_lite_portfolio_category',0);		
		$arg = ($category>0)?array('post_type' => 'post' ,'post_status' => 'publish', 'posts_per_page' => 6,'category__in' => array($category)):array('post_type' => 'post' ,'post_status' => 'publish', 'posts_per_page' => 6);
		  $section_portfolio = new WP_Query($arg);  ?>
          <div class="portfolio-section "> 
            <h2><?php echo esc_html( get_theme_mod('powerpress_lite_portfolio_category_title',esc_html__('Our Work Experiences','powerpress-lite')) ); ?></h2>
            <div class="portfolio-section-main">
	          <div class="row">	
              <?php while ( $section_portfolio->have_posts() ) : $section_portfolio->the_post(); ?> 
              	<div class="col-md-4 col-sm-4 portfolio-box">
				    <div class="effect-bubba">
				    	<?php if ( has_post_thumbnail() ) : 
				    		 $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); ?>
		                      <a href="<?php the_permalink(); ?>">
		                      	<div class="image" style="background: url('<?php echo esc_url($featured_img_url);?>') center/cover no-repeat scroll transparent;width:100%;height:230px;" ></div>
		                      	</a>
		                <?php else: ?>
		                      <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url(get_template_directory_uri());?>/assets/images/no-feature-image.png"></a>
		                <?php endif; ?> 
				        <a href="<?php the_permalink(); ?>">
				            <div class="caption-hover">
				             	<p>
				             		<?php echo esc_html(mb_strimwidth(get_the_title(), 0, 45, '...')); ?>
				             	</p>
				            </div>
				        </a>
				    </div>
				</div>				
	           <?php endwhile; wp_reset_postdata();?>
              </div>
            </div>
          </div>
	<?php endif; endif;
}

/* ----------------------------------------------------------------------------------
	Testimonials - Section
---------------------------------------------------------------------------------- */
function powerpress_lite_customizer_testimonials() {
	if(is_front_page()): 
		$powerpress_lite_testimonials_sectionswitch  = get_theme_mod ( 'powerpress_lite_testimonials_sectionswitch',1 );
		if ( ( current_user_can( 'edit_theme_options' ) and empty( $powerpress_lite_testimonials_sectionswitch ) ) or $powerpress_lite_testimonials_sectionswitch == '1' ) :

		wp_enqueue_style( 'powerpress-lite-widget-testimonials-style');
		$category = get_theme_mod ( 'powerpress_lite_testimonials_category',0);		
		$arg = ($category>0)?array('post_type' => 'post' ,'post_status' => 'publish', 'posts_per_page' => 2,'category__in' => array($category)):array('post_type' => 'post' ,'post_status' => 'publish', 'posts_per_page' => 2);

		  $section_portfolio = new WP_Query($arg);  ?>
          <div class="testimonials-section"> 
            <h2><?php echo esc_html( get_theme_mod('powerpress_lite_testimonials_title',esc_html__('Our Client Says','powerpress-lite')) ); ?></h2>
            <div class="testimonials-section-main">
	          <div class="row">	
              <?php while ( $section_portfolio->have_posts() ) : $section_portfolio->the_post(); ?>              
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                	<div class="testimonial">
			            <div class="content" id="test-slider">
			              <?php the_excerpt(); ?>
			            </div>
			            <div class="testimonial-pic">
			            	<?php if ( has_post_thumbnail() ) :
				            	$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');  ?>
		                      <img src="<?php echo esc_url($featured_img_url);?>">
		                  <?php else: ?>
		                      <img src="<?php echo esc_url(get_template_directory_uri());?>/assets/images/no-feature-image.png">
		                  <?php endif; ?> 			              
			            </div>
			            <div class="testimonial-review">
			              <h3 class="testimonial-title"><?php the_title(); ?></h3>
			              <span></span>			              
			            </div>
			         </div>                              
                </div>
	           <?php endwhile; wp_reset_postdata();?>
              </div>
            </div>
          </div>
	<?php endif; endif;
}

/* ----------------------------------------------------------------------------------
	Team - Section
---------------------------------------------------------------------------------- */
function powerpress_lite_customizer_team() { 
	if(is_front_page()): 
	// Get theme options values.
	$powerpress_lite_team_sectionswitch  = get_theme_mod ( 'powerpress_lite_team_sectionswitch',1 );
	
	$category = get_theme_mod ( 'powerpress_lite_team_category',0);		
	$arg = ($category>0)?array('post_type' => 'post' ,'post_status' => 'publish', 'posts_per_page' => 3,'category__in' => array($category)):array('post_type' => 'post' ,'post_status' => 'publish', 'posts_per_page' => 3);

	$section_team = new WP_Query($arg);  
	$counter = 1; 

	$powerpress_lite_team_section=array();
	for($i=1;$i<=3;$i++):		
		$temparray=array();
		$temparray['1_icon']  = get_theme_mod ( 'powerpress_lite_team_'.$i.'1_icon');
		$temparray['1_link']  = get_theme_mod ( 'powerpress_lite_team_'.$i.'1_link');
		$temparray['2_icon']  = get_theme_mod ( 'powerpress_lite_team_'.$i.'2_icon');
		$temparray['2_link']  = get_theme_mod ( 'powerpress_lite_team_'.$i.'2_link');
		$temparray['3_icon']  = get_theme_mod ( 'powerpress_lite_team_'.$i.'3_icon');
		$temparray['3_link']  = get_theme_mod ( 'powerpress_lite_team_'.$i.'3_link');			
		$powerpress_lite_team_section[]=$temparray;		
	endfor;	

	 wp_enqueue_style( 'powerpress-lite-widget-add-profile-details-style'); 
	 if ( is_front_page() ) {
		if ( ( current_user_can( 'edit_theme_options' ) and empty( $powerpress_lite_team_sectionswitch ) ) or $powerpress_lite_team_sectionswitch == '1' ) {
		$total_team = $section_team->post_count;
		 ?>
	  <div class="team-section"> 
        <h2>
        <?php echo esc_html(get_theme_mod('powerpress_lite_team_title',esc_html__('Meet our Team','powerpress-lite'))); ?>
        </h2>
        <div class="team-section-main">
	        <div class="row">	
	        	<div class="team-sec-<?php echo esc_attr($total_team); ?>">
				<?php while ( $section_team->have_posts() ) : $section_team->the_post(); ?>				
		      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
		      	<div class="team-area-section">
			    	<div class="hovereffect">
				    	<?php if ( has_post_thumbnail() ) :
				              $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); ?>
	                    <div class="team-section-hover-img" style="background-image:url(<?php echo esc_url($featured_img_url);?>)"></div>
	                    <?php else: $image=get_template_directory_uri().'/assets/images/no-feature-image.png'; ?>
	                    <div class="team-section-hover-img" style="background-image:url(<?php echo esc_url($image);?>)" > </div>
	                    <?php endif; ?>				        
			            <div class="overlay">			                
			                <p>
			                   <?php if(isset($powerpress_lite_team_section[$counter]['1_icon']) && isset($powerpress_lite_team_section[$counter]['1_link']) ):?>
                                <a href="<?php echo esc_url($powerpress_lite_team_section[$counter]['1_link']);?>">
                                    <i class="<?php echo esc_attr($powerpress_lite_team_section[$counter]['1_icon']); ?>"></i>
                                </a>
                                <?php endif; ?>
                                <?php if(isset($powerpress_lite_team_section[$counter]['2_icon']) && isset($powerpress_lite_team_section[$counter]['2_link']) ):?>
                                <a href="<?php echo esc_url($powerpress_lite_team_section[$counter]['2_link']);?>">
                                    <i class="<?php echo esc_attr($powerpress_lite_team_section[$counter]['2_icon']); ?>"></i>
                                </a>
                                <?php endif; ?>
                                <?php if(isset($powerpress_lite_team_section[$counter]['3_icon']) && isset($powerpress_lite_team_section[$counter]['3_link']) ):?>
                                <a href="<?php echo esc_url($powerpress_lite_team_section[$counter]['3_link']);?>">
                                    <i class="<?php echo esc_attr($powerpress_lite_team_section[$counter]['3_icon']); ?>"></i>
                                </a>
                                <?php endif; ?>                                 
                                <a href="<?php the_permalink(); ?>">
                                    <i class="fa fa-link"></i>
                                </a>                                
			                </p>
			            </div>			            
				    </div>
				    <div class="thumbnails_overlay">
	                    <p class="profile-name">
	                    	<?php the_title(); ?>
	                    </p>
	                    <p class="profile-designation">
	                    	<?php echo wp_kses_post(get_the_tag_list('',' ')); ?>
	                    </p>
	                </div>
	            </div>
			</div>
			<?php $counter++;  endwhile; wp_reset_postdata(); ?>
		</div>
	  </div>
    </div>
  </div>
  <?php }
   } 
   endif;
}

/* ----------------------------------------------------------------------------------
	Latest Blog - Section
---------------------------------------------------------------------------------- */
function powerpress_lite_customizer_latest_blog() {
	if(is_front_page()): 
		$powerpress_lite_latest_blog_sectionswitch  = get_theme_mod ( 'powerpress_lite_latest_blog_sectionswitch',1 );
		if ( ( current_user_can( 'edit_theme_options' ) and empty( $powerpress_lite_latest_blog_sectionswitch ) ) or $powerpress_lite_latest_blog_sectionswitch == '1' ) :

		wp_enqueue_style( 'powerpress-lite-widget-latest-blog-style');
		$category = get_theme_mod ( 'powerpress_lite_latest_blog_category',0);		
		$arg = ($category>0)?array('post_type' => 'post' ,'post_status' => 'publish', 'posts_per_page' => 4,'category__in' => array($category)):array('post_type' => 'post' ,'post_status' => 'publish', 'posts_per_page' => 4);

		$section_latest_blog = new WP_Query($arg);
        $num = $section_latest_blog->post_count; 
        $counter = 1; ?>
          <div class="latest-blog-section"> 
            <h2><?php echo esc_html( get_theme_mod('powerpress_lite_latest_blog_title',esc_html__('Our Blog Post','powerpress-lite')) ); ?></h2>
            <div class="latest-blog-section-main">
	          <div class="row">	
              <?php while ( $section_latest_blog->have_posts() ) : $section_latest_blog->the_post();
	              $tags_list = get_the_tag_list( '', __( ', ', 'powerpress-lite' )); ?>              
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                	<div class="latest-blog">	
                		<div class="latest-blog-pic">
                			<?php if ( has_post_thumbnail() ) :
				            	$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');  ?>
		                      <img src="<?php echo esc_url($featured_img_url);?>">
		                	<?php else: ?>
		                      <img src="<?php echo esc_url(get_template_directory_uri());?>/assets/images/no-feature-image.png">
		                  	<?php endif; ?>		                  	
		                </div>
		                <div class="latest-blog-review">
			              <h3 class="latest-blog-title"><?php the_title(); ?></h3>
			              <?php if ( $tags_list && ! is_wp_error( $tags_list ) ) {
							echo '<span class="tags-links"><span class="screen-reader-text">' .__( 'Tags', 'powerpress-lite' ) . '</span>' . $tags_list . '</span>';
							} ?>
			            </div>
		                <div class="latest-blog-content" id="latest_blog_section">
			              <?php the_excerpt(); ?>	
			              <a class="latest-blog-read-more" href="<?php the_permalink(); ?>"> <?php esc_html_e('Read More','powerpress-lite'); ?></a>		               
			            </div> 			            
			         </div>                              
                </div>
	           <?php endwhile; wp_reset_postdata();?>
              </div>
            </div>
          </div>
	<?php endif; endif;
}