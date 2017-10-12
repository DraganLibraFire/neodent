<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

$object = get_queried_object();
$taxonomy = $object->taxonomy;
$slug = $object->slug;
$term_id = $object->term_id;
$terms_lf = get_terms(array( 'taxonomy' => $taxonomy,  'parent' => $term_id, 'depth' => 1, 'show_empty' => 'false'));
$has_subcategories = count( $terms_lf ) > 0 ? true : false;
if( is_null( $taxonomy ) )
	$has_subcategories = false;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

//get_header( 'shop' ); ?>
<?php

/**
	* woocommerce_before_main_content hook
	*
	* @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
	* @hooked woocommerce_breadcrumb - 20
*/

do_action( 'woocommerce_sidebar' );
?>

	<div class="col-md-9">
		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

			<h1 class="page-title get_this_title pull-left"><?php woocommerce_page_title(); ?></h1>

		<?php endif; ?>

		<?php if( !$has_subcategories ) do_action( 'woocommerce_archive_description' ); ?>

		<?php if ( have_posts() ) : ?>

			<?php if( !$has_subcategories ) do_action( 'woocommerce_before_shop_loop' ); ?>

			<?php woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories(); ?>

			<?php


			if( $has_subcategories == true ){
				global $term_lfs;
				foreach( $terms_lf as $key => $term_lf ){
					$term_lfs = $term_lf;
					wc_get_template_part( 'content', 'subcat' );
				}

			} else{
			?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php  wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php

				woocommerce_product_loop_end();

			}
			?>

			<?php if( !$has_subcategories ) do_action( 'woocommerce_after_shop_loop' ); ?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php wc_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */

		do_action( 'woocommerce_after_main_content' );
	?>
</div>

<?php get_footer( 'shop' ); ?>
