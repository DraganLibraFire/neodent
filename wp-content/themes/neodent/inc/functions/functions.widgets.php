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
 * Register widget area.
 * @since 1.0.0
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
function neodent_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'neodent' ),
		'id'            => 'sidebar-primary',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'neodent' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'FAQ Sidebar', 'neodent' ),
		'id'            => 'sidebar-faq',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'neodent' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer top 1', 'neodent' ),
		'id'            => 'footer-first',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'neodent' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer top 2', 'neodent' ),
		'id'            => 'footer-second',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'neodent' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer top 3', 'neodent' ),
		'id'            => 'footer-third',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'neodent' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer top 4', 'neodent' ),
		'id'            => 'footer-fourth',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'neodent' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Drustvene Mreze', 'neodent' ),
		'id'            => 'footer-bottom-first',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'neodent' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer bottom 2', 'neodent' ),
		'id'            => 'footer-bottom-second',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'neodent' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer bottom 3', 'neodent' ),
		'id'            => 'footer-bottom-third',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'neodent' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'neodent_widgets_init' );