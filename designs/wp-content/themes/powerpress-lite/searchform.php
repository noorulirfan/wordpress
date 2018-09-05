<?php
/**
 * Template for displaying search forms in Theme
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php esc_html_e( 'Search for', 'powerpress-lite' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php esc_attr_e( 'Search&hellip;', 'powerpress-lite' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	</label>
	<button type="submit" class="search-submit"><span class="screen-reader-text"><?php esc_html_e( 'Search', 'powerpress-lite' ); ?></span></button>
</form>
