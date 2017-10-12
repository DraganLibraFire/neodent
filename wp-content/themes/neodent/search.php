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
 * @name Search template file
 * Used for displaying search items
 * @group templates
 * @category main
 */
get_header('header1');
?>
	<script>
		fbq('track', 'Search', {
			search_string: '<?php echo get_search_query(); ?>'
		});
	</script>

<section id="content" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="container">
		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
				<?php
					 printf( __( 'Rezultati pretrage za: %s', 'neodent' ), get_search_query() );
				?>
				</h1>
			</header><!-- .page-header -->

			<?php
			// Start the loop.
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'article-templates/content', 'search' );

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
		</div> <!-- /.container -->
	</main><!-- .site-main -->
</section><!-- .content-area -->
<?php
get_footer();