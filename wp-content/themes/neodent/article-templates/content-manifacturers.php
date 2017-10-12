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
							<?php $ID = get_the_ID(); ?>
							<?php
								$args = array(
									'post_type' => 'product',
									'stock' => 1,
									'posts_per_page' => -1,
									'orderby' =>'menu_order',
									'meta_key' => 'odaberite_proizvodjaca',
									'meta_value' => $ID,
									'order' => 'DESC'
								);
							$loop = new WP_Query( $args );
							while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
							<!-- <div class="woocommerce-list-products-latest col-md-4"> -->
							<li class="product type-product">
								<a id="id-<?php the_id(); ?>" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
									<?php if(has_post_thumbnail( $loop->post->ID )) {?>
									<div class="thumb-wrapp">
									<?php the_post_thumbnail(); //echo get_the_post_thumbnail(); ?>
									</div> <!-- /.thumb-wrapp -->
									<?php } else {?>
									<?php echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" width="300px" height="300px" />'; ?>
									<?php }?>
									<h3><?php the_title(); ?></h3>
									<!-- <hr/> -->
									<?php //the_excerpt(); ?>
									<div class="price"><?php echo $product->get_price_html(); ?></div>
								</a>
								<a class="woo-botton" href="<?php the_permalink(); ?>">Detaljnije</a>
							</li>
							<?php //woocommerce_template_loop_add_to_cart( $loop->post, $product ); ?>
							<!-- </div> --><!-- /.woocommerce-list-products-latest col-md-4 -->
						<?php endwhile; ?>
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