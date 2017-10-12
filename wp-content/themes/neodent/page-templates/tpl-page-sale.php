<?php
/*
Template Name: Sale products template
*/
?>
<?php
get_header('header1');
?>
<div id="content" class="content-area">
	<main id="main" class="site-main container" role="main">
		<?php get_sidebar();?>
		<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-9'); ?>>
			<div class="row-fluid list-of-woocommerce-products">
				<?php echo do_shortcode('[sale_products per_page="-1" orderby="date"  order="desc" columns="3"]'); ?>
			</div><!-- /.row-fluid list-of-woocommerce-products -->
		</article>
	</main><!-- .site-main -->
</div><!-- .content-area -->
<?php
get_footer();
?>