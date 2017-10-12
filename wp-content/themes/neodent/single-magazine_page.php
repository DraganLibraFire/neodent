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
		<div class="container">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			/*
			 * Include the Post-Format-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
			 */
			get_template_part( 'article-templates/content-magazine', get_post_format() );

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
