<?php
/**
 * Check if it is demo preview
 *
 * @return bool
 */
function proficiency_pre_demo() {
	$ti_theme = wp_get_theme();
	$theme_name = $ti_theme ->get( 'TextDomain' );
	$active_theme = proficiency_get_raw_option( 'template' );
	return apply_filters( 'proficiency_pre_demo', ( $active_theme != strtolower( $theme_name ) && ! is_child_theme() ) );
}

/**
 * All options or a single option val
 *
 * @param string $opt_name Option name.
 *
 * @return bool|mixed
 */
function proficiency_get_raw_option( $opt_name ) {
	$alloptions = wp_cache_get( 'alloptions', 'options' );
	$alloptions = maybe_unserialize( $alloptions );
	return isset( $alloptions[ $opt_name ] ) ? maybe_unserialize( $alloptions[ $opt_name ] ) : false;
}

/**
 * Load functions if we're on demo preview.
 */
if ( proficiency_pre_demo() ) {
	load_template( get_template_directory() . '/wp-pre-image/previmg-functions.php' );
}