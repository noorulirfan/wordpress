<?php
/**
 * Author Page template file
 * */
get_header(); ?>
<div class="heading-wrap blog-heading-wrap">
    <div class="heading-layer">
        <div class="heading-title">
            <h4><?php
                  esc_html_e('Published by : ', 'powerpress-lite');
                  echo esc_html(get_the_author());
              ?> </h4>
        </div>
    </div>
</div>
<?php get_template_part('/template-parts/content'); get_footer(); ?>