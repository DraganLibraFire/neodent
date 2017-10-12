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
 * @name Author template file
 * Used for displaying the list of specific author posts
 * @group templates
 * @category main
 */
get_header('header1');
?>
<section id="content" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php
					/*
					 * Queue the first post, that way we know what author
					 * we're dealing with (if that is the case).
					 *
					 * We reset this later so we can run the loop properly
					 * with a call to rewind_posts().
					 */
					the_post();
					printf( __( 'Svi postovi za %s', 'neodent' ), get_the_author() );
					?>
				</h1>
			</header><!-- .page-header -->

			<?php
			/*
			 * Since we called the_post() above, we need to rewind
			 * the loop back to the beginning that way we can run
			 * the loop properly, in full.
			 */
			rewind_posts();

			// Start the loop.
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'article-templates/content', get_post_format() );

			// End the loop.
			endwhile;

			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( 'Prethodna stranica', 'neodent' ),
				'next_text'          => __( 'Sledeća stranica', 'neodent' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Stranica', 'neodent' ) . ' </span>',
			) );

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'article-templates/content', 'none' );
		endif;
		?>
	</main><!-- .site-main -->
</section><!-- .content-area -->
<?php
get_footer();
