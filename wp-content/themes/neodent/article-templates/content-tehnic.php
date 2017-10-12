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
 * @name Template for Post format - Aside
 * Used for design of the specific post-format
 * @group templates
 * @category articles
 */
?>
<!-- <div class="row"> -->
<article id="post-<?php the_ID(); ?>" <?php post_class('page col-md-9'); ?>>
	<?php
	// Post thumbnail.
	//neodent_post_thumbnail();
	?>
	<header class="entry-header">
		<?php
			the_title( '<h1 class="entry-title"><span>', '</span></h1>' );
		?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<div class="row">
				<div class="row-fluid list-of-woocommerce-products">
					<div class="woocommerce-list-products-latest woocommerce">
						<ul class="products">
							<?php
							$subcat_args =  array(
													'type'     => 'product',
													'parent' => 70,
													'taxonomy' => 'product_cat',
													);
							$categories = get_categories( $subcat_args );
							foreach ($categories as  $category) {
							?>
							<!-- <div class="woocommerce-list-products-latest col-md-4"> -->
							<li class="product type-product">
								<a id="<?php echo $category->slug; ?>" href="<?php  echo get_term_link( $category ); ?>" >
									<?php 
	    							$category_thumbnail = get_woocommerce_term_meta($category->term_id, 'thumbnail_id', true);
  									$image = wp_get_attachment_url($category_thumbnail);
  									if(!$image){
  										$image=content_url().'/plugins/woocommerce/assets/images/placeholder.png';
  									}
									?>
									<img src="<?php echo $image ; ?>">
									<h3><?php echo $category->name; ?></h3>
									<!-- <hr/> -->
									<?php //the_excerpt(); ?>
								</a>
								<a class="woo-botton" href="<?php echo get_term_link($category); ?>">Detaljnije</a>
							</li>
							<?php //woocommerce_template_loop_add_to_cart( $loop->post, $product ); ?>
							<!-- </div> --><!-- /.woocommerce-list-products-latest col-md-4 -->
						<?php } ?>
						<?php wp_reset_query(); ?>
						</ul>
					</div><!-- /.woocommerce-list-products-latest -->
				</div><!-- /.row-fluid list-of-woocommerce-products -->
			</div>
	</div><!-- .entry-content -->
	

    <footer class="entry-footer">
		<?php //neodent_entry_meta(); ?>
		<?php edit_post_link( __( 'Izmeni', 'neodent' ), '<span class="edit-link">', '</span>' ); ?>
	</footer> <!-- .entry-footer -->

	<?php
	// Author bio.
	if ( is_single() && get_the_author_meta( 'description' ) ) :
		get_template_part( 'article-templates/author-bio' );
	endif;
	?>
</article>
<?php get_sidebar();?>
<!-- </div> -->