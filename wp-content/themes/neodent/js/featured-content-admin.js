/**
 * neodent Featured Content admin behavior: add a tag suggestion
 * when changing the tag.
 */
/* global ajaxurl:true */

jQuery( document ).ready( function( $ ) {
	$( '#neodent_theme_settings-tag-name input' ).suggest( ajaxurl + '?action=ajax-tag-search&tax=post_tag', { delay: 500, minchars: 2 } );

	// $("#reload").on("click", function () {
 //        $("#tabs").tabs("load", 3);
 //    });
	if( $( "#tabs" ).length > 0 )
		$( "#tabs" ).tabs();
});
