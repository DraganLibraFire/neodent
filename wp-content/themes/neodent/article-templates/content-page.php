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
 * @name Template for Post format - Page
 * Used for design of the specific post-format
 * @group templates
 * @category articles
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	// Post thumbnail.
	neodent_post_thumbnail();
	?>
	<header class="entry-header">
		<?php
		the_title( '<h1 class="entry-title">', '</h1>' );
		?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		/* translators: %s: Name of current post */
		the_content( sprintf(
						__( 'Continue reading %s', 'neodent' ), the_title( '<span class="screen-reader-text">', '</span>', false )
		) );

		wp_link_pages( array(
			'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'neodent' ) . '</span>',
			'after' => '</div>',
			'link_before' => '<span>',
			'link_after' => '</span>',
			'pagelink' => '<span class="screen-reader-text">' . __( 'Page', 'neodent' ) . ' </span>%',
			'separator' => '<span class="screen-reader-text">, </span>',
		) );
		?>
	</div><!-- .entry-content -->

    <footer class="entry-footer">
		<?php edit_post_link( __( 'Izmeni', 'neodent' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->	
</article>