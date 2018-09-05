<?php
/**
 * The template for displaying the content.
 * @package proficiency
 */
?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="proficiency-blog-post-box">
		<?php
		$post_thumbnail_url = get_the_post_thumbnail( get_the_ID(), 'img-responsive' );
		if ( !empty( $post_thumbnail_url ) ) {
		?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="proficiency-blog-thumb">
					<?php echo $post_thumbnail_url; ?>
			<span class="proficiency-blog-date"><span class="h3"><?php echo get_the_date('j'); ?></span> 
				<span><?php echo get_the_date('M'); ?></span>
			</span>
        </a>
		<?php
		}
		?>
		<article class="small"> 
			<h1><a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
			<div class="proficiency-blog-category"> 
				<i class="fa fa-folder"></i>
				<?php   $cat_list = get_the_category_list();
				if(!empty($cat_list)) { ?>
				<?php the_category(', '); ?>
				<?php } ?>
				<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>"><i class="fa fa-user"></i> <?php _e('by','proficiency'); ?>
				<?php the_author(); ?>
				</a> 
			</div>
						<?php
						$proficicnecy_more = strpos( $post->post_content, '<!--more' );
						if ( $proficicnecy_more ) :
							echo get_the_content();
						else :
							echo get_the_excerpt();
						endif;
						?>
				<?php wp_link_pages( array( 'before' => '<div class="link">' . __( 'Pages:', 'proficiency' ), 'after' => '</div>' ) ); ?>
		</article>
	</div>
</div>