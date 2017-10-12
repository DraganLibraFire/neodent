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
 * @name Custom functions if need any
 * Used for a couple of theme hooks, stylesheet and scripts init etc
 * @group functions
 * @category custom
 */

/**
 * Add additional user contact informations
 * @param type $user_contact
 * @return type
 * @category hooks
 */
function neodent_modify_user_contact_methods( $user_contact ) {

	/* Add user contact methods */
	$user_contact['twitter'] = __( 'Twitter Profile URL', 'neodent' ); 
	$user_contact['facebook'] = __( 'Facebook Profile URL', 'neodent' );
	$user_contact['linkedin'] = __( 'LinkedIn Profile URL', 'neodent' );

	/* Remove user contact methods */
	unset( $user_contact['aim'] );
	unset( $user_contact['jabber'] );

	return $user_contact;
}
add_filter( 'user_contactmethods', 'neodent_modify_user_contact_methods' );