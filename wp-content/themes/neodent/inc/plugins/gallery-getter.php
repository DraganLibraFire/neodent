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
 * This function here helps you to get all the image src in a array
 * This is usefull if you want to display the 
 * gallery images in some manner in post list
 * Examples: Slider, Carousel, Puzzle or what not
 * 
 * You can also create a new functions to display the gallery images in a different manner
 * 
 */

/**
 * Get  images from all the galleries in the post
 * With a simple command to remove the gallery from the content or to keep it displayed
 * 
 * @param type $remove_from_content
 * @return array | boolean
 * @category helpers
 */
function neodent_get_gallery_images( $remove_from_content = true ) {
	$attachment_ids = array();
	$pattern = get_shortcode_regex();
	//flag the response;
	$images_response = false;
	if ( preg_match_all( '/' . $pattern . '/s', get_the_content(), $matches ) ) {
		//we have gallery
		$images = array();
		//finds the "gallery" shortcode and puts the image ids in an associative array at $matches[3]
		$count = count( $matches[3] );   //in case there is more than one gallery in the post.
		for ( $i = 0; $i < $count; $i++ ) {
			$atts = shortcode_parse_atts( $matches[3][$i] );
			if ( isset( $atts['ids'] ) ) {
				$attachment_ids = explode( ',', $atts['ids'] );
				$attachementsCount = count( $attachment_ids );
				if ( $attachementsCount > 0 ) {
					for ( $j = 0; $j < $attachementsCount; $j++ ) {
						$image = array();
						$attachmentId = intval( $attachment_ids[$j] );
						$image['id'] = $attachmentId;
						$image['full'] = wp_get_attachment_image_src( $attachmentId, 'full' );
						$image['medium'] = wp_get_attachment_image_src( $attachmentId, 'medium' );
						$image['thumbnail'] = wp_get_attachment_image_src( $attachmentId, 'thumbnail' );
						array_push( $images, $image );
					}
				}
			}
		}
		//format the array, because we need a count
		$images_response = array(
			'count' => count( $images ),
			'images' => $images
		);

		if ( $remove_from_content ) :
			//remove shortcode and preg replace pattern
			remove_shortcode( 'gallery' );
			add_filter( 'the_content', 'neodent_strip_gallery_shortcode', 10 );
		endif;
	}
	//return flag | array
	return $images_response;
}

/**
 * Filter to remove gallery shortcode code from content after removing the shortcode gallery
 * @param type $content
 * @return string
 * @category filters
 */
function neodent_strip_gallery_shortcode( $content ) {
	return preg_replace( '/\[gallery [^\]]+\]/', '', $content, -1 );
}

/**
 * Just a simple helper to show the gallery or not
 * 
 * @global type $post
 * @return boolean
 */
function neodent_has_gallery() {
	global $post;
	if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'gallery' ) ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Return the image meta info
 * 
 * @param int $attachment_id
 * @return array
 * @category helpers
 */
function neodent_get_attachment( $attachment_id ) {

	$attachment = get_post( $attachment_id );
	return array(
		'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
		'caption' => $attachment->post_excerpt,
		'description' => $attachment->post_content,
		'href' => get_permalink( $attachment->ID ),
		'src' => $attachment->guid,
		'title' => $attachment->post_title
	);
}

function neodent_gallery_slider_bootstrap( $image_size = 'full' ) {
	if ( neodent_has_gallery() ) {
		$gallery = neodent_get_gallery_images();
		?>
		<div id="boot-carousel-<?php echo esc_attr( get_the_ID() ); ?>" class="carousel slide" data-ride="carousel">
			<!-- Indicators -->
			<ol class="carousel-indicators">
				<?php
				$i = 0;
				foreach ( $gallery['images'] as $image ) :
					if ( $i == 0 ) : $active = ' class="active"';
					else: $active = null;
					endif;
					?>
					<li data-target="#boot-carousel-<?php echo esc_attr( get_the_ID() ); ?>" data-slide-to="<?php echo esc_attr($i);?>"<?php echo esc_attr( $active ); ?>></li>
					<?php $i++;
				endforeach;
				?>
			</ol>

			<!-- Wrapper for slides -->
			<div class="carousel-inner" role="listbox">
				<?php
				$i = 0;
				foreach ( $gallery['images'] as $image ) :
					if ( $i == 0 ) : $active = ' active';
					else: $active = null;
					endif;
					$meta = neodent_get_attachment( $image['id'] );
					?>
					<div class="item<?php echo esc_attr( $active ); ?>">
						<img src="<?php echo esc_url( $image['full'][0] ); ?>" alt="<?php echo esc_attr( $meta['alt'] ); ?>">
						<?php
						if ( $meta['caption'] != '' ) :
							?>
							<div class="carousel-caption">
							<?php echo esc_attr( $meta['caption'] ); ?>
							</div>
					<?php endif; ?>
					</div>
					<?php $i++;
				endforeach;
				?>
			</div>

			<!-- Controls -->
			<a class="left carousel-control" href="#boot-carousel-<?php echo esc_attr( get_the_ID() ); ?>" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				<span class="screen-reader-text"><?php _e('Previous', 'neodent');?></span>
			</a>
			<a class="right carousel-control" href="#boot-carousel-<?php echo esc_attr( get_the_ID() ); ?>" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				<span class="screen-reader-text"><?php _e('Next', 'neodent');?></span>
			</a>
		</div>
		<?php
	}
}
