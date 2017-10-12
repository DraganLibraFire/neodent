<?php
ob_start();
error_reporting(0);
$custom_product_price;
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
 * @name Main function file
 * Used for theme initialisation
 * @group functions
 * @category main
 */
/**
 * Main function for the template
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 */
/**
 * Some global defines for easier theme development
 */
//Use or not the featured posts functionality
define('_USE_FUNC_FEATURED', true);
//Define if the theme allows post formats
define('_ALLOWED_POST_FORMATS', true);
//Define the minimum WordPress version
define('_WP_VERSION_DECLARED', '4.1-alpha');

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since 1.0.0
 */
if (!isset($content_width)) {
    $content_width = 1150;
}

/**
 * Include the custom post types
 */
require get_template_directory() . '/inc/post-types.php';
/**
 * Requires at least Wordpress 4.1
 * If user has not installed Wordpress 4.1 versions
 * the notice is displayed to upgrade
 *
 * @since 1.0.0
 */
if (version_compare($GLOBALS['wp_version'], _WP_VERSION_DECLARED, '<')) {
    require get_template_directory() . '/inc/back-compat.php';
}

/*
 * Include Redux Framework for theme settings
 * @since 1.0.0
 */
if (!class_exists('ReduxFramework') && file_exists(get_template_directory() . '/admin/ReduxCore/framework.php')) {
    require_once(get_template_directory() . '/admin/ReduxCore/framework.php');
}
if (!isset($neodent_theme_settings) && file_exists(get_template_directory() . '/admin/sample/sample-config.php')) {
    require_once(get_template_directory() . '/admin/options.php');
}

if (isset($neodent_theme_settings)) {
    load_template(trailingslashit(get_template_directory()) . 'inc/plugins/envato/envato-wp-theme-updater.php');
    Envato_WP_Theme_Updater::init(@$neodent_theme_settings['opt-envato-username'], @$neodent_theme_settings['opt-envato-apikey'], 'themezkitchen');
}


if (!function_exists('neodent_setup')) :

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     *
     * @category hooks
     * @since 1.0.0
     */
    function neodent_setup()
    {
        global $neodent_theme_settings;
        /*
         * Make Theme available for translation.
         *
         * Translations can be added to the /languages/ directory.
         * If you're building a child theme based on this theme, use a find and
         * replace to change 'neodent' to the name of your theme in all
         * template files.
         */
        load_theme_textdomain('neodent', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
         */
        add_theme_support('post-thumbnails');
        /**
         * If you want to declare the specifif size of the featured image
         * uncomment the default size bellow
         */
        set_post_thumbnail_size(300, 300, true);
        // or without cropping (which is the best for the user experience)
        // set_post_thumbnail_size( 1150);


        /**
         * Add image sizes for the template
         * Uncomment the following line (or create a new lines for the new image sizes)
         */
        add_image_size('neodent-square-large', 1200, 500, false);
        add_image_size('neodent-magazine-large', 260, 300, false);
        add_image_size('neodent-square-thumbnail', 300, 300, true);
        add_image_size('neodent-horizontally-thumbnail', 320, 280, true);
        add_image_size('neodent-testimonial-avatar', 80, 80, true);
        /**
         * Add the nav menus
         * If you want to add more, just add the menus to the array
         */
        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus(array(
            'primary' => __('Primary Menu', 'neodent'),
            'header-sub-menu' => __('The Header Sub Menu', 'neodent'),
            'woocommerce-menu' => __('Woocommerce menu', 'neodent'),
            'footer-menu' => __('The Footer Menu', 'neodent')
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
        ));


        /**
         * Enable support for all Post Formats.
         * If you want you can disable some of them (see the header of this document)
         *
         * @link https://codex.wordpress.org/Post_Formats Post Formats Codex
         */
        if (_ALLOWED_POST_FORMATS) :
            add_theme_support('post-formats', array(
                'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
            ));
        endif;


        /**
         * If you want uncomment the following line to enable the custom editor styling to resemble the theme style,
         * specifically font, colors, icons, and column width.
         */
        //add_editor_style( array( 'css/editor-styling.css' ) );

        /**
         * If you want to use featured content displayed in some manner
         * You can use the following function
         * If not, the function will not be used
         * that you must remove the function and the class for the featured content
         */
        // Add support for featured content.
        if (empty($neodent_theme_settings['max-posts'])) :
            $neodent_theme_settings['max-posts'] = 11;
        endif;

        /*	if ( NEODENT_USE_FUNC_FEATURED  && $neodent_theme_settings['opt-show-featured'] && !empty($neodent_theme_settings['opt-show-featured']) ) :
                add_theme_support( 'featured-content', array(
                    'featured_content_filter' => 'neodent_get_featured_posts',
                    'max_posts' => $neodent_theme_settings['max-posts'],
                ) );
            endif;*/
    }

endif;
//add setup
add_action('after_setup_theme', 'neodent_setup');


/* ------------------------------------------------
   Register Dependant Javascript Files
------------------------------------------------ */
function my_scripts()
{
    global $post;

    // if( !is_admin() ){
    // 	wp_deregister_script('jquery');
    // 	wp_register_script('jquery', ("https://code.jquery.com/jquery-1.10.2.min.js"), false, '');
    // 	wp_enqueue_script('jquery');
    // 	// wp_register_script('imeskripte', ("https://code.jquery.com/nazivfajla.js"),  array( 'jquery' ));
    //  // 		wp_enqueue_script('imeskripte');
    // }

    //wp_enqueue_script( 'tabs-jquery', get_template_directory_uri() . '/js/external/jquery/jquery.js', array( 'jquery' ) );
    wp_enqueue_script('tabs-js', get_template_directory_uri() . '/js/jquery-ui.js', array('jquery'));
    wp_enqueue_script('nicescroll-js', get_template_directory_uri() . '/js/jquery.nicescroll.min.js', array('jquery'));
    wp_enqueue_script('chosen-selection', get_template_directory_uri() . '/js/chosen.jquery.js', array('jquery'), '1', true);

}

add_action('wp_enqueue_scripts', 'my_scripts');


//If we use fetaired functionality, include the file
if (_USE_FUNC_FEATURED) :

    /**
     * Getter function for Featured Content Plugin.
     * @since 1.0.0
     * @return array An array of WP_Post objects
     * @category filters
     */
    function neodent_get_featured_posts()
    {
        /**
         * Filter the featured posts to return
         * @since 1.0.0
         * @param array|bool $posts Array of featured posts, otherwise false.
         */
        return apply_filters('neodent_get_featured_posts', array());
    }

    /**
     * A helper conditional function that returns a boolean value.
     * @since  1.0.0
     * @return bool Whether there are featured posts.
     * @category helpers
     */
    function neodent_has_featured_posts()
    {
        return !is_paged() && (bool)neodent_get_featured_posts();
    }

    /*
     * Add Featured Content functionality.
     *
     * To overwrite in a plugin, define your own Featured_Content class on or
     * before the 'setup_theme' hook.
     */
    if (!class_exists('Featured_Content') && 'plugins.php' !== $GLOBALS['pagenow']) {
        require get_template_directory() . '/inc/plugins/featured-content.php';
    }
endif;

//Woocommerce my theme settings
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

function my_theme_wrapper_start()
{
    echo '<main id="main" class="site-main" role="main">';
}

function my_theme_wrapper_end()
{
    echo '</main>';
}

add_action('after_setup_theme', 'woocommerce_support');
function woocommerce_support()
{
    add_theme_support('woocommerce');
}


//Hide price of products in all pages
// add_filter('woocommerce_get_price_html','members_only_price');
// function members_only_price($price){
// if(is_user_logged_in() ){
//     return $price;
// }
// else return '<div class="price"><a href="' .get_permalink(woocommerce_get_page_id('myaccount')). '">Prijavite se</a> ili <a href="'.site_url('/wp-login.php?action=register&redirect_to=' . get_permalink()).'">Registrujte</a> da vidite cenu!</div>';
// }


//Moving share buttons from bottom to top of the product page
add_action('woocommerce_share', 'patricks_woocommerce_social_share_icons', 10);
function patricks_woocommerce_social_share_icons()
{
    if (function_exists('sharing_display')) {
        remove_filter('the_content', 'sharing_display', 19);
        remove_filter('the_excerpt', 'sharing_display', 19);
        echo sharing_display();
    }
}

//Add currency to woocommerce
add_filter('woocommerce_currencies', 'add_my_currency');

function add_my_currency($currencies)
{
    $currencies['ABC'] = __('Dinara', 'woocommerce');
    return $currencies;
}

add_filter('woocommerce_currency_symbol', 'add_my_currency_symbol', 10, 2);

function add_my_currency_symbol($currency_symbol, $currency)
{
    switch ($currency) {
        case 'ABC':
            $currency_symbol = 'RSD';
            break;
    }
    return $currency_symbol;
}


/**
 * Add new register fields for WooCommerce registration.
 *
 * @return string Register fields HTML.
 */
function wooc_extra_register_fields()
{
    ?>

    <p class="form-row form-row-first">
        <label for="reg_billing_first_name"><?php _e('Ime', 'woocommerce'); ?> <span class="required">*</span></label>
        <input type="text" class="input-text" name="billing_first_name" id="reg_billing_first_name"
               value="<?php if (!empty($_POST['billing_first_name'])) esc_attr_e($_POST['billing_first_name']); ?>"/>
    </p>

    <p class="form-row form-row-last">
        <label for="reg_billing_last_name"><?php _e('Prezime', 'woocommerce'); ?> <span
                class="required">*</span></label>
        <input type="text" class="input-text" name="billing_last_name" id="reg_billing_last_name"
               value="<?php if (!empty($_POST['billing_last_name'])) esc_attr_e($_POST['billing_last_name']); ?>"/>
    </p>

    <div class="clear"></div>

    <p class="form-row form-row-wide">
        <label for="reg_billing_company"><?php _e('Firma', 'woocommerce'); ?>
            <!-- <span class="required">*</span> --></label>
        <input type="text" class="input-text" name="billing_company" id="reg_billing_company"
               value="<?php if (!empty($_POST['billing_company'])) esc_attr_e($_POST['billing_company']); ?>"/>
    </p>

    <p class="form-row form-row-wide">
        <label for="reg_billing_phone"><?php _e('Telefon', 'woocommerce'); ?><span class="required">*</span> </label>
        <input type="text" class="input-text" name="billing_phone" id="reg_billing_phone"
               value="<?php if (!empty($_POST['billing_phone'])) esc_attr_e($_POST['billing_phone']); ?>"/>

    </p>

    <p class="form-row form-row-wide">
        <label for="reg_billing_address_1"><?php _e('Adresa', 'woocommerce'); ?>
            <!-- <span class="required">*</span> --></label>
        <input type="text" class="input-text" name="billing_address_1" id="reg_billing_address_1"
               value="<?php if (!empty($_POST['billing_address_1'])) esc_attr_e($_POST['billing_address_1']); ?>"/>
    </p>

    <?php
}

add_action('woocommerce_register_form', 'wooc_extra_register_fields');


/**
 * Validate the extra register fields.
 *
 * @param  string $username Current username.
 * @param  string $email Current email.
 * @param  object $validation_errors WP_Error object.
 *
 * @return void
 */
function wooc_validate_extra_register_fields($username, $email, $validation_errors)
{
    if (isset($_POST['billing_first_name']) && empty($_POST['billing_first_name'])) {
        $validation_errors->add('billing_first_name_error', __('<strong>Greška </strong>: Ime je obavezno!', 'woocommerce'));
    }

    if (isset($_POST['billing_last_name']) && empty($_POST['billing_last_name'])) {
        $validation_errors->add('billing_last_name_error', __('<strong>Greška </strong>: Prezime je obavezno!.', 'woocommerce'));
    }

    if (isset($_POST['billing_phone']) && empty($_POST['billing_phone'])) {
        $validation_errors->add('billing_phone', __('<strong>Error</strong>: Telefon je obavezan!.', 'woocommerce'));
    }

    // if ( isset( $_POST['billing_company'] ) && empty( $_POST['billing_company'] ) ) {
    // 	$validation_errors->add( 'billing_company', __( '<strong>Error</strong>: Ovo polje je obavezno!.', 'woocommerce' ) );
    // }
}

add_action('woocommerce_register_post', 'wooc_validate_extra_register_fields', 10, 3);


/**
 * Require all necessary modules and plugins
 */
//gallery images getter functions
require get_template_directory() . '/inc/plugins/gallery-getter.php';
//hybrid image getter class and helper function to grab all images from the post
require get_template_directory() . '/inc/plugins/hybrid-image-getter.php';
//simple image getter also a simple function to retrieve all or single images from the post
require get_template_directory() . '/inc/plugins/simple-image-getter.php';
//Media grabber class for taking (extracting) embeds from the post, like youtube video, audio etc
require get_template_directory() . '/inc/plugins/media-grabber.php';


/**
 * Require nav walkers
 */
//Bootstrap nav walker class
require get_template_directory() . '/inc/walkers/bootstrap-walker.php';
//clean and simple walker
require get_template_directory() . '/inc/walkers/clean-walker.php';

/**
 *
 */
/**
 * Add other functions
 */
require get_template_directory() . '/inc/functions/functions.widgets.php';
require get_template_directory() . '/inc/functions/functions.theme.php';
require get_template_directory() . '/inc/functions/functions.excerpts.php';
require get_template_directory() . '/inc/functions/functions.comments.php';
require get_template_directory() . '/inc/functions/functions.custom.php';

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 41);

remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

function wdm_add_custom_fields()
{
    /** if you have used ACF to add custom fields **/
    if (get_field("odaberite_proizvodjaca")) {
        if (get_field('logo_proizvodjaca', get_field("odaberite_proizvodjaca")->ID)) {
            echo "<div class='manufacturer-logo-content-wrap clearfix'>";
            echo "<div class='manufacturer-logo-single-wrap pull-left'>";
//                    echo "<p>Proizvođač: </p>";
            echo '<img src="' . get_field('logo_proizvodjaca', get_field("odaberite_proizvodjaca")->ID) . '" />';
            echo "</div>";
            echo "<div class='manufacturer-share-icons pull-right'>";
            echo do_shortcode('[ssba]');
            echo "</div>";
            echo "</div>";
        }
    }
}

add_action('woocommerce_single_product_summary', 'wdm_add_custom_fields', 65);


function my_post_queries($query)
{
    // not an admin page and it is the main query
    if (!is_admin() && $query->is_main_query()) {

        if (is_tax()) {

            // show 50 posts on custom taxonomy pages
            $query->set('posts_per_page', 12);

        }
    }
}

add_action('pre_get_posts', 'my_post_queries');


add_filter('woocommerce_variable_price_html', 'custom_variation_price', 10, 2);

function custom_variation_price($price, $product)
{

    $price = '';

    if (!$product->min_variation_price || $product->min_variation_price !== $product->max_variation_price) {
        $price .= '<span class="from">' . _x('OD', 'min_price', 'woocommerce') . ' </span>';
        $price .= woocommerce_price($product->get_price());
    } else {
        $price .= woocommerce_price($product->get_price());
    }

    return $price;
}

add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
    function loop_columns()
    {
        return 3; // 3 products per row
    }
}

function woocommerce_template_description()
{
    ?>
    <div class="woocommerce-tabs-lf">

        <div class="panel entry-content" id="tab-description">

            <!--            <h2>Opis Proizvoda</h2>-->

            <?php
            global $product;
            echo get_post($product->post->ID)->post_content;

            ?>
        </div>

    </div>
    <?php

}

function limit_text_lf($type, $limit, $echo = true)
{

    $content_to_limit = '';
    $html = '';

    if ($type == 'title')
        $content_to_limit = get_the_title();
    elseif ($type == 'excerpt')
        $content_to_limit = get_the_excerpt();
    else {
        $content_to_limit = get_the_content();
    }


    if (strlen(mb_substr($content_to_limit, 0, $limit, 'UTF-8')) > ($limit - 3)) {
        $html = substr_replace(mb_substr($content_to_limit, 0, $limit, 'UTF-8'), '...', -3);
    } else {
        $html = $content_to_limit;
    }

    if ($echo)
        echo $html;
    else
        return $html;

}

add_filter('woocommerce_checkout_fields', 'custom_override_checkout_fields');
add_filter('woocommerce_billing_fields', 'custom_override_checkout_fields');
add_filter('woocommerce_shipping_fields', 'custom_override_checkout_fields');
function custom_override_checkout_fields($fields)
{

    unset($fields['billing']['billing_country']);
    unset($fields['billing_country']);
//	unset($fields['billing']['billing_state']);
    unset($fields['billing_postcode']);
    unset($fields['billing']['billing_postcode']);
    unset($fields['billing']['billing_country']);
    unset($fields['shipping_country']);
    unset($fields['shipping_state']);
    unset($fields['shipping_postcode']);
    $fields['billing']['billing_state'] = array(
        'label' => __('PIB', 'woocommerce'),
        'placeholder' => _x('PIB', 'placeholder', 'woocommerce'),
        'required' => false,
        'class' => array('form-row-wide'),
        'clear' => true
    );
    $fields['billing']['billing_address_1'] = array(
        'label' => __('Ulica'),
        'placeholder' => _x('Ulica', 'placeholder', 'woocommerce'),
        'required' => false,
        'class' => array('form-row-first'),
        'clear' => false
    );
    $fields['billing']['billing_address_2'] = array(
        'label' => __('Broj'),
        'placeholder' => _x('Broj ulaza, stana (nije obavezno)', 'placeholder', 'woocommerce'),
        'required' => false,
        'class' => array('form-row-last'),
        'clear' => false
    );
    return $fields;

}

require_once 'inc/slick/slick.php';

ob_end_clean();

function category_has_children($term_id = 0, $taxonomy = 'category')
{
    $children = get_categories(array('child_of' => $term_id, 'taxonomy' => $taxonomy));
    return ($children);
}

$term_lfs = new stdClass();

add_filter('xmlrpc_enabled', '__return_false');

function my_modify_main_query($query)
{
    if ( ($query->is_home() && $query->is_main_query()) || ($query->is_category() && $query->is_main_query()) ) { // Run only on the homepage
        if( $query->query_vars['category_name'] == 'NOVOSTI' ){ // Exclude my featured category because I display that elsewhere
            $query->query_vars['posts_per_page'] = 10; // Show only 4 posts on the homepage only
        }
    }
}

add_action('pre_get_posts', 'my_modify_main_query');

add_filter( 'xmlrpc_enabled', '__return_false' );

// Disable X-Pingback to header
add_filter( 'wp_headers', 'disable_x_pingback' );
function disable_x_pingback( $headers ) {
    unset( $headers['X-Pingback'] );

    return $headers;
}

function your_add_to_cart_message() {
    if ( get_option( 'woocommerce_cart_redirect_after_add' ) == 'yes' ) :
        $message = sprintf( '%s<a href="%s" class="your-style">%s</a>', __( 'Proizvod uspešno dodat u korpu! ', 'woocommerce' ), esc_url( get_permalink( woocommerce_get_page_id( 'shop' ) ) ), __( 'Continue Shopping', 'woocommerce' ) );
    else :
        $message = sprintf( '%s<a href="%s" class="your-class">%s</a>', __( 'Proizvod uspešno dodat u korpu! ' , 'woocommerce' ), esc_url( get_permalink( woocommerce_get_page_id( 'cart' ) ) ), __( 'View Cart', 'woocommerce' ) );
    endif;
    return $message;
}
add_filter( 'wc_add_to_cart_message', 'your_add_to_cart_message' );

/**
 * Add Tracking Code to the Thank You Page - http://danielsantoro.com/add-facebook-tracking-pixel-woocommerce-checkout/
 */
function ds_checkout_analytics( $order_id ) {
    $order = new WC_Order( $order_id );
    $total = $order->get_total();

    $items = $order->get_items();
    $product_ids = [];
    foreach ( $items as $item ) {
        $product_ids[] = $item['product_id'];
    }

    ?>
    <!-- Paste Tracking Code Under Here -->
    <script>

        var content_ids = [<?php echo '"'.implode('","', $product_ids).'"' ?>];

        fbq('track', 'Purchase', {
            content_ids: content_ids,
            content_type: 'product',
            value: <?php echo $total; ?>,
            currency: 'RSD'
        });
    </script>

    <!-- End Tracking Code -->
    <?php
}
add_action( 'woocommerce_thankyou', 'ds_checkout_analytics' );

add_filter('frm_setup_new_fields_vars', 'frm_populate_posts', 20, 2);
add_filter('frm_setup_edit_fields_vars', 'frm_populate_posts', 20, 2); //use this function on edit too
function frm_populate_posts($values, $field){
    if($field->id == 78){ //replace 125 with the ID of the field to populate
        $posts = get_posts( array('post_type' => 'edukacije', 'post_status' => array('publish'), 'numberposts' => 999, 'orderby' => 'date', 'order' => 'ASC'));
        unset($values['options']);
        $values['options'] = array(''); //remove this line if you are using a checkbox or radio button field
        foreach($posts as $p){
            $values['options'][$p->post_title] = $p->post_title;
        }
        $values['use_key'] = true; //this will set the field to save the post ID instead of post title
    }
    return $values;
}
if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Podesavanje teme',
		'menu_title'	=> 'Podesavanje teme',
		'menu_slug' 	=> 'theme-lf-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

}
?>