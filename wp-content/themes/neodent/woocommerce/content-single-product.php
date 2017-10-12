<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     1.6.4
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

?>

<?php
/**
 * woocommerce_before_single_product hook
 *
 * @hooked wc_print_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
    echo get_the_password_form();
    return;
}
?>

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>"
     id="product-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>

    <?php
    /**
     * woocommerce_before_single_product_summary hook
     *
     * @hooked woocommerce_show_product_sale_flash - 10
     * @hooked woocommerce_show_product_images - 20
     */
    do_action('woocommerce_before_single_product_summary');
    ?>

    <div class="summary entry-summary">

        <?php
        /**
         * woocommerce_single_product_summary hook
         *
         * @hooked woocommerce_template_single_title - 5
         * @hooked woocommerce_template_single_rating - 10
         * @hooked woocommerce_template_single_price - 10
         * @hooked woocommerce_template_single_excerpt - 20
         * @hooked woocommerce_template_single_add_to_cart - 30
         * @hooked woocommerce_template_single_meta - 40
         * @hooked woocommerce_template_single_sharing - 50
         */

        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);
        add_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 60);
        add_action('woocommerce_single_product_summary', 'woocommerce_template_description', 50);

        do_action('woocommerce_single_product_summary');
        ?>

    </div><!-- .summary -->

    <?php

    /**
     * woocommerce_after_single_product_summary hook
     *
     * @hooked woocommerce_output_product_data_tabs - 10
     * @hooked woocommerce_upsell_display - 15
     * @hooked woocommerce_output_related_products - 20
     */
    remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
    do_action('woocommerce_after_single_product_summary');
    ?>

    <meta itemprop="url" content="<?php the_permalink(); ?>"/>

</div><!-- #product-<?php the_ID(); ?> -->
<span class="hidden povezani-proizvodi full-width">Povezani proizvodi:</span>
<div class="products-related clearfix">
    <ul>
    <?php
    global $post;
    $terms = get_the_terms($post->ID, 'product_cat');
    $skus_arr = array();

    foreach ($terms as $term) {
        if( $term->term_id != 69 && $term->term_id != 70 && $term->term_id != 41 ) {
            array_push($skus_arr, $term->slug);
        }
    }

    $shortcode_skus = implode(',', $skus_arr);

    $args_related = array(
        'posts_per_page' => 10,
        'product_cat' => $shortcode_skus,
        'post_type' => 'product'
    );

    $related_query = new WP_Query($args_related);

    if ($related_query->have_posts()) :

        while ($related_query->have_posts()) :
            $related_query->the_post();
            global $product;
            ?>
            <li class="woocommerce-list-products-latest col-md-4">
                <a id="id-<?php the_id(); ?>" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                    <?php if (has_post_thumbnail(get_the_ID())) { ?>
                        <div class="thumb-wrapp">
                            <?php the_post_thumbnail(); //echo get_the_post_thumbnail(); ?>
                        </div> <!-- /.thumb-wrapp -->
                    <?php } else { ?>
                        <?php echo '<img src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" width="300px" height="300px" />'; ?>
                    <?php } ?>
                    <h3><?php the_title(); ?></h3>
                    <hr/>
                    <p><?php limit_text_lf( 'excerpt', 90, true ); ?></p>
                    <div class="price"><?php echo $product->get_price_html(); ?></div>
                </a>
                <a class="woo-botton" href="<?php the_permalink(); ?>">Detaljnije</a>
                <?php //woocommerce_template_loop_add_to_cart( $loop->post, $product );
                ?>
            </li><!-- /.woocommerce-list-products-latest col-md-4 -->
            <?php

        endwhile;

    endif;

    ?>
    </ul>
</div>
<?php do_action('woocommerce_after_single_product'); ?>


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

        var val_id = jQuery("[name='add-to-cart']").val();
        fbq('track', 'ViewContent', {
            content_ids: val_id,
            content_type: 'product',
            value: variation_price,
            currency: 'RSD'
        });

        <?php

         }
         ?>

    });
</script>
