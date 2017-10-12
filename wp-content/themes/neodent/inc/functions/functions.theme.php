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
 * @name Template function file
 * Used for a couple of theme hooks, stylesheet and scripts init etc
 * @group functions
 * @category main
 */
if ( !function_exists( 'neodent_fonts_url' ) ) :

	/**
	 * Register Google fonts for the Theme.
	 * 
	 * @since 1.0.0
	 *
	 * @return string Google fonts URL for the theme.
	 * @category helpers
	 */
	function neodent_fonts_url() {
		$fonts_url = '';
		$fonts = array();
		$subsets = 'latin,latin-ext';

		/* translators: If there are characters in your language that are not supported by Noto Sans, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Noto Sans font: on or off', 'neodent' ) ) {
			$fonts[] = 'Noto Sans:400italic,700italic,400,700';
		}

		/* translators: If there are characters in your language that are not supported by Noto Serif, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Noto Serif font: on or off', 'neodent' ) ) {
			$fonts[] = 'Noto Serif:400italic,700italic,400,700';
		}

		/* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'neodent' ) ) {
			$fonts[] = 'Inconsolata:400,700';
		}

		/* translators: To add an additional character subset specific to your language, translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language. */
		$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'neodent' );

		if ( 'cyrillic' == $subset ) {
			$subsets .= ',cyrillic,cyrillic-ext';
		} elseif ( 'greek' == $subset ) {
			$subsets .= ',greek,greek-ext';
		} elseif ( 'devanagari' == $subset ) {
			$subsets .= ',devanagari';
		} elseif ( 'vietnamese' == $subset ) {
			$subsets .= ',vietnamese';
		}

		if ( $fonts ) {
			$fonts_url = add_query_arg( array(
				'family' => urlencode( implode( '|', $fonts ) ),
				'subset' => urlencode( $subsets ),
					), '//fonts.googleapis.com/css' );
		}

		return $fonts_url;
	}

endif;

/**
 * Enqueue scripts and styles.
 *
 * @since 1.0.0
 * @category hooks
 */
function neodent_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'neodent-fonts', neodent_fonts_url(), array(), null );

	// Add Font Awesome (or enqueue other font icon), used in the design
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.2.0' );

	// Add Bootstrap(or enqueue other font icon), used in the design
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array(), '3.3.1' );

	// Add Jquery Tabs CSS used in the design
	wp_enqueue_style( 'tabs', get_template_directory_uri() . '/css/jquery-ui.css', array(), '1.11.4' );

	// Add Chosen select style
	wp_enqueue_style( 'chosen', get_template_directory_uri() . '/css/chosen.css', array(), '1.1.0' );

	// Add Jquery Tabs CSS used in the design
	wp_enqueue_style( 'custom', get_template_directory_uri() . '/css/sale.css', array(), '1.2.0' );

	// Load our main stylesheet.
	wp_enqueue_style( 'neodent-style', get_stylesheet_uri() );

	// Load the Internet Explorer specific stylesheet (General IE)
	wp_enqueue_style( 'neodent-ie', get_template_directory_uri() . '/css/ie/ie.css', array( 'neodent-style' ), '1.0.0' );
	wp_style_add_data( 'neodent-ie', 'conditional', 'if IE' );

	// Load the Internet Explorer 8 specific stylesheet (version 8 or lower versions)
	wp_enqueue_style( 'neodent-ie8', get_template_directory_uri() . '/css/ie/ie8.css', array( 'neodent-style' ), '1.0.0' );
	wp_style_add_data( 'neodent-ie8', 'conditional', 'if lte IE 8' );

	// Load the Internet Explorer 9 specific stylesheet (version 9 spoecific)
	wp_enqueue_style( 'neodent-ie9', get_template_directory_uri() . '/css/ie/ie9.css', array( 'neodent-style' ), '1.0.0' );
	wp_style_add_data( 'neodent-ie9', 'conditional', 'if IE 9' );

	//Enqueue scripts
	wp_enqueue_script( 'neodent-skip-link-focus-fix', get_template_directory_uri() . '/js/vendors/skip-link-focus-fix.js', array(), '1.0.0', true );

	//Comment scripts
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	//Enqueue bootstrap
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/vendors/bootstrap.min.js', array(), '3.3.1', true );

	//Add site functions javascript
	wp_enqueue_script( 'neodent-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '1.0.0', true );
}

add_action( 'wp_enqueue_scripts', 'neodent_scripts' );

if ( !function_exists( 'neodent_entry_meta' ) ) :

	/**
	 * Prints HTML with meta information for the categories, tags.
	 *
	 * @since 1.0.0
	 * @category helpers
	 */
	function neodent_entry_meta() {
		
		if ( is_sticky() && is_home() && !is_paged() ) {
			printf( '<span class="sticky-post">%s</span>', __( 'Featured', 'neodent' ) );
		}

		$format = get_post_format();
		if ( current_theme_supports( 'post-formats', $format ) ) {
			printf( '<span class="entry-format">%1$s<a href="%2$s">%3$s</a></span>', sprintf( '<span class="screen-reader-text">%s </span>', _x( 'Format', 'Used before post format.', 'neodent' ) ), esc_url( get_post_format_link( $format ) ), get_post_format_string( $format )
			);
		}

		if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
			$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

			if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
				$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
			}

			$time_string = sprintf( $time_string, esc_attr( get_the_date( 'c' ) ), get_the_date(), esc_attr( get_the_modified_date( 'c' ) ), get_the_modified_date()
			);

			printf( '<span class="posted-on"><span class="screen-reader-text">%1$s </span><a href="%2$s" rel="bookmark">%3$s</a></span>', _x( 'Posted on', 'Used before publish date.', 'neodent' ), esc_url( get_permalink() ), $time_string
			);
		}

		if ( 'post' == get_post_type() ) {
			if ( is_singular() || is_multi_author() ) {
				printf( '<span class="byline"><span class="author vcard"><span class="screen-reader-text">%1$s </span><a class="url fn n" href="%2$s">%3$s</a></span></span>', _x( 'Author', 'Used before post author name.', 'neodent' ), esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), get_the_author()
				);
			}

			$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'neodent' ) );
			if ( $categories_list && neodent_categorized_blog() ) {
				printf( '<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>', _x( 'Categories', 'Used before category names.', 'neodent' ), $categories_list
				);
			}

			$tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'neodent' ) );
			if ( $tags_list ) {
				printf( '<span class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span>', _x( 'Tags', 'Used before tag names.', 'neodent' ), $tags_list
				);
			}
		}

		if ( is_attachment() && wp_attachment_is_image() ) {
			// Retrieve attachment metadata.
			$metadata = wp_get_attachment_metadata();

			printf( '<span class="full-size-link"><span class="screen-reader-text">%1$s </span><a href="%2$s">%3$s &times; %4$s</a></span>', _x( 'Full size', 'Used before full size attachment link.', 'neodent' ), esc_url( wp_get_attachment_url() ), $metadata['width'], $metadata['height']
			);
		}

		if ( !is_single() && !post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( __( 'Leave a comment', 'neodent' ), __( '1 Comment', 'neodent' ), __( '% Comments', 'neodent' ) );
			echo '</span>';
		}
	}

endif;

/**
 * Extend the default WordPress body classes.
 *
 * Adds body classes to denote if you want, you can add mor eclasses here
 * 1. Single or multiple authors.
 * 2. Presence of header image except in Multisite signup and activate pages.
 * 3. Index views.
 * 4. Full-width content layout.
 * 5. Presence of footer widgets.
 * 6. Single views.
 * 7. Featured content layout.
 *
 * @since 1.0.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 * @category hooks
 */
function neodent_body_classes( $classes ) {
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if ( is_archive() || is_search() || is_home() ) {
		$classes[] = 'list-view';
	}

	if ( is_singular() && !is_front_page() ) {
		$classes[] = 'singular';
	}
	return $classes;
}

add_filter( 'body_class', 'neodent_body_classes' );

/**
 * Extend the default WordPress post classes.
 *
 * Adds a post class to denote:
 * Non-password protected page with a post thumbnail.
 *
 * @since 1.0.0
 * @category hooks
 *
 * @param array $classes A list of existing post class values.
 * @return array The filtered post class list.
 */
function neodent_post_classes( $classes ) {
	if ( !post_password_required() && !is_attachment() && has_post_thumbnail() ) {
		$classes[] = 'has-post-thumbnail';
	}

	return $classes;
}

add_filter( 'post_class', 'neodent_post_classes' );

/**
 * Find out if blog has more than one category.
 *
 * @since 1.0.0
 * @category hooks
 * @return boolean true if blog has more than 1 category
 */
function neodent_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'neodent_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields' => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number' => 2,
				) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'neodent_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so neodentn_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so neodent_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in neodent_categorized_blog.
 *
 * @since 1.0.0
 * @category hooks
 */
function neodent_category_transient_flusher() {
	delete_transient( 'neodent_categories' );
}

add_action( 'edit_category', 'neodent_category_transient_flusher' );
add_action( 'save_post', 'neodent_category_transient_flusher' );


if ( ! function_exists( 'neodent_comment_nav' ) ) :
/**
 * Display navigation to next/previous comments when applicable.
 *
 * @since 1.0.0
 * @category helpers
 */
function neodent_comment_nav() {
	// Are there comments to navigate through?
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
	?>
	<nav class="navigation comment-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'neodent' ); ?></h2>
		<div class="nav-links">
			<?php
				if ( $prev_link = get_previous_comments_link( __( 'Older Comments', 'neodent' ) ) ) :
					printf( '<div class="nav-previous">%s</div>', $prev_link );
				endif;

				if ( $next_link = get_next_comments_link( __( 'Newer Comments', 'neodent' ) ) ) :
					printf( '<div class="nav-next">%s</div>', $next_link );
				endif;
			?>
		</div><!-- .nav-links -->
	</nav><!-- .comment-navigation -->
	<?php
	endif;
}
endif;



if ( !function_exists( 'neodent_post_thumbnail' ) ) :

	/**
	 * Display an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 *
	 * @since 1.0.0
	 * @category helpers
	 */
	function neodent_post_thumbnail() {
		if ( post_password_required() || is_attachment() || !has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
			<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
			<?php
			the_post_thumbnail( 'post-thumbnail', array( 'alt' => get_the_title() ) );
			?>
			</a>

		<?php
		endif; // End is_singular()
	}

endif;



if ( !function_exists( 'neodent_get_link_url' ) ) :

	/**
	 * Return the post URL.
	 *
	 * Falls back to the post permalink if no URL is found in the post.
	 *
	 * @since 1.0.0
	 * @category helpers
	 * @see get_url_in_content()
	 *
	 * @return string The Link format URL.
	 */
	function neodent_get_link_url() {
		$has_url = get_url_in_content( get_the_content() );

		return $has_url ? $has_url : apply_filters( 'the_permalink', get_permalink() );
	}

endif;




/* Filter the content of chat posts. */
add_filter( 'the_content', 'neodent_format_chat_content' );

/* Auto-add paragraphs to the chat text. */
add_filter( 'neodent_post_format_chat_text', 'wpautop' );

/**
 * This function filters the post content when viewing a post with the "chat" post format.  It formats the 
 * content with structured HTML markup to make it easy for theme developers to style chat posts.  The 
 * advantage of this solution is that it allows for more than two speakers (like most solutions).  You can 
 * have 100s of speakers in your chat post, each with their own, unique classes for styling.
 *
 * @author David Chandra
 * @link http://www.turtlepod.org
 * @author Justin Tadlock
 * @link http://justintadlock.com
 * @copyright Copyright (c) 2012
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @link http://justintadlock.com/archives/2012/08/21/post-formats-chat
 *
 * @global array $_post_format_chat_ids An array of IDs for the chat rows based on the author.
 * @param string $content The content of the post.
 * @return string $chat_output The formatted content of the post.
 */
function neodent_format_chat_content( $content ) {
	global $_post_format_chat_ids;

	/* If this is not a 'chat' post, return the content. */
	if ( !has_post_format( 'chat' ) )
		return $content;

	/* Set the global variable of speaker IDs to a new, empty array for this chat. */
	$_post_format_chat_ids = array();

	/* Allow the separator (separator for speaker/text) to be filtered. */
	$separator = apply_filters( 'neodent_post_format_chat_separator', ':' );

	/* Open the chat transcript div and give it a unique ID based on the post ID. */
	$chat_output = "\n\t\t\t" . '<div id="chat-transcript-' . esc_attr( get_the_ID() ) . '" class="chat-transcript">';

	/* Split the content to get individual chat rows. */
	$chat_rows = preg_split( "/(\r?\n)+|(<br\s*\/?>\s*)+/", $content );

	/* Loop through each row and format the output. */
	foreach ( $chat_rows as $chat_row ) {
		/* If a speaker is found, create a new chat row with speaker and text. */
		if ( strpos( $chat_row, $separator ) ) {
                    
			/* Split the chat row into author/text. */
			$chat_row_split = explode( $separator, trim( $chat_row ), 2 );

			/* Get the chat author and strip tags. */
			$chat_author = strip_tags( trim( $chat_row_split[0] ) );

			/* Get the chat text. */
			$chat_text = trim( $chat_row_split[1] );

			/* Get the chat row ID (based on chat author) to give a specific class to each row for styling. */
			$speaker_id = neodent_format_chat_row_id( $chat_author );
			/* Open the chat row. */
			$chat_output .= "\n\t\t\t\t" . '<div class="chat-row ' . sanitize_html_class( "chat-speaker-{$speaker_id}" ) . '">';

			/* Add the chat row author. */
			$chat_output .= "\n\t\t\t\t\t" . '<div class="chat-author ' . sanitize_html_class( strtolower( "chat-author-{$chat_author}" ) ) . ' vcard"><cite class="fn">' . apply_filters( 'neodent_post_format_chat_author', $chat_author, $speaker_id ) . '</cite>' . $separator . '</div>';

			/* Add the chat row text. */
			$chat_output .= "\n\t\t\t\t\t" . '<div class="chat-text">' . str_replace( array( "\r", "\n", "\t" ), '', apply_filters( 'neodent_post_format_chat_text', $chat_text, $chat_author, $speaker_id ) ) . '</div>';

			/* Close the chat row. */
			$chat_output .= "\n\t\t\t\t" . '</div><!-- .chat-row -->';
		}
                

		/**
		 * If no author is found, assume this is a separate paragraph of text that belongs to the
		 * previous speaker and label it as such, but let's still create a new row.
		 */
		else {

			/* Make sure we have text. */
			if ( !empty( $chat_row ) ) {

				/* Open the chat row. */
				$chat_output .= "\n\t\t\t\t" . '<div class="chat-row ' . sanitize_html_class( "chat-speaker-{$speaker_id}" ) . '">';

				/* Don't add a chat row author.  The label for the previous row should suffice. */

				/* Add the chat row text. */
				$chat_output .= "\n\t\t\t\t\t" . '<div class="chat-text">' . str_replace( array( "\r", "\n", "\t" ), '', apply_filters( 'neodent_post_format_chat_text', $chat_row, $chat_author, $speaker_id ) ) . '</div>';

				/* Close the chat row. */
				$chat_output .= "\n\t\t\t</div><!-- .chat-row -->";
			}
		}
	}

	/* Close the chat transcript div. */
	$chat_output .= "\n\t\t\t</div><!-- .chat-transcript -->\n";

	/* Return the chat content and apply filters for developers. */
	return apply_filters( 'neodent_post_format_chat_content', $chat_output );
}

/**
 * This function returns an ID based on the provided chat author name.  It keeps these IDs in a global 
 * array and makes sure we have a unique set of IDs.  The purpose of this function is to provide an "ID"
 * that will be used in an HTML class for individual chat rows so they can be styled.  So, speaker "John" 
 * will always have the same class each time he speaks.  And, speaker "Mary" will have a different class 
 * from "John" but will have the same class each time she speaks.
 *
 * @author David Chandra
 * @link http://www.turtlepod.org
 * @author Justin Tadlock
 * @link http://justintadlock.com
 * @copyright Copyright (c) 2012
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @link http://justintadlock.com/archives/2012/08/21/post-formats-chat
 *
 * @global array $_post_format_chat_ids An array of IDs for the chat rows based on the author.
 * @param string $chat_author Author of the current chat row.
 * @return int The ID for the chat row based on the author.
 */
function neodent_format_chat_row_id( $chat_author ) {
	global $_post_format_chat_ids;

	/* Let's sanitize the chat author to avoid craziness and differences like "John" and "john". */
	$chat_author = strtolower( strip_tags( $chat_author ) );

	/* Add the chat author to the array. */
	$_post_format_chat_ids[] = $chat_author;

	/* Make sure the array only holds unique values. */
	$_post_format_chat_ids = array_unique( $_post_format_chat_ids );

	/* Return the array key for the chat author and add "1" to avoid an ID of "0". */
	return absint( array_search( $chat_author, $_post_format_chat_ids ) ) + 1;
}
