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
if ( is_active_sidebar( 'sidebar-primary' ) ) : ?>
<div id="secondary" class="secondary col-md-3">
	<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-primary' ); ?>
	</div>
</div>
<?php endif;