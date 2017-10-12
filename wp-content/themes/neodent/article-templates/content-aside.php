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
 * @name Template for Post format - Aside
 * Used for design of the specific post-format
 * @group templates
 * @category articles
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-9'); ?>>
	<?php
	// Post thumbnail.
	neodent_post_thumbnail();
	?>
	<header class="entry-header">
		<?php
			the_title( '<h1 class="entry-title"><span>', '</span></h1>' );
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
		<?php //neodent_entry_meta(); ?>
		<?php edit_post_link( __( 'Izmeni', 'neodent' ), '<span class="edit-link">', '</span>' ); ?>
	</footer> <!-- .entry-footer -->

	<?php
	// Author bio.
	if ( is_single() && get_the_author_meta( 'description' ) ) :
		get_template_part( 'article-templates/author-bio' );
	endif;
	?>
</article>
<?php get_sidebar();?>