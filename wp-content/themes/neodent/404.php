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
 * @name 404 (not found) page template
 * Used for displaying list the 404 (not found) page
 * @group templates
 * @category main
 */
get_header('header1');
?>
<div id="content" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="container">
			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Oops! Ova stranica ne može da bude pronađena.', 'neodent' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php _e( 'Izgleda da ništa nije pronađeno na ovoj lokaciji. Možda da probate pomoću pretrage?', 'neodent' ); ?></p>

					<?php get_search_form(); ?>
				</div><!-- .page-content -->
			</section><!-- .error-404 container -->
		</div> <!-- /.container -->
	</main><!-- .site-main -->
</div><!-- .content-area -->
<?php 
get_footer();