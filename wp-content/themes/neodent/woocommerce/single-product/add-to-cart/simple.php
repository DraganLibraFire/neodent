<?php
/**
 * Simple product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( ! $product->is_purchasable() ) {
	return;
}

?>

<?php
	// Availability
	$availability      = $product->get_availability();
	$availability_html = empty( $availability['availability'] ) ? '' : '<p class="stock ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</p>';

	echo apply_filters( 'woocommerce_stock_html', $availability_html, $availability['availability'], $product );
?>

<?php if ( $product->is_in_stock() ) : ?>

	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	<form class="fullwidth cart" method="post" enctype='multipart/form-data'>
	 	<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

	 	<?php
	 		if ( ! $product->is_sold_individually() )
	 			woocommerce_quantity_input( array(
	 				'min_value' => apply_filters( 'woocommerce_quantity_input_min', 1, $product ),
	 				'max_value' => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product )
	 			) );
	 	?>

	 	<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->id ); ?>" />

	 	<button type="submit" class="single_add_to_cart_button button alt"><?php echo $product->single_add_to_cart_text(); ?></button>

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
		<div class="single-details-wrapper">
			<div class="single_variation_wrap pull-right">
				<div class="quantity-text">
					<p>Isporuka</p>
				</div>
				<div class="woocommerce-variation-add-to-cart">
					<button type="button" class="expand-info-btn button alt"><i class="fa fa-archive" aria-hidden="true"></i></button>
					<div class="dropdown-info-menu item-1">
						<p>Sve porudžbine napravljene pre 13h biće dostavljene sledeći radni dan! <a href="<?php echo site_url() . '/uputstvo-i-pomoc'; ?>">Detaljnije</a></p>
					</div>
				</div>
			</div>
			<div class="single_variation_wrap pull-right">
				<div class="quantity-text">
					<p>Poštarina</p>
				</div>
				<div class="woocommerce-variation-add-to-cart">
					<button type="button" class="expand-info-btn button alt"><i class="fa fa-truck" aria-hidden="true"></i></button>
					<div class="dropdown-info-menu item-2">
						<p>Za porudžbine preko 3000 dinara poštarina je gratis! <a href="<?php echo site_url() . '/uputstvo-i-pomoc'; ?>">Detaljnije</a></p>
					</div>
				</div>
			</div>
		</div>
	</form>

	<div class="border-bottom-news"></div>
	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>
