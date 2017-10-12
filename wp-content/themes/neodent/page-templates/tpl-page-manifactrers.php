<?php
/*
Template Name: Manufacturers template
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
		<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-12'); ?>>
			<?php $manufacturers = new WP_Query(array(
				'post_type' => 'manifacturers_page',
				'posts_per_page' => -1
				));
			?>
			<?php if ( $manufacturers->have_posts() ) : ?>
			<div class="manufacturers-news-post-description-page-wrapp manufacturers-page-wrapp">
				<div class="row">
					<?php while ( $manufacturers->have_posts() ) : $manufacturers->the_post(); ?>
						<div class="manufacturers-news-post-img-wrapp col-md-3 col-md-manufactures grey-logos">
							<a href="<?php the_permalink(); ?>">
								<img src="<?php the_field('logo_proizvodjaca'); ?>" alt="Logo proizvodjaca" title="Logo proizvodjaca">
							</a>
						</div> <!-- /.manufacturers-news-post-img-wrapp col-md-3 -->
					<?php endwhile; ?>
				</div>
			</div> <!-- /.manufacturers-news-post-description-wrapp col-md-12 -->
			<?php endif; ?>
		</article>
		<?php //get_sidebar();?>
	</main><!-- .site-main -->
</div><!-- #content .content-area -->

<?php
get_footer();
?>