<?php
/*
 * Archive Template File.
 */
get_header(); ?>
<!--archive posts start-->
<div class="heading-wrap blog-heading-wrap">
    <div class="heading-layer">
        <div class="heading-title">
            <h4> <?php the_archive_title(); ?> </h4>
        </div>
    </div>
</div>
<?php  get_template_part('/template-parts/content'); get_footer(); ?>