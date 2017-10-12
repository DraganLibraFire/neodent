<?php
/*
Template Name: Latest products template
*/
?>
<?php
get_header('header1');
?>
<div id="content" class="content-area">
	<main id="main" class="site-main container" role="main">
		<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-9'); ?>>
			<div class="row">
				<div class="row-fluid list-of-woocommerce-products">
					<div class="woocommerce-list-products-latest woocommerce">
						<ul class="products">

					<?php
						$args = array(
							'post_type' => 'product',
							'stock' => 1,
							'posts_per_page' => 12,
							'orderby' =>'date',
							// 'category_name' => 'novi',
							'product_cat' => 'novi',
							'order' => 'DESC'
						);
						$loop = new WP_Query( $args );
						while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
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
					<?php endwhile; ?>
					<?php wp_reset_query(); ?>
						</ul>
					</div><!-- /.woocommerce-list-products-latest -->
				</div><!-- /.row-fluid list-of-woocommerce-products -->
			</div>
		</article>
		<?php get_sidebar();?>
	</main><!-- .site-main -->
</div><!-- .content-area -->
<?php
get_footer();
?>