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
 * @name Page template file
 * Used for displaying the page itself. If you want to create a page template refer to the readme.md in the page-templates folder
 * @group templates
 * @category main
 */
get_header('header1');
?>
<!-- <div id="content" class="content-area">
	<main id="main" class="site-main" role="main"> -->
		<div class="container">
			<?php if ( is_singular( 'product' ) ) {
			     woocommerce_content();
		  	}else{
			   //For ANY product archive.
			   //Product taxonomy, product search or /shop landing
			    woocommerce_get_template( 'archive-product.php' );
			  } ?>
		</div> <!-- /.container -->
	<!-- </main> --><!-- .site-main -->
<!-- </div> --><!-- .content-area -->
<?php
get_footer();