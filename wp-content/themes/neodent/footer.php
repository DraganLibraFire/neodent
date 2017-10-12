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
 * @name Footer template file
 * Used for displaying the footer of the website
 * @group templates
 * @category main
 */
?>
</div><!-- #content -->
</div><!-- #main -->

<!-- <div class="row"> -->
<footer class="site-footer">
    <div id="top-footer" class="footer-top" role="contentinfo">
        <div class="footer-widgets container">
            <div class="row">
                <div class="widget-area col-md-3" role="complementary">
                    <?php dynamic_sidebar('footer-first'); ?>
                </div>
                <div class="widget-area col-md-3" role="complementary">
                    <?php dynamic_sidebar('footer-second'); ?>
                </div>
                <div class="widget-area col-md-3" role="complementary">
                    <?php dynamic_sidebar('footer-third'); ?>
                </div>
                <div class="widget-area col-md-3" role="complementary">
                    <?php dynamic_sidebar('footer-fourth'); ?>
                </div>
            </div>
        </div> <!-- /.footer-widgets container -->
    </div><!-- /#top-footer /.footer-top -->
    <!-- </div> -->

    <!-- <div class="row"> -->
    <div id="bottom-footer" class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="site-info col-md-6">
                    <a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>
                    <span>&copy; <?php echo date('Y'); ?></span> <a href="https://www.librafire.com/" target="_blank">LibraFire</a>
                </div><!-- /.site-info col-md-6-->
                <div class="widget-area-bottom col-md-6" role="complementary">
                    <?php dynamic_sidebar('footer-bottom-first'); ?>
                </div> <!-- /#footer-widget-bootom /.widget-area-bottom col-md-6 -->
                <div class="widget-area-bottom col-md-6" role="complementary">
                    <?php dynamic_sidebar('footer-bottom-second'); ?>
                </div> <!-- /#footer-widget-bootom /.widget-area-bottom col-md-6 -->
                <div class="widget-area-bottom col-md-6" role="complementary">
                    <?php dynamic_sidebar('footer-bottom-third'); ?>
                </div> <!-- /#footer-widget-bootom /.widget-area-bottom col-md-6 -->
            </div>
        </div> <!-- /container -->
        <button class="to-top">&Hat;</button>
    </div> <!-- /#bottom-footer /.footer-bottom -->
</footer> <!-- /. site-footer -->
<!-- </div> -->
</div><!-- #page -->
<?php wp_footer(); ?>


<script type="text/javascript">
    window.smartlook||(function(d) {
        var o=smartlook=function(){ o.api.push(arguments)},h=d.getElementsByTagName('head')[0];
        var c=d.createElement('script');o.api=new Array();c.async=true;c.type='text/javascript';
        c.charset='utf-8';c.src='//rec.getsmartlook.com/recorder.js';h.appendChild(c);
    })(document);
    smartlook('init', '9fd23a8e60f3eeafa837a0ef4d0f23345a4f87fa');
</script>


<!-- Add event to the button's click handler -->
<script type="text/javascript">
    jQuery(function($){

        <?php

        global $custom_product_price;

        if( $custom_product_price != '' ){

        ?>

            var variation_price = <?php echo $custom_product_price; ?>;

            $( ".variations_form" ).on( "show_variation", function (e, a) {
                variation_price = a.display_regular_price;
            } );

            $(document).on('click', '.single_add_to_cart_button', function(e){

                var _this = e.srcElement || e.target;

                if( !$(_this).hasClass("disabled") ){

                    var ids = [], val_id = jQuery("[name='add-to-cart']").val();

                    ids.push( val_id );

                    fbq('track', 'AddToCart', {
                        content_ids: val_id,
                        content_type: 'product',
                        value: variation_price,
                        currency: 'RSD'
                    });

                } else{
                    console.log('Disabled...');
                }

            });

        <?php

         }
         ?>

    });
</script>


<script>
</script>
</body>
</html>
