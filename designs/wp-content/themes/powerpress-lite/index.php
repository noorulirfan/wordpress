<?php
/**
 * The main template file
 **/
get_header(); ?> 
<div class="heading-wrap blog-heading-wrap" >
    <div class="heading-layer">
        <div class="heading-title">
            <h4><?php esc_html_e('Blog ','powerpress-lite'); ?></h4>
        </div>
    </div>
</div> 
<?php get_template_part('/template-parts/content');
get_footer(); ?>