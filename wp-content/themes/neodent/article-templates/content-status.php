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
 * @name Template for Post format - Status
 * Used for design of the specific post-format
 * @group templates
 * @category articles
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="media clearfix">
		<div class="author-avatar pull-left">
			<?php
			/**
			 * Filter the author bio avatar size.
			 *
			 * @since 1.0.0
			 *
			 * @param int $size The avatar height and width size in pixels.
			 */
			$author_bio_avatar_size = apply_filters( 'neodent_author_bio_avatar_size', 96 );

			echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
			?>
		</div><!-- .author-avatar -->
		<div class="media-body">
			<header class="entry-header">
				<?php
				if ( is_single() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				else :
					the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
				endif;
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
				<?php neodent_entry_meta(); ?>
				<?php edit_post_link( __( 'Izmeni', 'neodent' ), '<span class="edit-link">', '</span>' ); ?>
			</footer><!-- .entry-footer -->	
		</div>
	</div>

	<?php
	// Author bio.
	if ( is_single() && get_the_author_meta( 'description' ) ) :
		get_template_part( 'article-templates/author-bio' );
	endif;
	?>
</article>
