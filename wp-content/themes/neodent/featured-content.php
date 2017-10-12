<?php
/*
 * Themez Kitchen Premium Themes
 * -----------------------------------------------------------
 * @package neodent -  Themez Kitchen  - Premium Multipurpose Wordpress Theme
 * @subpackage ThemezKitchen WP Theme Framework
 * @copyright Copyright (c), ThemezKitchen,  (http://www.themezkitchen.com/)
 * @link http://www.themezkitchen.com/
 * @version 1.0.0
 * @since Version 1.0.0
 */

/**
 * Featured posts content
 */
?>
<div id="featured-content" class="featured-content">
	<div id="owl-featured-content" class="featured-content-inner owl-carousel">
		<?php
		/**
		 * Fires before the featured content.
		 */
		do_action( 'neodent_featured_posts_before' );

		$featured_posts = neodent_get_featured_posts();
		foreach ( (array) $featured_posts as $order => $post ) :
			setup_postdata( $post );
			// Include the featured content template.
			get_template_part( 'article-templates/content', 'featured-post' );
		endforeach;
		/**
		 * Fires after the featured content.
		 * @since 1.0.0
		 */
		do_action( 'neodent_featured_posts_after' );

		wp_reset_postdata();
		?>
	</div><!-- .featured-content-inner -->
	<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
               viewBox="0 0 50 43.113" enable-background="new 0 0 50 43.113" xml:space="preserve" preserveAspectRatio="none" class="svg-element">
       <polygon points="0.108,43.113 25,0 49.892,43.113 "/>
       </svg>
</div><!-- #featured-content .featured-content -->