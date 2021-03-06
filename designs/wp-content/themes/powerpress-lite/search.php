<?php
/*
 * Search Template File
 */
get_header(); ?>
<div class="heading-wrap blog-heading-wrap">
    <div class="heading-layer">
        <div class="heading-title">
            <h4><?php
                esc_html_e('Search results for', 'powerpress-lite');
                echo " : " . get_search_query();
            ?></h4>
        </div>
    </div>
</div>
<?php if (have_posts()) : ?>
    <?php get_template_part('/template-parts/content'); ?>
<?php else : ?>
    <div class="photographer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="blog-content-area fadeIn animated">
                        <div class="search-area">
                            <p class="spage">
                                <?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords', 'powerpress-lite'); ?>.</p>
                            <?php get_search_form(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; get_footer(); ?>