 <?php

// /* 
//  * Verteez X-Dubai website
//  * -----------------------------------------------------------
//  * @package X-Dubai - Multipurpose Wordpress Theme
//  * @subpackage Verteez X-Dubai
//  * @copyright Copyright (c), Verteez X-Dubai,  (http://www.themezkitchen.com/)
//  * @link http://www.verteez.com/
//  * @version 1.0.0
//  * @since Version 1.0.0
//  */


if ( ! function_exists('dentist_page') ) {

// Register Custom Post Type
function dentist_page() {
        global $theme_settings;
	$labels = array(
		'name'                => _x( 'Stomatologija', 'Post Type General Name', 'neodent' ),
		'singular_name'       => _x( 'Stomatologija', 'Post Type Singular Name', 'neodent' ),
		'menu_name'           => __( 'Stomatologija', 'neodent' ),
		'parent_item_colon'   => __( 'Roditeljska sekcija:', 'neodent' ),
		'all_items'           => __( 'Sve Stomatologije', 'neodent' ),
		'view_item'           => __( 'Pogledajte Stomatologija stranicu', 'neodent' ),
		'add_new_item'        => __( 'Dodajte novu Stomatologija stranicu', 'neodent' ),
		'add_new'             => __( 'Dodajte novu', 'neodent' ),
		'edit_item'           => __( 'Izmenite stranicu Stomatologija', 'neodent' ),
		'update_item'         => __( 'Azurirajte stranicu Stomatologija', 'neodent' ),
		'search_items'        => __( 'Pretrazite stranicu Stomatologija', 'neodent' ),
		'not_found'           => __( 'Nije nadjena', 'neodent' ),
		'not_found_in_trash'  => __( 'Nije nadjena u Otpadu', 'neodent' ),
	);
	$rewrite = array(
		'slug'                => $theme_settings['opt-dentist-slug'],
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'dentist_page', 'neodent' ),
		'description'         => __( 'Stomatologija post type', 'neodent' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'thumbnail', 'page-attributes', 'excerpt' ),
		//'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 20,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'page',
	);
	register_post_type( 'dentist_page', $args );

}

// Hook into the 'init' action
add_action( 'init', 'dentist_page', 0 );

}


if ( ! function_exists('tehnic_page') ) {

    
// Register Custom Post Type
function tehnic_page() {
        global $theme_settings;
	$labels = array(
		'name'                => _x( 'Zubna tehnika', 'Post Type General Name', 'neodent' ),
		'singular_name'       => _x( 'Zubna tehnika', 'Post Type Singular Name', 'neodent' ),
		'menu_name'           => __( 'Zubna tehnika', 'neodent' ),
		'parent_item_colon'   => __( 'Roditeljska sekcija:', 'neodent' ),
		'all_items'           => __( 'Sve Zubne tehnike', 'neodent' ),
		'view_item'           => __( 'Pogledajte Zubnu tehniku', 'neodent' ),
		'add_new_item'        => __( 'Dodajte novu Zubnu tehniku', 'neodent' ),
		'add_new'             => __( 'Dodajte novu', 'neodent' ),
		'edit_item'           => __( 'Izmenite Zubnu tehniku', 'neodent' ),
		'update_item'         => __( 'Azurirajte Zubnu tehniku', 'neodent' ),
		'search_items'        => __( 'Pretrazite Zubnu tehniku', 'neodent' ),
		'not_found'           => __( 'Nije pronadjena', 'neodent' ),
		'not_found_in_trash'  => __( 'Nije pronadjena u otpadu', 'neodent' ),
	);
	$rewrite = array(
		'slug'                => $theme_settings['opt-tehnic-slug'],
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'tehnic_page', 'neodent' ),
		'description'         => __( 'Zubna tehnika post type', 'neodent' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'thumbnail', 'page-attributes', 'excerpt' ),
		//'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 21,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'page',
	);
	register_post_type( 'tehnic_page', $args );

}

// Hook into the 'init' action
add_action( 'init', 'tehnic_page', 0 );

}


/*EQUIPMENT*/
if ( ! function_exists('offer_page') ) {

    
// Register Custom Post Type
function offer_page() {
        global $theme_settings;
	$labels = array(
		'name'                => _x( 'Specijalne ponude', 'Post Type General Name', 'neodent' ),
		'singular_name'       => _x( 'Specijalna ponuda', 'Post Type Singular Name', 'neodent' ),
		'menu_name'           => __( 'Specijalna ponuda', 'neodent' ),
		'parent_item_colon'   => __( 'Roditeljska sekcija:', 'neodent' ),
		'all_items'           => __( 'Sve Specijalne ponude', 'neodent' ),
		'view_item'           => __( 'Pogledajte Specijalnu ponudu', 'neodent' ),
		'add_new_item'        => __( 'Dodajte novu Specijalnu ponudu', 'neodent' ),
		'add_new'             => __( 'Dodajte novu', 'neodent' ),
		'edit_item'           => __( 'Izmenite Specijalnu ponudu', 'neodent' ),
		'update_item'         => __( 'Azurirajte Specijalnu ponudu', 'neodent' ),
		'search_items'        => __( 'Pretrazite Specijalnu ponudu', 'neodent' ),
		'not_found'           => __( 'Nije pronadjena', 'neodent' ),
		'not_found_in_trash'  => __( 'Nije pronadjena u Otpadu', 'neodent' ),
	);
	$rewrite = array(
		'slug'                => 'offer',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'offer_page', 'neodent' ),
		'description'         => __( 'Specijalna ponuda post type', 'neodent' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'thumbnail', 'page-attributes', 'editor', 'excerpt' ),
		//'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 22,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'page',
	);
	register_post_type( 'offer_page', $args );

}
add_action( 'init', 'create_offer_page_taxonomy', 0 );

//create two taxonomies, genres and writers for the post type "book"
function create_offer_page_taxonomy() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Specijalne ponude Kategorije', 'taxonomy general name' ),
		'singular_name'     => _x( 'Specijalne ponude Kategorija', 'taxonomy singular name' ),
		'search_items'      => __( 'Pretrazi Specijalne ponude Kategorije' ),
		'all_items'         => __( 'Sve Kategorije Specijalnih ponuda' ),
		'parent_item'       => __( 'Roditelj Specijalnih ponuda Kategorija' ),
		'parent_item_colon' => __( 'Roditelj Specijalnih ponuda Kategorija:' ),
		'edit_item'         => __( 'Izmeni Specijalne ponude Kategoriju' ),
		'update_item'       => __( 'Azuriraj Specijalne ponude Kategoriju' ),
		'add_new_item'      => __( 'Dodaj Specijalne ponude Kategoriju' ),
		'new_item_name'     => __( 'Ime novih Specijalnih ponuda Kategorija' ),
		'menu_name'         => __( 'Specijalne ponude Kategorija' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'offer_taxonomy' ),
	);

	register_taxonomy( 'offer_taxonomy', array( 'offer_page' ), $args );
}

add_action( 'init', 'offer_page', 0 );

}


if ( ! function_exists('magazine_page') ) {

    
// Register Custom Post Type
function magazine_page() {
        global $theme_settings;
	$labels = array(
		'name'                => _x( 'Casopisi', 'Post Type General Name', 'neodent' ),
		'singular_name'       => _x( 'Casopis', 'Post Type Singular Name', 'neodent' ),
		'menu_name'           => __( 'Casopis', 'neodent' ),
		'parent_item_colon'   => __( 'Roditeljska sekcija:', 'neodent' ),
		//'all_items'           => __( 'All Vision & Missions', 'xdubai' ),
		'view_item'           => __( 'Pogledajte Casopis', 'neodent' ),
		'add_new_item'        => __( 'Dodajte novi Casopis', 'neodent' ),
		'add_new'             => __( 'Dodajte novi', 'neodent' ),
		'edit_item'           => __( 'Izmenite Casopis', 'neodent' ),
		'update_item'         => __( 'Ažurirajte Casopis', 'neodent' ),
		'search_items'        => __( 'Pretražite Casopise', 'neodent' ),
		'not_found'           => __( 'Nije pronađeno', 'neodent' ),
		'not_found_in_trash'  => __( 'Nije pronađeno u Otpadu', 'neodent' ),
	);
	$rewrite = array(
		'slug'                => $theme_settings['opt-magazine-slug'],
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'magazine_page', 'neodent' ),
		'description'         => __( 'Casopis post type', 'neodent' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'thumbnail', 'page-attributes', 'editor', 'excerpt' ),
		//'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 23,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'page',
	);
	register_post_type( 'magazine_page', $args );

}

// Hook into the 'init' action
add_action( 'init', 'magazine_page', 0 );

}


if ( ! function_exists('contact_page') ) {

    
// Register Custom Post Type
function contact_page() {
        global $theme_settings;
	$labels = array(
		'name'                => _x( 'Kontakti', 'Post Type General Name', 'neodent' ),
		'singular_name'       => _x( 'Kontakt', 'Post Type Singular Name', 'neodent' ),
		'menu_name'           => __( 'Kontakt stranica', 'neodent' ),
		'parent_item_colon'   => __( 'Roditeljska sekcija:', 'neodent' ),
		//'all_items'           => __( 'All Vision & Missions', 'xdubai' ),
		'view_item'           => __( 'Pogledajte Kontakt', 'neodent' ),
		'add_new_item'        => __( 'Dodajte novi Kontakt', 'neodent' ),
		'add_new'             => __( 'Dodajte novi', 'neodent' ),
		'edit_item'           => __( 'Izmenite Kontakt', 'neodent' ),
		'update_item'         => __( 'Ažurirajte Kontakt', 'neodent' ),
		'search_items'        => __( 'Pretražite Kontakt', 'neodent' ),
		'not_found'           => __( 'Nije pronađeno', 'neodent' ),
		'not_found_in_trash'  => __( 'Nije pronađeno u Otpadu', 'neodent' ),
	);
	$rewrite = array(
		'slug'                => $theme_settings['opt-contact-slug'],
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'contact_page', 'neodent' ),
		'description'         => __( 'Kontakt post type', 'neodent' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'page-attributes' ),
		//'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 17,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'page',
	);
	register_post_type( 'contact_page', $args );

}

// Hook into the 'init' action
add_action( 'init', 'contact_page', 0 );

}


if ( ! function_exists('manifacturers_page') ) {

    
// Register Custom Post Type
function manifacturers_page() {
        global $theme_settings;
	$labels = array(
		'name'                => _x( 'Proizvodjaci', 'Post Type General Name', 'neodent' ),
		'singular_name'       => _x( 'Proizvodjac', 'Post Type Singular Name', 'neodent' ),
		'menu_name'           => __( 'Proizvodjaci stranica', 'neodent' ),
		'parent_item_colon'   => __( 'Roditeljska sekcija:', 'neodent' ),
		//'all_items'           => __( 'All Vision & Missions', 'xdubai' ),
		'view_item'           => __( 'Pogledajte Proizvodjace', 'neodent' ),
		'add_new_item'        => __( 'Dodajte nove Proizvodjace', 'neodent' ),
		'add_new'             => __( 'Dodajte novi', 'neodent' ),
		'edit_item'           => __( 'Izmenite Proizvodjace', 'neodent' ),
		'update_item'         => __( 'Ažurirajte Proizvodjace', 'neodent' ),
		'search_items'        => __( 'Pretražite Proizvodjaci', 'neodent' ),
		'not_found'           => __( 'Nije pronađeno', 'neodent' ),
		'not_found_in_trash'  => __( 'Nije pronađeno u Otpadu', 'neodent' ),
	);
	$rewrite = array(
		'slug'                => $theme_settings['opt-proizvodjaci-slug'],
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'manifacturers_page', 'neodent' ),
		'description'         => __( 'Proizvodjaci post type', 'neodent' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'thumbnail', 'page-attributes' ),
		//'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 19,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'page',
	);
	register_post_type( 'manifacturers_page', $args );

}

// Hook into the 'init' action
add_action( 'init', 'manifacturers_page', 0 );

}


if ( ! function_exists('testimonials_page') ) {


// Register Custom Post Type
	function testimonials_page() {
		global $theme_settings;
		$labels = array(
				'name'                => _x( 'Testimonials', 'Post Type General Name', 'neodent' ),
				'singular_name'       => _x( 'Testimonial', 'Post Type Singular Name', 'neodent' ),
				'menu_name'           => __( 'Testimonials stranica', 'neodent' ),
				'parent_item_colon'   => __( 'Roditeljska sekcija:', 'neodent' ),
			//'all_items'           => __( 'All Vision & Missions', 'xdubai' ),
				'view_item'           => __( 'Pogledajte Testimoniale', 'neodent' ),
				'add_new_item'        => __( 'Dodajte nove Testimoniale', 'neodent' ),
				'add_new'             => __( 'Dodajte novi', 'neodent' ),
				'edit_item'           => __( 'Izmenite Testimoniale', 'neodent' ),
				'update_item'         => __( 'Ažurirajte Testimoniale', 'neodent' ),
				'search_items'        => __( 'Pretražite Testimonials', 'neodent' ),
				'not_found'           => __( 'Nije pronađeno', 'neodent' ),
				'not_found_in_trash'  => __( 'Nije pronađeno u Otpadu', 'neodent' ),
		);
		$rewrite = array(
				'slug'                => $theme_settings['opt-testimonial-slug'],
				'with_front'          => true,
				'pages'               => true,
				'feeds'               => true,
		);
		$args = array(
				'label'               => __( 'testimonials_page', 'neodent' ),
				'description'         => __( 'Testimonials post type', 'neodent' ),
				'labels'              => $labels,
				'supports'            => array( 'title', 'thumbnail', 'page-attributes', 'editor' ),
			//'taxonomies'          => array( 'category', 'post_tag' ),
				'hierarchical'        => false,
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'show_in_nav_menus'   => true,
				'show_in_admin_bar'   => true,
				'menu_position'       => 19,
				'can_export'          => true,
				'has_archive'         => true,
				'exclude_from_search' => true,
				'publicly_queryable'  => true,
				'rewrite'             => $rewrite,
				'capability_type'     => 'page',
		);
		register_post_type( 'testimonials_page', $args );

	}

// Hook into the 'init' action
	add_action( 'init', 'testimonials_page', 0 );

}

 if ( ! function_exists('edukacije') ) {


// Register Custom Post Type
	 function edukacije() {
		 global $theme_settings;
		 $labels = array(
				 'name'                => _x( 'Edukacije', 'Post Type General Name', 'neodent' ),
				 'singular_name'       => _x( 'Edukacija', 'Post Type Singular Name', 'neodent' ),
				 'menu_name'           => __( 'Edukacije', 'neodent' ),
				 'parent_item_colon'   => __( 'Roditeljska sekcija:', 'neodent' ),
			 	'all_items'            => __( 'Sve edukacije', 'neodent' ),
				 'view_item'           => __( 'Pogledajte Edukacije', 'neodent' ),
				 'add_new_item'        => __( 'Dodajte nove Edukacije', 'neodent' ),
				 'add_new'             => __( 'Dodajte novi', 'neodent' ),
				 'edit_item'           => __( 'Izmenite Edukacije', 'neodent' ),
				 'update_item'         => __( 'Ažurirajte Edukacije', 'neodent' ),
				 'search_items'        => __( 'Pretražite Edukacije', 'neodent' ),
				 'not_found'           => __( 'Nije pronađeno', 'neodent' ),
				 'not_found_in_trash'  => __( 'Nije pronađeno u Otpadu', 'neodent' ),
		 );
		 $rewrite = array(
//				 'slug'                => $theme_settings['opt-testimonial-slug'],
				 'with_front'          => true,
				 'pages'               => true,
				 'feeds'               => true,
		 );
		 $args = array(
				 'label'               => __( 'edukacije', 'neodent' ),
				 'description'         => __( 'Edukacije post type', 'neodent' ),
				 'labels'              => $labels,
				 'supports'            => array( 'title', 'thumbnail', 'page-attributes', 'editor' ),
			 //'taxonomies'          => array( 'category', 'post_tag' ),
				 'hierarchical'        => false,
				 'public'              => true,
				 'show_ui'             => true,
				 'show_in_menu'        => true,
				 'show_in_nav_menus'   => true,
				 'show_in_admin_bar'   => true,
				 'menu_position'       => 19,
				 'can_export'          => true,
				 'has_archive'         => true,
				 'exclude_from_search' => true,
				 'publicly_queryable'  => true,
				 'rewrite'             => $rewrite,
				 'capability_type'     => 'page',
				 'menu_icon'   => 'dashicons-products',
		 );
		 register_post_type( 'edukacije', $args );

	 }

// Hook into the 'init' action
	 add_action( 'init', 'edukacije', 0 );

 }