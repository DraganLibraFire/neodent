<?php
/*
Template Name: Homepage template
*/
?>
<?php
get_header('header1');
global $neodent_theme_settings;
?>
<div id="content" class="content-area">
	<div class="slider-wrapper">
		<?php putRevSlider("home") ?>
	</div> <!-- /.slider-wrapper -->
	<main id="main-homepage" class="site-main" role="main">
		<div class="container">
			<div class="row">
				<div class="wp-posts-wrapp">
					<div class="col-md-6">
						<?php $term_stomatologija = get_term_by( 'slug', 'stomatologija', 'product_cat' );

						$thumb_id = get_woocommerce_term_meta( $term_stomatologija->term_id, 'thumbnail_id', true );
						$term_img = wp_get_attachment_url(  $thumb_id );

						
						?>
						<h2 class="title-post-border-right">
							<span><?php echo $term_stomatologija->name; ?></span>
						</h2>
						<div class="post-thumbnail-warpp col-sm-4">
							<img src="<?php echo $term_img; ?>" alt="">
						</div> <!-- /.post-thumbnail-warpp col-md-4 -->
						<div class="excerpt-post-wrapp col-sm-8">
							<p>
								<?php echo $term_stomatologija->description; ?>
							</p>
							<a class="post-button-green" href="<?php echo get_term_link( $term_stomatologija->term_id ); ?>">Pogledaj ponudu</a>
						</div>
					</div> <!-- /.col-md-6 -->
					<div class="col-md-6">
						<?php $term_stomatologija = get_term_by( 'slug', 'zubna-tehnika', 'product_cat' );

						$thumb_id = get_woocommerce_term_meta( $term_stomatologija->term_id, 'thumbnail_id', true );
						$term_img = wp_get_attachment_url(  $thumb_id );


						?>
						<h2 class="title-post-border-right">
							<span><?php echo $term_stomatologija->name; ?></span>
						</h2>
						<div class="post-thumbnail-warpp col-sm-4">
							<img src="<?php echo $term_img; ?>" alt="">
						</div> <!-- /.post-thumbnail-warpp col-md-4 -->
						<div class="excerpt-post-wrapp col-sm-8">
							<p>
								<?php echo $term_stomatologija->description; ?>
							</p>
							<a class="post-button-green" href="<?php echo get_term_link( $term_stomatologija->term_id ); ?>">Pogledaj ponudu</a>
						</div>
					</div> <!-- /.col-md-6 -->

				</div> <!-- /. wp-posts-wrapp col-md-12 -->
			</div>

			<div class="row">
				<div class="woocommerce-products-tab-wrapp col-md-12">
					<div id="tabs">
				        <ul>
				            <li><h3><a href="#one">NOVI PROIZVODI</a></h3></li>
				            <li><h3><a href="#two">PROIZVODI NA AKCIJI</a></h3></li>
				            <li><h3><a href="#three">IZDVAJAMO</a></h3></li>
				        </ul>
						<div id="one" class="woocommerce-tab">
							<div class="row">
								<div class="row-fluid list-of-woocommerce-products">
									<?php
										$args = array(
											'post_type' => 'product',
											'stock' => 1,
											'posts_per_page' => 16,
											'orderby' =>'date',
											// 'category_name' => 'novi',
											'product_cat' => 'novi',
											'order' => 'DESC'
										);
										$loop = new WP_Query( $args );
										while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
										<div class="woocommerce-list-products-latest col-md-4">
											<a id="id-<?php the_id(); ?>" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
												<?php if(has_post_thumbnail( $loop->post->ID )) {?>
												<div class="thumb-wrapp">
												<?php the_post_thumbnail(); //echo get_the_post_thumbnail(); ?>
												</div> <!-- /.thumb-wrapp -->
												<?php } else {?>
												<?php echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" width="300px" height="300px" />'; ?>
												<?php }?>
												<h3><?php the_title(); ?></h3>
												<hr/>
												<?php the_excerpt(); ?>
												<div class="price"><?php echo $product->get_price_html(); ?></div>
											</a>
											<a class="woo-botton" href="<?php the_permalink(); ?>">Detaljnije</a>
											<?php //woocommerce_template_loop_add_to_cart( $loop->post, $product ); ?>
										</div><!-- /.woocommerce-list-products-latest col-md-4 -->
									<?php endwhile; ?>
									<?php wp_reset_query(); ?>
								</div><!-- /.row-fluid list-of-woocommerce-products -->
							</div>
						</div>
						<div id="two" class="woocommerce-tab">
							<?php echo do_shortcode('[sale_products per_page="16" columns="3"]'); ?>
						</div>
				        <div id="three" class="woocommerce-tab">
							<?php echo do_shortcode('[featured_products per_page="16" columns="3"]'); ?>
				        </div>
			        </div> <!-- /#tabs -->
				</div> <!-- /.woocommerce-products-tab-wrapp col-md-12 -->
			</div>

			<div class="row">
				<div class="col-md-12">
					<?php $dentist_tehnic = new WP_Query(array(
						'post_type' => 'offer_page',
						'posts_per_page' => 1,
						));
					?>
					<?php if ( $dentist_tehnic->have_posts() ) : ?>
					<?php while ( $dentist_tehnic->have_posts() ) : $dentist_tehnic->the_post(); ?>
						<h2 class="main-title-special-offer title-post-border-right"><span>SPECIJALNA PONUDA</span></h2>
						<div class="special-offer-post-image-content-wrapp">
							<div class="img-offer-wrapp"><?php the_post_thumbnail('neodent-square-large'); ?></div>
							<div class="special-offer-post-wrapp col-md-6">
								<h2 class="post-title-special-offer">
									<?php the_title(); ?>
								</h2> <!-- /.post-title-special-offer col-md-12 -->
								<div class="excerpt-post-wrapp excerpt-post-wrapp-special-offer">
									<?php the_excerpt(); ?>
									<a class="special-offer-post-button-green post-button-green" href="<?php the_permalink(); ?>">Pogledaj ponudu</a>
								</div>
							</div> <!-- /.special-offer-post-wrapp col-md-6 -->
						</div> <!-- /.special-offer-post-image-content-wrapp  col-md-12-->
						<?php //get_template_part( 'article-templates/content', 'page');?>
					<?php endwhile; ?>
					<?php endif; ?>
				</div> <!-- /.col-md-12 -->
			</div>
		</div> <!-- /.container -->

		<div class="container">
			<div class="t3-content text-center col-xs-12 testimonial-section">
				<h2 class="text-blue">Utisci klijenata</h2>

				<?php

				$args = array(
					'posts_per_page'	=> 30,
					'post_type'			=> 'testimonials_page'
				);

				$testimonials_query = new WP_Query( $args ); ?>

				<?php if ( $testimonials_query->have_posts() ) : ?>

					<ul class="clients-content testimonial-slider">
					<?php while( $testimonials_query->have_posts() ) : $testimonials_query->the_post(); ?>

							<li class="testimonial">
								<div class="clients-item">
									<div class="clients-photo">
										<div class="client-image"><?php the_post_thumbnail('neodent-testimonial-avatar')?></div>
									</div>
									<div class="clients-name"><?php the_title(); ?></div>
									<div class="clients-testimonial">
										<?php the_content(); ?>
									</div>
								</div>
							</li>

					<?php endwhile; ?>
					</ul>

				<?php endif; ?>


			</div>
		</div>




		<div class="wp-editor-content-wrapp-home-page">
			<div class="container">
				<div class="row">
					<div class="wp-editor-content-wrapp col-md-12">
						<div class="text-center">
							<?php if ( have_posts() ) : ?>
							<?php while ( have_posts() ) : the_post(); ?>
								<?php //get_template_part( 'article-templates/content', 'page');?>
								<?php the_content(); ?>
							<?php endwhile; ?>
							<?php endif; ?>
						</div>
					</div> <!-- /.wp-editor-content-wrapp wp-editor-content-wrapp-home-page col-md-12 -->
				</div>
			</div>
		</div> <!-- /.wp-editor-content-wrapp-home-page -->
		<div class="wp-editor-content-wrapp-home-page newsletter-section" style="background-image: url(<?php the_field('pozadinska_slika', 'option');?>)">
			<div class="container">
				<div class="row">
					<div class="wp-editor-content-wrapp col-md-12">
						<div class="text-center overflow-hidden">
							<?php the_field('sadrzaj_sekcije', 'option');?>
						</div>
					</div> <!-- /.wp-editor-content-wrapp wp-editor-content-wrapp-home-page col-md-12 -->
				</div>
			</div>
		</div> <!-- /.wp-editor-content-wrapp-home-page -->
		<?php //get_template_part('inc', 'latest-news'); ?>
		 <!-- /.container -->
	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php
get_footer();
?>