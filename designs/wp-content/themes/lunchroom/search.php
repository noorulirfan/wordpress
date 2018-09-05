<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Lunchroom
 */

get_header(); ?>

<div class="container">
    	<div class="row">
            <div class="col-md-3">
                	<div class="sidebar">
        			<?php get_sidebar(); ?>
                    </div>
        		</div>
                <div class="col-md-9">
                	<div class="content">
			<?php if ( have_posts() ) : ?>
                <header>
                    <h1 class="entry-title"><?php printf(esc_html_e( 'Search Results for: %s', 'lunchroom' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                </header>
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'content', 'search' ); ?>
                <?php endwhile; ?>
                <?php lunchroom_pagination(); ?>
            <?php else : ?>
                <?php get_template_part( 'no-results', 'search' ); ?>
            <?php endif; ?>
            </div>
 	           </div><div class="clearfix"></div>
    </div>
</div>

<?php get_footer(); ?>