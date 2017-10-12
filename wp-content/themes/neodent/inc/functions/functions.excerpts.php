<?php

/*
 * Verteez Premium Themes
 * -----------------------------------------------------------
 * @package Theme Name -  Verteez  - Premium Multipurpose Wordpress Theme
 * @subpackage ThemezKitchen WP Theme Framework
 * @copyright Copyright (c), ThemezKitchen,  (http://www.themezkitchen.com/)
 * @link http://www.themezkitchen.com/
 * @version 1.0.0
 * @since Version 1.0.0
 */

/**
 * @name Excerpts function file
 * Used for theme excerpt init and customization.
 * @group functions
 * @category main
 */

/**
 * Simple excerpt function for using
 * Custom length is defined in a separate function
 * @global type $post
 * @param type $length_callback
 * @param type $more_callback
 * @since 1.0.0
 * @category hooks
 */
function neodent_simple_excerpt( $length_callback = '', $more_callback = '' ) {
	global $post;
	if ( function_exists( $length_callback ) ) {
		add_filter( 'excerpt_length', $length_callback );
	}
	if ( function_exists( $more_callback ) ) {
		add_filter( 'excerpt_more', $more_callback );
	}
	$output = get_the_excerpt();
	$output = apply_filters( 'wptexturize', $output );
	$output = apply_filters( 'convert_chars', $output );
	//print output
	echo $output;
}

/**
 * Excerpt getter function
 * Custom length is defined in a separate function
 * @global type $post
 * @param type $length_callback
 * @param type $more_callback
 * @since 1.0.0
 * @category hooks
 */
function neodent_get_simple_excerpt( $length_callback = '', $more_callback = '' ) {
	global $post;
	if ( function_exists( $length_callback ) ) {
		add_filter( 'excerpt_length', $length_callback );
	}
	if ( function_exists( $more_callback ) ) {
		add_filter( 'excerpt_more', $more_callback );
	}
	$output = get_the_excerpt();
	$output = apply_filters( 'wptexturize', $output );
	$output = apply_filters( 'convert_chars', $output );
	//retzrn
	return $output;
}

/**
 * Custom length
 * @param type $length
 * @return int
 * @since 1.0.0
 * @category helpers
 */
function neodent_excerpt_length( $length ) {
	return 20;
}

/**
 * Read more button
 * @global type $post
 * @param type $more
 * @return type
 * @since 1.0.0
 * @category helpers
 */
function neodent_excerpt_more_link( $more ) {
	global $post;
	return '... <a class="more-link" href="' . esc_url( get_permalink( $post->ID ) ) . '" rel="bookmark">' . __( 'Read more', 'neodent' ) . '</a>';
}

/**
 * define if you want to use automatically the continue reading button
 * on the default Wordpress exceprt
 */
define('_USE_READ_MORE_AUTO', true);


if ( !function_exists( 'neodent_excerpt_more' ) && !is_admin() && _USE_READ_MORE_AUTO) :

	/**
	 * Replaces "[...]" (appended to automatically generated excerpts) with ... and a 'Continue reading' link.
	 * 
	 * @since 1.0.0
	 * @return string 'Continue reading' link prepended with an ellipsis.
	 * @category filters
	 */
	function neodent_excerpt_more( $more ) {
		$link = sprintf( '<a href="%1$s" class="more-link">%2$s</a>', esc_url( get_permalink( get_the_ID() ) ),
				/* translators: %s: Name of current post */ sprintf( __( 'Continue reading %s', 'neodent' ), '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>' )
		);
		return ' &hellip; ' . $link;
	}

	add_filter( 'excerpt_more', 'neodent_excerpt_more' );
endif;