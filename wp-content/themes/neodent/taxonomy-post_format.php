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
 * @name Post format template file
 * Used for displaying list of post format articles (video, chat, gallery, etc...) 
 * @group templates
 * @category main
 */
get_header()
?>
<section id="content" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				if ( is_tax( 'post_format', 'post-format-aside' ) ) :
					_e( 'Asides', 'neodent' );

				elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
					_e( 'Images', 'neodent' );

				elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
					_e( 'Videos', 'neodent' );

				elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
					_e( 'Audio', 'neodent' );

				elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
					_e( 'Quotes', 'neodent' );

				elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
					_e( 'Links', 'neodent' );

				elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
					_e( 'Galleries', 'neodent' );
				
				elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
					_e( 'Statuses', 'neodent' );
				
				elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
					_e( 'Chat', 'neodent' );

				else :
					_e( 'Archives', 'neodent' );

				endif;
				?>
			</header><!-- .page-header -->

			<?php
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
				'prev_text' => __( 'Previous page', 'neodent' ),
				'next_text' => __( 'Next page', 'neodent' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'neodent' ) . ' </span>',
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
