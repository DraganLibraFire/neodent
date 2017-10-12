<?php

/* 
 * Themez Kitchen Premium Themes
 * -----------------------------------------------------------
 * @package neodent -  Themez Kitchen  - Premium Multipurpose Wordpress Theme
 * @subpackage ThemezKitchen WP Theme Framework
 * @copyright Copyright (c), ThemezKitchen,  (http://www.themezkitchen.com/)
 * @link http://www.themezkitchen.com/
 * @version 1.0.0
 * @since Version 1.0.0
 */

/**
 * @name Template for the Featured post
 * Used for design of the featured post item
 * @group templates
 * @category articles
 */
?>
<div class="owl-item">
    <article id="post-<?php the_ID(); ?>">
        <a class="post-thumbnail" href="<?php the_permalink(); ?>">
			<span class="entry-title">
				<?php
				//get the categories
				$categories = get_the_category();
				$separator = ', ';
				$output = '';
				if($categories) {
					foreach($categories as $category) {
							$output .= $category->cat_name . $separator;
					}
				printf( '<span class="feat-categories">%1$s</span>',
					trim($output, $separator)
				);	
				}
				//the title
				 the_title();
				// Set up and print post meta information.
				printf( '<span class="feat-meta"><em class="entry-date"><time class="entry-date" datetime="%1$s">%2$s</time></em> &bull; <em class="byline"><span class="author vcard">%3$s</span></em></span>',
					esc_attr( get_the_date( 'c' ) ),
					esc_html( get_the_date() ),
					get_the_author()
				);
				?>
				
			</span>
         <span class="featured-overlay"></span>
            <?php 
          if ( has_post_thumbnail() ) :
              the_post_thumbnail();
          endif;
          ?>
        </a>
    </article>
</div>