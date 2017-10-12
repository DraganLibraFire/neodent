<?php
/*
Template Name: Magazine template
*/
?>
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
 * @name Sidebar widget template file
 * Used for displaying the list of primary sidebar
 * @group templates
 * @category main
 */
get_header('header1');
?>
<div id="content" class="content-area">
	<main id="main" class="site-main container" role="main">
		<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-9'); ?>>
			<?php $magazine = new WP_Query(array(
				'post_type' => 'magazine_page'
				));
			?>
			<?php if ( $magazine->have_posts() ) : ?>
			<div class="row">
				<div class="magazine-news-post-description-page-wrapp magazine-page-wrapp">
					<h2 class="title-post-border-right"><span>Časopis Neodent News</span></h2>
					<!-- <div class="row"> -->
						<?php while ( $magazine->have_posts() ) : $magazine->the_post(); ?>
								<div class="magazine-news-post-img-wrapp col-md-4">

									<a target="_blank" href="<?php the_field('dodajte_vas_casopis_ovde'); ?>">
											<div class="thumb-wrapp">
												<?php the_post_thumbnail('neodent-magazine-large'); ?>
											</div> <!-- /. thumb-wrapp -->
											<hr />
											<h2><?php the_title(); ?></h2>
										</a>
								</div> <!-- /.magazine-news-post-img-wrapp col-md-4 -->
						<?php endwhile; ?>
					<!-- </div> -->
				</div> <!-- /.magazine-news-post-description-wrapp -->
			</div>
			<?php endif; ?>
		</article>
		<?php get_sidebar();?>
	</main><!-- .site-main -->
</div><!-- #content .content-area -->

<?php
get_footer();
?>