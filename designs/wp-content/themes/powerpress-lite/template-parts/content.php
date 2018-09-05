<div class="blog-wrapper">
    <div class="container">
        <div id="post-<?php the_ID(); ?>" <?php post_class( 'row responsive' ); ?>>
        <?php
            $blog_layout_class=(get_theme_mod('blogsidebar',2) == 1)?"9":((get_theme_mod('blogsidebar',2) == 2)?"9":"12");
            if(get_theme_mod('blogsidebar',2) == 1):
                    get_sidebar();
             endif; ?> 
            <div class="col-md-<?php echo esc_attr($blog_layout_class); ?> col-sm-<?php echo esc_attr($blog_layout_class); ?> col-xs-12 content blog-layout-two">
                <?php $counter=1; while(have_posts()) : the_post(); 
                ($counter==3)?$counter=1:'';
                if($counter==1) : ?>                          
                  <div class="row">
                    <?php endif; ?> 
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <aside class=" post-list">
                            <?php if ( has_post_thumbnail() ) : ?>
                            <div class="blog-images">
                                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'powerpress-lite-ThumbnailImage', array( 'class' => 'img-responsive') ); ?></a>
                            </div>
                            <?php else: ?>
                            <div class="blog-images">
                                <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url(get_template_directory_uri());?>/assets/images/no-feature-image.png" class="img-responsive"></a>
                            </div>
                            <?php endif; ?>
                            <?php if(get_theme_mod('blogMetaTag',1) != 2): ?>
                                <div class="content-title">
                                    <a href="<?php the_permalink(); ?>">
                                        <span class="date-box">
                                                <?php the_date(); ?>
                                        </span>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <div class="text-center">
                                <div class="posted-by">                                   
                                    <span><a href="<?php the_permalink(); ?>"><?php the_author(); ?></a></span>
                                </div>
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            </div>
                            <div class="box-divider clearfix"></div>
                            <div class="post-box">
                                <div class="text-center">
                                <?php if(get_theme_mod('blogPostExcerpt',1) == 1): 
                                            echo esc_html(powerpress_lite_excerpt(absint(get_theme_mod('blogPostExcerptTextLimit',20))));
                                        endif; ?>
                                <?php if(get_theme_mod('blogPostReadMore',1) == 1 ): ?> 
                                    <p><a href="<?php the_permalink();?>" class="btn-light"><?php esc_attr_e('Read More...','powerpress-lite'); ?></a></p>
                                <?php endif; ?>
                                </div>
                            </div>                           
                        </aside>
                    </div>
                <?php if($counter==2) : ?>
                   </div>
                    <?php endif; $counter++;
                        if(($wp_query->current_post +1) == ($wp_query->post_count) && $counter != 3){ ?>
                    </div>
                    <?php } endwhile; ?>
                    <?php the_posts_pagination( array(
                        'Previous' => __( 'Back', 'powerpress-lite' ),
                        'Next' => __( 'Onward', 'powerpress-lite' ),
                    ) ); ?>
            </div>
           <?php 
            if(get_theme_mod('blogsidebar',2) == 2):
                    get_sidebar();
             endif;
            ?>
        </div>
    </div>
</div>
