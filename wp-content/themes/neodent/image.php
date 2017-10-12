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
 * @name Image template file
 * Used for displaying the single attachment (image etc)
 * @group templates
 * @category main
 */
get_header('header1');
?>
<div id="content" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<nav id="image-navigation" class="navigation image-navigation">
					<div class="nav-links">
						<div class="nav-previous"><?php previous_image_link( false, __( 'Previous Image', 'neodent' ) ); ?></div><div class="nav-next"><?php next_image_link( false, __( 'Next Image', 'neodent' ) ); ?></div>
					</div><!-- .nav-links -->
				</nav><!-- .image-navigation -->

				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<div class="entry-attachment">
						<?php
						/**
						 * Filter the default image attachment size.
						 * @since 1.0.0
						 * @param string $image_size Image size. Default 'large'.
						 */
						$image_size = apply_filters( 'neodent_attachment_size', 'large' );

						echo wp_get_attachment_image( get_the_ID(), $image_size );
						?>

						<?php if ( has_excerpt() ) : ?>
							<div class="entry-caption">
								<?php the_excerpt(); ?>
							</div><!-- .entry-caption -->
						<?php endif; ?>

					</div><!-- .entry-attachment -->

					<?php
					the_content();
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
					<?php edit_post_link( __( 'Edit', 'neodent' ), '<span class="edit-link">', '</span>' ); ?>
				</footer><!-- .entry-footer -->

			</article><!-- #post-## -->
			<?php
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

			// Previous/next post navigation.
			the_post_navigation( array(
				'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'neodent' ),
			) );
		// End the loop.
		endwhile;
		?>
	</main><!-- .site-main -->
</div><!-- .content-area -->
<?php
get_footer();
