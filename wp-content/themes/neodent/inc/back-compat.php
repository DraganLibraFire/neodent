<?php
/**
 * Theme back compat functionality
 *
 * Prevents the theme from running on WordPress versions prior to 4.1,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.1.
 *
 * @package WordPress
 * @subpackage ThemezKitchen
 * @since 1.0.0
 */

/**
 * Prevent switching to theme on old versions of WordPress.
 * Switches to the default theme.
 * 
 * @since 1.0.0
 */
function neodent_switch_theme() {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'neodent_upgrade_notice' );
}
add_action( 'after_switch_theme', 'neodent_switch_theme' );

/**
 * Add message for unsuccessful theme switch.
 * Prints an update nag after an unsuccessful attempt to switch to
 * theme on WordPress versions prior to 4.1.
 *
 * @since 1.0.0
 */
function neodent_upgrade_notice() {
	$message = sprintf( __( 'This theme requires at least WordPress version 4.1. You are running version %s. Please upgrade and try again.', 'neodent' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevent the Customizer from being loaded on WordPress versions prior to 4.1.
 * 
 * @since 1.0.0
 */
function neodent_customize() {
	wp_die( sprintf( __( 'This theme requires at least WordPress version 4.1. You are running version %s. Please upgrade and try again.', 'neodent' ), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'neodent_customize' );

/**
 * Prevent the Theme Preview from being loaded on WordPress versions prior to 4.1.
 *
 * @since  1.0.0
 */
function neodent_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( 'This theme requires at least WordPress version 4.1. You are running version %s. Please upgrade and try again.', 'neodent' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'neodent_preview' );
