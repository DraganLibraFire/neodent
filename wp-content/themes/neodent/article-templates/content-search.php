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
 * @name Template for Search Articles
 * Used for design of the search page
 * @group templates
 * @category articles
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('page page-search col-md-12'); ?>>
	<?php
	// Post thumbnail.
	neodent_post_thumbnail();
	?>
	<div class="search-content-wrapp">
		<header class="entry-header">
			<?php
			the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			?>
		</header><!-- .entry-header -->
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div>

	    <footer class="entry-footer">
			<?php //neodent_entry_meta(); ?>
			<?php edit_post_link( __( 'Izmeni', 'neodent' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-footer -->
	</div>

</article>