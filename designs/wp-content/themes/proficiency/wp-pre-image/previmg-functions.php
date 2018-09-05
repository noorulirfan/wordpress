<?php
/**
 * Get a random image from demo content
 * Can be recursive if a specific img size is not found
 *
 * @param int $i Maximum number of recalls.
 *
 * @return mixed
 */
function proficiency_get_demo_img_src( $i = 0 ) {
	// prevent infinite loop
	if ( 8 == $i ) {
		return '';
	}

	$path = get_template_directory() . '/wp-pre-image/img/';

	// Build or re-build the global dem img array
	if ( ! isset( $GLOBALS['demo_img'] ) || empty( $GLOBALS['demo_img'] ) ) {
		$imgs = array( '1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg', '7.jpg', '8.jpg' );
		$candidates = array();

		foreach ( $imgs as $img ) {
			$candidates[] = $img;
		}
		$GLOBALS['demo_img'] = $candidates;
	}
	$candidates = $GLOBALS['demo_img'];
	// get a random image name
	$rand_key = array_rand( $candidates );
	$img_name = $candidates[ $rand_key ];

	// if file does not exists, reset the global and recursively call it again
	if ( ! file_exists( $path . $img_name ) ) {
		unset( $GLOBALS['demo_img'] );
		$i++;
		return proficiency_get_demo_img_src( $i );
	}

	// unset all sizes of the img found and update the global
	$new_candidates = $candidates;
	foreach ( $candidates as $_key => $_img ) {
		if ( substr( $_img , 0, strlen( "{$img_name}" ) ) === "{$img_name}" ) {
			unset( $new_candidates[ $_key ] );
		}
	}
	$GLOBALS['demo_img'] = $new_candidates;
	return get_template_directory_uri() . '/wp-pre-image/img/' . $img_name;
}

/**
 * Filter thumbnail image
 *
 * @param string $input Post thumbnail.
 */
function proficiency_the_post_thumbnail( $input ) {
	if ( empty( $input ) ) {
		$placeholder = proficiency_get_demo_img_src();
		return '<img src="' . esc_url( $placeholder ) . '">';
	}
	return $input;
}

add_filter( 'post_thumbnail_html', 'proficiency_the_post_thumbnail' );