<?php
/*
Template Name: FAQ template
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
get_header('header2');
?>
<div id="content" class="content-area">
	<main id="main" class="site-main container" role="main">
		<div class="row">
			<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-9'); ?>>
				<?php //$latest_news = new WP_Query(array(
					//'post_type' => 'post',
					//'category_name' => 'najnovije-vesti',
					//'posts_per_page' => 2,
					//));
				?>

				<?php if ( have_posts() ) : ?> 
				<?php while ( have_posts() ) : the_post(); ?>
					<div class="faq-content-wrap">
						<?php the_content(); ?>
					</div> <!-- /.faq-content-wrap -->
				<?php endwhile; ?>
				<?php endif; ?>
			</article>
			<div class="faq-sidebar col-md-3">
				<?php dynamic_sidebar( 'sidebar-faq' ); ?>
			</div>
		</div>
	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php
get_footer();
?>