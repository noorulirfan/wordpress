<?php $proficiency_news_enable = get_theme_mod('proficiency_news_enable');
	if($proficiency_news_enable)
	{ $proficiency_total_posts = get_option('posts_per_page'); /* number of latest posts to show */
	
	if( !empty($proficiency_total_posts) && ($proficiency_total_posts > 0) ):

    $news_background = get_theme_mod('news_background','');
    $news_section_color = get_theme_mod('news_section_color','');
    $news_section_text_color = get_theme_mod('news_section_text_color','#999'); ?>
<style>
.proficiency-blog-section .proficiency-heading h3.proficiency-heading-inner { color: <?php echo $news_section_text_color ?>; }
.proficiency-blog-section .taproficiencyheading .proficiency-heading-inner::before { border-color: <?php echo $news_section_text_color ?>; }  
</style>
<!--==================== BLOG SECTION ====================-->
<?php if($news_background != '') { ?>

<section id="blog" class="proficiency-blog-section" style="background-image:url('<?php echo $news_background;?>');">
<?php } else { ?>
<section id="blog" class="proficiency-blog-section">
  <?php } ?>
  <div class="overlay" style="background-color:<?php echo $news_section_color;?>">
    <div class="container">
      <div class="row">
        <div class="col-md-12 wow fadeInDown animated padding-bottom-50 text-center">
          <div class="proficiency-heading">
            <?php $proficiency_news_title = get_theme_mod('proficiency_news_title',__('Latest <span>News</span>','proficiency'));
          
            if( !empty($proficiency_news_title) ):
              echo '<h3 class="proficiency-heading-inner">'.$proficiency_news_title.'</h3>';
            endif; ?>
          
          <?php  $proficiency_news_subtitle = get_theme_mod('proficiency_news_subtitle',__('Lorem tincidunt augue vel congue pretium','proficiency'));

            if( !empty($proficiency_news_subtitle) ): ?>

              <p style="color: <?php echo $news_section_text_color ?>;"><?php echo $proficiency_news_subtitle ?> </p>

          <?php endif; ?></div>
        </div>
      </div>
      <div class="clear"></div>
	  <div class="row">
      <?php 
	  
	  $news_select = get_theme_mod('news_select',3);
	  $proficiency_latest_loop = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => $news_select, 'order' => 'DESC','ignore_sticky_posts' => true ) );
						
			$newSlideActive = '';
			$newSlide 		= '';
			$newSlideClose 	= '';
			$i_latest_posts= 0;
						
			if ( $proficiency_latest_loop->have_posts() ) :
						
				while ( $proficiency_latest_loop->have_posts() ) : $proficiency_latest_loop->the_post();
					
					$i_latest_posts++;

						if ( !wp_is_mobile() ){

							if($i_latest_posts == 1){
								echo $newSlideActive;
							}
							else if($i_latest_posts % 4 == 1){
								echo $newSlide;
							} ?>
      
			  <div class="col-md-4 wow pulse animated">
		        <div class="proficiency-blog-post-box"> 
		        	<a class="proficiency-blog-thumb" href="<?php echo get_permalink() ?>" title="<?php echo get_the_title() ?>">

		            	<?php if ( has_post_thumbnail() ) :
							the_post_thumbnail();
					    endif; ?>

			          	<span class="proficiency-blog-date">
			          		<span class="h3"><?php echo get_the_date('j'); ?></span>
			          		<span><?php echo get_the_date('M'); ?></span> 
			          	</span>
		          	</a>
		          	<article class="small">
			            <h1>
			            	<a href="<?php echo get_permalink() ?>" title="<?php echo get_the_title() ?>"><?php echo get_the_title() ?></a>
			            </h1>
			            <div class="proficiency-blog-category"> 
			            	<i class="fa fa-folder"></i>&nbsp; 
			              		<?php $cat_list = get_the_category_list();
								if(!empty($cat_list)) { ?>
			              		<?php the_category(', '); ?>
			              	
			              <?php } ?>
			              	<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) );?>">
			              		<i class="fa fa-user"></i>&nbsp;by <?php the_author(); ?>
			              	</a> 
			            </div>
			            <?php the_excerpt(); ?>
		          	</article>
		        </div>
		      </div>
		<?php } endwhile; endif;	wp_reset_postdata(); ?>
	
    </div>
    <!-- .container --> 
  </div>
 </div> 
</section>
<?php endif; ?>
<?php } ?>
