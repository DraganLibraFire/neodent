<?php
/*
Template Name: News template
*/
?>
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
 * @name Sidebar widget template file
 * Used for displaying the list of primary sidebar
 * @group templates
 * @category main
 */
get_header('header1');
?>
<div id="content" class="content-area">
	<main id="main" class="site-main container" role="main">
		<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-9 pull-right'); ?>>
			<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;?>
			<?php $latest_news = new WP_Query(array(
					'post_type' => 'post',
					'category_name' => 'NOVOSTI',
					'posts_per_page' => 10,
					'paged' => $paged
				));
			?>
			<?php //$latest_news->query('category_='.$catname.'&showposts=2'.'&paged='.$paged);?>

			<?php if ( $latest_news->have_posts() ) : ?>
			<?php while ( $latest_news->have_posts() ) : $latest_news->the_post(); ?>
			<div class="row">
				<div class="latest-news-post-description-page-wrapp latest-news-post-description-page-wrapp clearfix">
					<div class="latest-news-post-img-wrapp col-sm-3">
						<div class="min-height">
							<div class="display-table">
								<div class="table-cell align-middle">
									<?php the_post_thumbnail(); ?>
								</div>
							</div>
						</div>

					</div> <!-- /.latest-news-post-img-wrapp col-md-12 -->
					<div class="title-excerpt-date-button-content-wrap col-sm-9">
						<div class="row">
							<div class="latest-news-post-title-wrapp col-md-12">
								<h2><?php the_title(); ?></h2>
							</div> <!-- /.latest-news-post-title-wrapp col-md-12 -->
							<div class="latest-news-post-content-content-wrapp col-md-12">
								<?php the_excerpt(); ?>
							</div>
							<div class="latest-news-post-date col-md-12">
								<span class="entry-date pull-left">
									<?php echo get_the_date('d.m.Y'); ?>
								</span>
								<span class="read-more-content pull-right">
									<a class="woo-botton read-more-button" href="<?php the_permalink(); ?>">Pročitaj više</a>
								</span>
							</div> <!-- /. latest-news-post-date col-md-12 -->
						</div>
					</div> <!-- /.title-excerpt-date-button-content-wrap col-sm-9 -->
					<div class="border-bottom-news"></div>
				</div> <!-- /.latest-news-post-description-wrapp col-md-12 -->
			</div>
			<?php endwhile; ?>
				<div class="row">
					<div class="col-md-12">
			          <?php
			          if($latest_news->max_num_pages>1){?>
			              <ul class="pagination">
			              <?php for($i=1;$i<=$latest_news->max_num_pages;$i++){ ?>
			                  <li><a href="<?php echo '?paged=' . $i; ?>" <?php echo ($paged==$i)? 'class="selected"':'';?>><?php echo $i;?></a></li>
			              <?php } ?>
			              </ul>
			          <?php } ?>
			        </div>
		        </div>
			<?php endif; ?>
		</article>
		<?php get_sidebar();?>
	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php
get_footer();
?>