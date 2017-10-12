<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://webappick.com
 * @since             1.0.0
 * @package           Woo_Feed
 *
 * @wordpress-plugin
 * Plugin Name:       WooCommerce Product Feed
 * Plugin URI:        https://webappick.com/
 * Description:       This plugin generate WooCommerce product feed for Shopping Engines like Google Shopping,Facebook Product Feed,eBay,Amazon,Idealo and many more..
 * Version:           2.1.7
 * Author:            WebAppick
 * Author URI:        https://webappick.com/
 * License:           GPL v2
 * License URI:       http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * Text Domain:       woo-feed
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-woo-feed.php';


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-woo-feed-activator.php
 */

function activate_woo_feed()
{
    require plugin_dir_path(__FILE__) . 'includes/class-woo-feed-activator.php';
    Woo_Feed_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-woo-feed-deactivator.php
 */
function deactivate_woo_feed()
{
    require plugin_dir_path(__FILE__) . 'includes/class-woo-feed-deactivator.php';
    Woo_Feed_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_woo_feed');
register_deactivation_hook(__FILE__, 'deactivate_woo_feed');

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_woo_feed()
{
    $plugin = new Woo_Feed();
    $plugin->run();
}

run_woo_feed();

#Custom Cron Recurrences
function custom_cron_job_custom_recurrence($schedules)
{
    $interval = get_option('wf_schedule');
    $schedules['woo_feed_corn'] = array(
        'display' => __('Woo Feed Update Interval', 'woo-feed'),
        'interval' => $interval,
    );

    return $schedules;
}

# Update the schedule interval
add_filter('cron_schedules', 'custom_cron_job_custom_recurrence');
add_action('woo_feed_update', 'woo_feed_cron_update_feed');

# Load Feed Templates
add_action('wp_ajax_get_feed_merchant', 'feed_merchant_view');
function feed_merchant_view()
{
    check_ajax_referer('wpf_feed_nonce');
    $dropDown = new Woo_Feed_Dropdown();
    $product = new Woo_Feed_Products();
    $attributes=new Woo_Feed_Default_Attributes();
    $merchant = sanitize_text_field($_POST['merchant']);
    $provider = sanitize_text_field($_POST['merchant']);
    if(strpos($merchant,'amazon')!==false){
        include plugin_dir_path(__FILE__) . "admin/partials/amazon/add-feed.php";
    }else{
        include plugin_dir_path(__FILE__) . "admin/partials/$merchant/add-feed.php";
    }
    die();
}


/*
 * Update Feed Information
 */
function woo_feed_add_update($info = "", $name = "")
{
    set_time_limit(0);
    if (count($info) && isset($info['provider'])) {
        # GEt Post data
        if ($info['provider'] == 'google') {
            $merchant = "Woo_Feed_Google";
        } elseif ($info['provider'] == 'facebook') {
            $merchant = "Woo_Feed_Facebook";
        }elseif (strpos($info['provider'],'amazon') !==FALSE) {
            $merchant = "Woo_Feed_Amazon";
        }  else {
            $merchant = "Woo_Feed_Custom";
        }



        $feedService = sanitize_text_field($info['provider']);
        $fileName = str_replace(" ", "", sanitize_text_field($info['filename']));
        $type = sanitize_text_field($info['feedType']);

        $feedRules = $info;

        # FTP File Upload Info
        $ftphost = sanitize_text_field($info['ftphost']);
        $ftpuser = sanitize_text_field($info['ftpuser']);
        $ftppassword = sanitize_text_field($info['ftppassword']);
        $ftppath = sanitize_text_field($info['ftppath']);
        $ftpenabled = sanitize_text_field($info['ftpenabled']);

        # Get Feed info
        $products = new Woo_Generate_Feed($merchant, $feedRules);
        $getString = $products->getProducts();

        if($type=='csv'){
            $csvHead[0]=$getString['header'];
            $string=array_merge($csvHead,$getString['body']);
        }else{
            $string=$getString['header'].$getString['body'].$getString['footer'];
        }

        # Check If any products founds
        if ($string) {

            $upload_dir = wp_upload_dir();
            $base = $upload_dir['basedir'];

            # Save File
            $path = $base . "/woo-feed/" . $feedService . "/" . $type;
            $file = $path . "/" . $fileName . "." . $type;
            $save = new Woo_Feed_Savefile();
            if ($type == "csv") {
                $saveFile = $save->saveCSVFile($path, $file, $string, $info);
            } else {
                $saveFile = $save->saveFile($path, $file, $string);
            }

            # Upload file to ftp server
            if ($ftpenabled) {
                $ftp = new FTPClient();
                $ftp->connect($ftphost, $ftpuser, $ftppassword);
                $ftp->uploadFile($file, $ftppath . "/" . $fileName . "." . $type);
                $ftp->getMessages();
            }

            # Save Info into database
            $url = $upload_dir['baseurl'] . "/woo-feed/" . $feedService . "/" . $type . "/" . $fileName . "." . $type;
            $feedInfo = array(
                'feedrules' => $feedRules,
                'url' => $url,
                'last_updated' => date("Y-m-d H:i:s")
            );

            if (!empty($name) && $name != "wf_feed_" . $fileName) {
                delete_option($name);
            }

            $update = update_option('wf_feed_' . $fileName, serialize($feedInfo));
            if ($saveFile) {
                $getInfo = unserialize(get_option('wf_feed_' . $fileName));
                $url = $getInfo['url'];
                return $url;
            } else {
                return false;
            }
        }
    }

    return false;
}

/**
 * Sanitize array post
 *
 * @param $array
 *
 * @return array
 */
function woo_feed_array_sanitize($array)
{
    $newArray = array();
    if (count($array)) {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $key2 => $value2) {
                    if (is_array($value2)) {
                        foreach ($value2 as $key3 => $value3) {
                            $newArray[$key][$key2][$key3] = sanitize_text_field($value3);
                        }
                    } else {
                        $newArray[$key][$key2] = sanitize_text_field($value2);
                    }
                }
            } else {
                $newArray[$key] = sanitize_text_field($value);
            }
        }
    }
    return $newArray;
}

#======================================================================================================================*
#
#   Ajax Feed Making Development Start
#
#======================================================================================================================*


/**
 * Count Total Products
 */

add_action('wp_ajax_get_product_information', 'woo_feed_get_product_information');
add_action('wp_ajax_nopriv_get_product_information', 'woo_feed_get_product_information');
function woo_feed_get_product_information(){
    check_ajax_referer('wpf_feed_nonce');
    $feedName=sanitize_text_field(str_replace("wf_feed_","",$_POST['feed']));
    $feedInfo=get_option($feedName);

    if(!$feedInfo){
        $getFeedConfig=unserialize(get_option($feedName));
        $feedInfo=$getFeedConfig['feedrules'];
    }
    $arg = array(
        'post_type' => array('product','product_variation'),
        'post_status' => 'publish',
        'ignore_sticky_posts' => 1,
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'desc',
        'fields' => 'ids',
    );

    if (get_option('woocommerce_product_feed_pro_activated') && get_option('woocommerce_product_feed_pro_activated') == "Activated") {

        # Argument for Product search by ID
        if (isset($feedInfo['fattribute']) && is_array($feedInfo['fattribute'])) {
            if(count($feedInfo['fattribute'])){
                $condition=$feedInfo['condition'];
                $compare=$feedInfo['filterCompare'];
                $ids_in=array();
                $ids_not_in=array();
                foreach($feedInfo['fattribute'] as $key=>$rule){
                    if($rule=='id' && in_array($condition[$key],array("==","contain"))){
                        unset($feedInfo['fattribute'][$key]);
                        unset($feedInfo['condition'][$key]);
                        unset($feedInfo['filterCompare'][$key]);
                        if (strpos($compare[$key],',') !== false) {
                            foreach(explode(",",$compare[$key]) as $key=>$id){
                                array_push($ids_in,$id);
                            }
                        }else{
                            array_push($ids_in,$compare[$key]);
                        }
                    }elseif($rule=='id' && in_array($condition[$key],array("!=","nContains"))){
                        unset($feedInfo['fattribute'][$key]);
                        unset($feedInfo['condition'][$key]);
                        unset($feedInfo['filterCompare'][$key]);
                        if (strpos($compare[$key],',') !== false) {
                            foreach(explode(",",$compare[$key]) as $key=>$id){
                                array_push($ids_not_in,$id);
                            }
                        }else{
                            array_push($ids_not_in,$compare[$key]);
                        }
                    }
                }

                if(count($ids_in)){
                    $arg['post__in']=$ids_in;
                }

                if(count($ids_not_in)){
                    $arg['post__not_in']=$ids_not_in;
                }
            }
        }

        if (isset($feedInfo['categories']) && is_array($feedInfo['categories']) && !empty($feedInfo['categories'][0])) {
            $i = 0;
            $arg['tax_query']['relation'] = "OR";
            foreach ($feedInfo['categories'] as $key => $value) {
                if (!empty($value)) {
                    $arg['tax_query'][$i]["taxonomy"] = "product_cat";
                    $arg['tax_query'][$i]["field"] = "slug";
                    $arg['tax_query'][$i]["terms"] = $value;
                    $i++;
                }
            }
        }
    }

    # Query Database for products
    $loop = new WP_Query($arg);

    $data=array(
        "product"=>$loop->post_count,
    );

    if($loop->post_count>0){
        $data['success']=true;
        wp_send_json_success($data);
    }else{
        $data['success']=false;
        $data['message']="No product found.";
        wp_send_json_error($data);
    }
    wp_reset_query();
    wp_die();
}

function woo_feed_generate_feed_data($info){
    if (count($info) && isset($info['provider'])) {
        # GEt Post data
        if ($info['provider'] == 'google') {
            $merchant = "Woo_Feed_Google";
        } elseif ($info['provider'] == 'facebook') {
            $merchant = "Woo_Feed_Facebook";
        }elseif (strpos($info['provider'],'amazon') !==FALSE) {
            $merchant = "Woo_Feed_Amazon";
        }elseif ($info['provider'] == 'custom2') {
            $merchant = "Woo_Feed_Custom2";
        } else {
            $merchant = "Woo_Feed_Custom";
        }

        $feedService = sanitize_text_field($info['provider']);
        $fileName = str_replace(" ", "", sanitize_text_field($info['filename']));
        $type = sanitize_text_field($info['feedType']);

        $feedRules = $info;

        # Get Feed info
        $products = new Woo_Generate_Feed($merchant, $feedRules);
        $feed = $products->getProducts();
        if(!empty($feed['body'])){
            $feedHeader="wf_store_feed_header_info_".$fileName;
            $feedBody="wf_store_feed_body_info_".$fileName;
            $feedFooter="wf_store_feed_footer_info_".$fileName;
            $prevFeed= woo_feed_get_batch_feed_info($feedService,$type,$feedBody);//get_option($feedBody);
            if($prevFeed){
                if($type=='csv'){
                    $newFeed=array_merge($prevFeed, $feed['body']);
                }else{
                    $newFeed=$prevFeed.$feed['body'];
                }
                //update_option($feedBody,$newFeed);
                woo_feed_save_batch_feed_info($feedService,$type,$newFeed,$feedBody,$info);
            }else{
                //update_option($feedBody,$feed['body']);
                woo_feed_save_batch_feed_info($feedService,$type,$feed['body'],$feedBody,$info);
            }
            //update_option($feedHeader,$feed['header']);
            woo_feed_save_batch_feed_info($feedService,$type,$feed['header'],$feedHeader,$info);
            //update_option($feedFooter,$feed['footer']);
            woo_feed_save_batch_feed_info($feedService,$type,$feed['footer'],$feedFooter,$info);

            return true;
        }else{
            return false;
        }
    }
    return false;
}

function woo_feed_save_batch_feed_info($feedService,$type,$string,$fileName,$info){

    $upload_dir = wp_upload_dir();
    $base = $upload_dir['basedir'];
    $ext=$type;
    if ($type == "csv") {
        $string=json_encode($string);
        $ext="json";
    }
    # Save File
    $path = $base . "/woo-feed/" . $feedService . "/" . $type;
    $file = $path . "/" . $fileName . "." . $ext;
    $save = new Woo_Feed_Savefile();
    return $save->saveFile($path, $file, $string);
}

function woo_feed_get_batch_feed_info($feedService,$type,$fileName){

    $upload_dir = wp_upload_dir();
    $base = $upload_dir['basedir'];
    $ext=$type;
    if ($type == "csv") {
        $ext="json";
    }
    # Save File
    $path = $base . "/woo-feed/" . $feedService . "/" . $type;
    $file = $path . "/" . $fileName . "." . $ext;

    if ($type == "csv" && file_exists($file)) {
        return (file_get_contents($file))?json_decode(file_get_contents($file),true):false;
    }else if(file_exists($file)){
        return file_get_contents($file);
    }
    return false;
}


add_action('wp_ajax_make_batch_feed', 'woo_feed_make_batch_feed');
add_action('wp_ajax_nopriv_make_batch_feed', 'woo_feed_make_batch_feed');
function woo_feed_make_batch_feed(){
    check_ajax_referer('wpf_feed_nonce');

    $limit=sanitize_text_field($_POST['limit']);
    $offset=sanitize_text_field($_POST['offset']);
    $feedName=sanitize_text_field(str_replace("wf_feed_","",$_POST['feed']));
    $feedInfo=get_option($feedName);

    if(!$feedInfo){
        $getFeedConfig=unserialize(get_option($feedName));
        $feedInfo=$getFeedConfig['feedrules'];
    }

    $feedInfo['Limit']=$limit;
    $feedInfo['Offset']=$offset;
    $feed_data=woo_feed_generate_feed_data($feedInfo);
    if($feed_data){
        $data=array(
            "success"=>true,
            "products"=>"yes",
        );
        wp_send_json_success($data);
    }else{
        $data=array(
            "success"=>true,
            "products"=>"no",
        );
        wp_send_json_success($data);
    }
    wp_die();
}

add_action('wp_ajax_save_feed_file', 'woo_feed_save_feed_file');
add_action('wp_ajax_nopriv_save_feed_file', 'woo_feed_save_feed_file');
function woo_feed_save_feed_file(){

    check_ajax_referer('wpf_feed_nonce');
    $feed=str_replace("wf_feed_", "",$_POST['feed']);
    $info=get_option($feed);
    if(!$info){
        $getInfo=unserialize(get_option($_POST['feed']));
        $info=$getInfo['feedrules'];
    }
    $feedService = $info['provider'];
    $fileName = str_replace(" ", "",$info['filename']);
    $type = $info['feedType'];

    //$feedHeader=get_option("wf_store_feed_header_info_".$fileName);
    $feedHeader=woo_feed_get_batch_feed_info($feedService,$type,"wf_store_feed_header_info_".$fileName);
    //$feedBody=get_option("wf_store_feed_body_info_".$fileName);
    $feedBody=woo_feed_get_batch_feed_info($feedService,$type,"wf_store_feed_body_info_".$fileName);
    //$feedFooter=get_option("wf_store_feed_footer_info_".$fileName);
    $feedFooter=woo_feed_get_batch_feed_info($feedService,$type,"wf_store_feed_footer_info_".$fileName);

    // echo "<pre>"; print_r($feedHeader); print_r($feedBody);
    if($type=='csv'){
        $csvHead[0]=$feedHeader;
        $string=array_merge($csvHead,$feedBody);
    }else{
        $string=$feedHeader.$feedBody.$feedFooter;
    }
//    print_r($string);
//    $data=array($string);
//    wp_send_json_error($data);
//    wp_die();

    $upload_dir = wp_upload_dir();
    $base = $upload_dir['basedir'];
    $path = $base . "/woo-feed/" . $feedService . "/" . $type;
    $saveFile = false;
    # Check If any products founds
    if ($string) {
        # Save File

        $file = $path . "/" . $fileName . "." . $type;
        $save = new Woo_Feed_Savefile();
        if ($type == "csv") {
            $saveFile = $save->saveCSVFile($path, $file, $string, $info);
        } else {
            $saveFile = $save->saveFile($path, $file, $string);
        }
    }else{
        $data=array("success"=>false,"message"=>"No Product Found with your feed configuration. Please Update & Generate the feed again.");
        wp_send_json_error($data);
        wp_die();
    }


    # Save Info into database
    $url = $upload_dir['baseurl'] . "/woo-feed/" . $feedService . "/" . $type . "/" . $fileName . "." . $type;
    $feedInfo = array(
        'feedrules' => $info,
        'url' => $url,
        'last_updated' => date("Y-m-d H:i:s"),
    );

    if (!empty($name) && $name != "wf_feed_" . $fileName) {
        delete_option($name);
    }

    //delete_option("wf_config".$fileName);
    delete_option("wf_store_feed_header_info_".$fileName);
    delete_option("wf_store_feed_body_info_".$fileName);
    delete_option("wf_store_feed_footer_info_".$fileName);
    if ($type == "csv") {
        $type="json";
    }
    unlink($path . "/" . "wf_store_feed_header_info_".$fileName . "." . $type);
    unlink($path . "/" . "wf_store_feed_body_info_".$fileName . "." . $type);
    unlink($path . "/" . "wf_store_feed_footer_info_".$fileName . "." . $type);

    $update = update_option('wf_feed_' . $fileName, serialize($feedInfo));
    if ($saveFile) {
        $getInfo = unserialize(get_option('wf_feed_' . $fileName));
        $url = $getInfo['url'];
        $data=array(
            "info"=>$feedInfo,
            "url"=>$url,
            "message"=>"Feed Making Complete",
        );
        wp_send_json_success($data);
    } else {
        $data=array("success"=>false,"message"=>"Failed to save feed file. Please confirm that your WordPress directory have Read and Write permission.");
        wp_send_json_error($data);
    }

    wp_die();
}



/**
 * Generate Feed
 */

function woo_feed_generate_feed()
{
    if (isset($_POST['provider'])) {
//        ini_set('display_errors', 1);
//        ini_set('display_startup_errors', 1);
//        error_reporting(E_ALL);
//        $process = woo_feed_add_update($_POST);
//
//        if ($process) {
//            $message = "<b>Feed Making Complete. Feed URL: <a style='font-weight: bold;color:green;' target='_blank' href=$process>$process</a></b>";
//            update_option('wpf_message', $message);
//            wp_redirect(admin_url("admin.php?page=woo_feed_manage_feed&wpf_message=success"));
//        } else {
//            update_option('wpf_message', 'Failed To Make Feed');
//            wp_redirect(admin_url("admin.php?page=woo_feed_manage_feed&wpf_message=error"));
//        }

        $fileName = "wf_config".str_replace(" ", "", sanitize_text_field($_POST['filename']));
        update_option($fileName,$_POST);
        require plugin_dir_path(__FILE__) . 'admin/partials/woo-feed-manage-list.php';
    } else {
        echo "<div class='notice notice-warning is-dismissible'><p>" . __("You are awesome for using <b>WooCommerce Product Feed</b>. Free version works great for up to <b>2000 products including variations.</b>", 'woo-feed') . "</p></div>";
        require plugin_dir_path(__FILE__) . 'admin/partials/woo-feed-admin-display.php';
    }
}


/**
 * Manage Feeds
 */
function woo_feed_manage_feed()
{
    // Manage action for category mapping
    if (isset($_GET['action']) && $_GET['action'] == 'edit-feed') {
        $fname = sanitize_text_field($_GET['feed']);
        if (count($_POST) && isset($_POST['provider']) && isset($_POST['edit-feed'])) {
//            // if (woo_feed_add_update($_POST, $_GET['feed'])) {
//            $process = woo_feed_add_update($_POST, $fname);
//            if ($process) {
//                $message = "<b>Feed Updated Successfully. Feed URL: <a style='font-weight: bold;color:green;' target='_blank' href=$process>$process</a></b>";
//                update_option('wpf_message', $message);
//                wp_redirect(admin_url("admin.php?page=woo_feed_manage_feed&wpf_message=success"));
//            } else {
//                update_option('wpf_message', 'Failed To Update Feed');
//                wp_redirect(admin_url("admin.php?page=woo_feed_manage_feed&wpf_message=error"));
//            }

            $fileName = "wf_config".str_replace(" ", "", sanitize_text_field($_POST['filename']));
            update_option($fileName,$_POST);
            require plugin_dir_path(__FILE__) . 'admin/partials/woo-feed-manage-list.php';
            wp_die();
        }

        if (isset($fname)) {
            $feedInfo = unserialize(get_option($fname));
            $provider = strtolower($feedInfo['feedrules']['provider']);
            $feedRules = $feedInfo['feedrules'];
            if ($provider == "custom" || $provider == "amazon" || $provider == "adwords") {
                require plugin_dir_path(__FILE__) . "admin/partials/custom/edit-feed.php";
            } else {
                require plugin_dir_path(__FILE__) . "admin/partials/woo-feed-edit-template.php";
            }
        }
    } else {
        # Update Interval
        if (isset($_POST['wf_schedule'])) {
            if (update_option('wf_schedule', sanitize_text_field($_POST['wf_schedule']))) {
                wp_clear_scheduled_hook('woo_feed_update');
                add_filter('cron_schedules', 'custom_cron_job_custom_recurrence');
                wp_schedule_event(time(), 'woo_feed_corn', 'woo_feed_update');
            }
        }
        
        require plugin_dir_path(__FILE__) . 'admin/partials/woo-feed-manage-list.php';
    }
}

/**
 * Difference between free and premium plugin
 */
function woo_feed_pro_vs_free(){
    require plugin_dir_path(__FILE__) . 'admin/partials/woo-feed-pro-vs-free.php';
}

/**
 * Difference between free and premium plugin
 */
function woo_feed_feed_optimization(){
    require plugin_dir_path(__FILE__) . 'admin/partials/woo-feed-pro-vs-free.php';
}


/*
 * Scheduled Action Hook
 */
add_action('wp_ajax_getFeedInfoForCronUpdate', 'woo_feed_getFeedInfoForCronUpdate');
add_action('wp_ajax_nopriv_getFeedInfoForCronUpdate', 'woo_feed_getFeedInfoForCronUpdate');
function woo_feed_getFeedInfoForCronUpdate(){

    check_ajax_referer('wpf_feed_nonce');
    global $wpdb;
    $var = "wf_feed_";
    $query = $wpdb->prepare("SELECT * FROM $wpdb->options WHERE option_name LIKE %s;", $var . "%");
    $result = $wpdb->get_results($query, 'ARRAY_A');
    $feeds=array();
    foreach ($result as $key => $value) {
        $feedInfo = unserialize(get_option($value['option_name']));
        $feeds["wf_config".$value['option_name']]=$feedInfo['last_updated'];
    }

    $return = array(
        'data'	=> $feeds,
    );

    wp_send_json($return);
}


/*
 * Scheduled Action Hook
 */
function woo_feed_cron_update_feed()
{
    global $wpdb;
    $var = "wf_feed_";
    $query = $wpdb->prepare("SELECT * FROM $wpdb->options WHERE option_name LIKE %s;", $var . "%");
    $result = $wpdb->get_results($query, 'ARRAY_A');
    foreach ($result as $key => $value) {
        $feedInfo = unserialize(get_option($value['option_name']));
        woo_feed_add_update($feedInfo['feedrules']);
    }
}
