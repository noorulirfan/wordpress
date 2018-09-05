<?php
/**
 * Main Page template file
 **/

get_header();
 if(!is_home() && !is_front_page()) : ?>
    <div class="heading-wrap blog-heading-wrap">
        <div class="heading-layer">
            <div class="heading-title">
                <h4><?php the_title(); ?></h4>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="container">
        <div class="row">            
            <?php $page_layout_class=(get_theme_mod('pageSidebar',2) == 1)?"9":((get_theme_mod('pageSidebar',2) == 2)?"9":"12");
            if(get_theme_mod('pageSidebar',2) == 1):
                    get_sidebar();
             endif; ?>
            <div class="col-lg-<?php echo esc_attr($page_layout_class); ?> col-md-<?php echo esc_attr($page_layout_class); ?> col-sm-<?php echo esc_attr($page_layout_class); ?> col-xs-12 blog-article">
                <?php while ( have_posts() ) : the_post(); ?>
                        <?php the_content();                        
                          wp_link_pages( array(
                            'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'powerpress-lite' ) . '</span>',
                            'after'       => '</div>',
                            'link_before' => '<span>',
                            'link_after'  => '</span>',
                            'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'powerpress-lite' ) . ' </span>%',
                            'separator'   => '<span class="screen-reader-text">, </span>',
                        ) );
                        // If comments are open or we have at least one comment, load up the comment template.
                       ?>
                <?php endwhile;  
                 if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;
                ?>
            </div>
            <?php if(get_theme_mod('pageSidebar',2) == 2):
                    get_sidebar();
             endif; ?>
        </div>
    </div>
<?php get_footer(); ?>