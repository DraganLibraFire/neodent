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
 * @name Header template file
 * Used for the site header. Here goes the HTML head elements, stylesheets and stuff
 * @group templates
 * @category main
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7 no-js" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8 no-js" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?> class="no-js">
<!--<![endif]-->
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
            n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
            document,'script','https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '281277118935440'); // Insert your pixel ID here.
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id=281277118935440&ev=PageView&noscript=1"
        /></noscript>
    <!-- DO NOT MODIFY -->
    <!-- End Facebook Pixel Code -->
    <?php
        global $product, $custom_product_price;

        $wc_prd = new WC_Product($product->id);
        $custom_product_price = $wc_prd->get_price();

    ?>

</head>
<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
    <header>
        <div class="woocoomerce-top-heder-menu">
            <div class="container">
                <div class="row">
                    <div class=" col-md-12">
                        <?php wp_nav_menu(array('theme_location' => 'woocommerce-menu')); ?>
                    </div>
                </div>
            </div> <!-- /.top-header-menu container -->
        </div> <!-- /.woocoomerce-top-heder-menu -->
        <div class="container">
            <?php global $neodent_theme_settings; ?>
            <div class="logo-wrapp-header col-md-4">
                <!-- <a class="logo-responsive-menu" href="index.php"><img src="<?php //echo get_bloginfo("template_url"); ?>" alt="Logo" title="logo" /></a> -->
                <a alt="Stomatološka oprema - Neodent" title="Stomatološka oprema - Neodent"
                   href="<?php echo esc_url(home_url('/')); ?>">
                    <img src="<?php echo $neodent_theme_settings['opt-media']['url']; ?>"
                         width="<?php echo $neodent_theme_settings['opt-media']['width']; ?>"
                         height="<?php $neodent_theme_settings['opt-media']['height']; ?>">
                </a>
            </div> <!-- /.logo-wrapp-header col-md-4 -->
            <div class="header-search-contact-info-wrapp col-md-8">
                <div class="search-header-wrapper">
                    <form class="form-header" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search" name="s" id="sHelp">
                            <button type="submit" class="btn btn-default">Submit</button>
                        </div>
                    </form>
                </div> <!-- /.search-header-wrapper -->
                <div class="header-contact-info">
                    <img class="phone-icon-header"
                         src="<?php echo $neodent_theme_settings['opt-media-phone-icon']['url']; ?>" alt="Phone icon"
                         title="Phone icon">

                    <div class="contact-headre-numbers-wrapp">
                        <a class="phone-numbers-links"
                           href="tel:<?php echo $neodent_theme_settings['opt-text']; ?>"><?php echo $neodent_theme_settings['opt-text']; ?></a><br/>
                        <a class="phone-numbers-links"
                           href="tel:<?php echo $neodent_theme_settings['opt-text-2']; ?>"><?php echo $neodent_theme_settings['opt-text-2']; ?></a>

                    </div> <!-- /.contact-headre-numbers-wrapp -->
                </div> <!-- /. header-contact-info -->
            </div> <!-- /. header-search-contact-info-wrapp col-md-8 -->
            <nav class="navbar navbar-default" role="navigation">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target="#neodent-main-navbar-collapse">
                            <span class="screen-reader-text"><?php _e('Navigacija', 'neodent'); ?></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <!-- <a class="navbar-brand" href="<?php echo home_url(); ?>">
								<?php //bloginfo( 'name' ); ?>
							</a> -->
                    </div> <!-- /.navbar-header -->

                    <?php
                    wp_nav_menu(array(
                            'menu' => 'primary',
                            'theme_location' => 'primary',
                            'depth' => 2,
                            'container' => 'div',
                            'container_class' => 'collapse navbar-collapse',
                            'container_id' => 'neodent-main-navbar-collapse',
                            'menu_class' => 'nav navbar-nav',
                            'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
                            'walker' => new wp_bootstrap_navwalker())
                    );
                    ?>
                </div> <!-- /.container-fluid -->
            </nav> <!-- /.navbar navbar-default -->
        </div> <!-- /. container -->

    </header>

    <div id="main" class="site-main">
        <div id="content" class="site-content">
            <div class="container">
                <?php
                    if( !is_front_page() ){
                        if (function_exists('yoast_breadcrumb')) {
                            yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
                        }
                    }
                ?>
            </div>