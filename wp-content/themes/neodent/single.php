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
 * @name Single post template file
 * Used for displaying the single post
 * @group templates
 * @category main
 */
get_header('header1');
?>
<div id="content" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="top-main-big-image-wrap">
			<?php if( get_field('ovde_dodajte_sliku_veliku') ): ?>
				<img src="<?php the_field('ovde_dodajte_sliku_veliku'); ?>" alt="Neodent citat slika">
			<?php endif; ?>
		</div>
		<div class="container">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			/*
			 * Include the Post-Format-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
			 */
			?>

				<div class="title-date-share-icons-single-page-wrap clearfix">
					<div class="title-date-single-page-wrap pull-left">
						<h1 class="main-single-title"><?php the_title(); ?></h1>
						<span class="entry-date">
							<?php echo get_the_date('d.m.Y'); ?>
						</span>
					</div>
					<div class="share-icons pull-right">
						<?php echo do_shortcode( '[ssba]' ); ?>
					</div>
					<div class="border-bottom-news"></div>
				</div>

				<div class="firs-part-main-content">
					<?php if( get_field('ovde_dodajte_prvi_deo_sadrzaja_za_stranicu') ): ?>
						<div><?php the_field('ovde_dodajte_prvi_deo_sadrzaja_za_stranicu'); ?></div>
					<?php endif; ?>
				</div>

				<?php if( get_field('ovde_dodajte_sliku_za_citat') && get_field('ovde_dodajte_citat') ): ?>
					<div class="block-quote-content-wrapper clearfix">
						<div class="row">
							<div class="col-sm-6 image-quote-block-content">
								<?php if( get_field('ovde_dodajte_sliku_za_citat') ): ?>
									<img src="<?php the_field('ovde_dodajte_sliku_za_citat'); ?>" alt="Neodent citat slika">
								<?php endif; ?>
							</div>
							<div class="col-sm-6 position-full-height absolute padding-right-50 image-quote-block-content">
								<div class="display-table">
									<div class="display-table-cell align-middle">
										<?php if( get_field('ovde_dodajte_citat') ): ?>
											<blockquote><?php the_field('ovde_dodajte_citat'); ?></blockquote>
										<?php endif; ?>
									</div>
								</div>
							</div>

						</div>
					</div>
				<?php endif; ?>
				<?php get_template_part( 'article-templates/content-single', get_post_format() ); ?>

			<?php $related_product = get_field('izaberite_proizvod_vezan_za_clanak'); ?>
			<div class="news-product-description-section-warp">
					<?php if( $related_product ) : ?>
						<div class="chosen-product-news-description">
							<p><?php the_field('opis_zakacenog_proizvoda'); ?></p>
						</div>
					<?php endif; ?>
					<?php if( $related_product ) : ?>
						<div class="border-bottom-news"></div>
						<div class="article-related-product">
							<br>
							<?php echo do_shortcode("[product_page id='{$related_product[0]->ID}']"); ?>
						</div>
					<?php endif; ?>
			</div> <!-- /.news-product-description-section-warp -->
			<div class="sub-content-single-page-wrapper block-quote-image-content">

			</div>
			<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

			// Previous/next post navigation.
			// the_post_navigation( array(
			// 	'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'neodent' ) . '</span> ' .
			// 	'<span class="screen-reader-text">' . __( 'Next post:', 'neodent' ) . '</span> ' .
			// 	'<span class="post-title">%title</span>',
			// 	'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'neodent' ) . '</span> ' .
			// 	'<span class="screen-reader-text">' . __( 'Previous post:', 'neodent' ) . '</span> ' .
			// 	'<span class="post-title">%title</span>',
			// ) );

		// End the loop.
		endwhile;
		?>
		</div> <!-- /.container -->
	</main><!-- .site-main -->
</div><!-- .content-area -->
<?php
get_footer();
