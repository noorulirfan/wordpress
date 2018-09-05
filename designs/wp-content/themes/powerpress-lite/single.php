<?php
/*
* Single Post template file
*/
 get_header(); ?>
    <div class="heading-wrap blog-heading-wrap">
        <div class="heading-layer">
            <div class="heading-title">
                <h4><?php the_title(); ?></h4>
            </div>
        </div>
    </div>
<div class="single-blog-wrapper">
    <div class="photographer-section">
        <div class="container">
            <div class="row responsive">
                 <?php 
                $blog_layout_class=(get_theme_mod('blogsinglesidebar',2) == 1)?"9":((get_theme_mod('blogsinglesidebar',2) == 2)?"9":"12");
                if(get_theme_mod('blogsinglesidebar',2) == 1):
                        get_sidebar();
                 endif;
                ?>  
                <div class="col-md-<?php echo esc_attr($blog_layout_class); ?> col-sm-12 col-xs-12 content">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <div class="single-blog-content-area fadeIn animated">
                            <div class="single-blog-content">  
                                <?php if ( has_post_thumbnail() ) : ?>
                                     <div class="single-blog-images" style="background-image: url(<?php echo esc_url(get_the_post_thumbnail_url()); ?>);" >                                        
                                    </div>
                                <?php else: ?>
                                    <div class="single-blog-images" style="background-image: url(<?php echo esc_url(get_template_directory_uri());?>/assets/images/no-feature-image.png);">
                                    </div>
                                 <?php endif; ?>
                                    <div class="content-title">
                                        <?php if(get_theme_mod('blogSingleMetaTag',1) != 2): ?>
                                            <span class="date-box">
                                                <?php the_date(); ?>
                                            </span>
                                        <?php endif; ?>
                                        <div class="title-data fadeIn animated">
                                            <h2><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
                                        </div>
                                    </div>
                                 <?php the_content(); ?>
                            </div>
                           <?php // Previous/next page navigation.
                             wp_link_pages( array(
                                    'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'powerpress-lite' ) . '</span>',
                                    'after'       => '</div>',
                                    'link_before' => '<span>',
                                    'link_after'  => '</span>',
                                    'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'powerpress-lite' ) . ' </span>%',
                                ) );
                            
                            if ( comments_open() || get_comments_number() ) :
                                comments_template();
                            endif; ?>
                        </div>                        
                <?php endwhile; ?>
                </div>
                 <?php 
                if(get_theme_mod('blogsinglesidebar',2) == 2):
                        get_sidebar();
                 endif;
                ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>