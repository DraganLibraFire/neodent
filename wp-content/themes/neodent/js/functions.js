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

//Tabs in homepage for woocommerce products
jQuery( document ).ready( function( $ ) {
    // var
    // extended = 0,
    // from_close = false;

    $( "#tabs" ).tabs({
        activate: function( event, ui ) {
            if( $('#tabs #three .products').hasClass('slick-initialized') ){
                $('#tabs .products').slick('setPosition');
            }
            $('#tabs #two .products').slick('setPosition');

            $('#tabs #two .products').animate({ opacity: 1 });

        }
    });

    // $("#menu-sidebar-menu > li").append("<li class='load-more-from-list'><span class='load-more-about-us'>&#x25BC;</span></li>");

    //Animate button to top
    $('button.to-top').click(function(){
       $("html, body").animate({ scrollTop: 0 }, 1000);
     });

    // toggle click in sidebar
    $(".faq-sidebar aside .widget-title").click(function () {
        var parentFaq = $(this).closest('.faq-sidebar aside');
        $("h2", parentFaq).toggleClass('open-faq-toggle');
        $(".widget_sp_image-description", parentFaq).slideToggle(300);
    });

    $( "ul.products li.product > a img" ).wrap( "<div class='thumb-wrapp'></div>" );

    $(".woocommerce div.product .product_title").wrapInner("<span></span>");

    // $("#menu-sidebar-menu > li").on('click', function () {

    //     var 
    //     $this = $(this),
    //     sub_height = $("> .sub-menu", this).height(),
    //     sub = $("> .sub-menu", this),
    //     djole = 0,
    //     expanded = 5;

    //     $this.find('li, a').not(".load-more-from-list").each(function(index, el) {
    //         if( index < expanded)
    //             djole += $(this).outerHeight();
    //     });

    //     if( $(this).attr( 'data-expanded' ) != '1' ){
    //     	extended = 0;
    //         $this.find(".load-more-from-list").removeClass('top').css('top', 'auto');
    //         $(this).animate({
    //             'height'    : djole
    //         });
    //         $(this).attr( 'data-expanded', '1' );
    //         $this.find(".load-more-from-list").find(".load-more-about-us").removeClass('lf_close');
    //     }
    //     else{

    //         // $this.getNiceScroll().remove();
    //     // if( $this.attr('id') == 'menu-item-738' ){
    //     //     djole += 1;
    //     // }

    //     	extended++;

    //     	$(this).animate({
    //     		'scrollTop' : from_close ? 0 : djole * extended + 15 + 'px'
    //     	}, 500, function(){
    //     		from_close = false;
    //     		if( ( sub_height - ( djole * extended ) ) > djole ){
			 //    	$this.find(".load-more-from-list").animate({
			 //    		"top" 		: djole * (extended + 1) - 37,
			 //    		"botton"	: "initial"
			 //    	}, 1);
    //                 expanded+=5;
		  //   	}
		  //   	else{
    //                 var $view_more = $this.find(".load-more-about-us");
    //                 // $this.niceScroll({horizrailenabled:false});
    //                 $this.css("overflow-y", "scroll");
		  //   		$this.find(".load-more-from-list").animate({
			 //    		"top" 		: sub.outerHeight() + 38 + "px",
			 //    		"botton"	: "initial"
			 //    	}, 1, function(){
    //                     $view_more.addClass('lf_close').html('&#x25B2');
    //                     $view_more.parent().addClass('parent_lf_close');
    //                 });

			 //    	$this.find(".load-more-about-us.lf_close").live( 'click', function(){
    //                     from_close = true;
			 //    		$_this = $(this);
			 //    		$this.animate({
			 //                'height'    : '80px'
			 //            }, function(){
			 //            	$this.animate({
			 //            		'scrollTop'	: 0
			 //            	}, function(){
    //                             $this.css("overflow-y", "hidden");
		  //           			$_this.parent().addClass('top');
    //         					$this.attr( 'data-expanded', '0' );
			 //    				$view_more.removeClass('lf_close').html('&#x25BC;');
    //                             $view_more.parent().removeClass('parent_lf_close');
			 //            	});
			 //            });
			 //    	});
		  //   	}
    //     	});
    //     }
    // });
    //.menu-item-has-children
    // $("#menu-sidebar-menu > li .sub-menu").slideUp(0);

    var title = $(".entry-title > span").text().trim();

    var archive_title = $(".get_this_title").text().trim();

    jQuery("#menu-sidebar-menu li > a").each(function(){
        if( $(this).text().trim() == title || $(this).text().trim() == archive_title){
            $(this).next().slideDown('fast');
            $(this).parents().slideDown();
            $(this).parents('.menu-sidebar-menu-container').addClass('opened-all-menu');
            $(this).addClass('active');
        }
    })
    
    $("#menu-sidebar-menu > li a").on( 'click', function(e){
        $(this).toggleClass('opened');
        if( $(this).attr('href') == undefined || $(this).attr('href') == '#')
            $(this).next().slideToggle(600);
    });

    $(".variations select").chosen({disable_search_threshold: 10});

    $('.product-name').attr('data-title','Product');
    $('.product-price').attr('data-title','Price');
    $('.product-quantity').attr('data-title','Quantity');
    $('.product-subtotal').attr('data-title','Total');

    $(".expand-info-btn").on('click', function(){
        //$(".dropdown-info-menu").hide(0);
        $(this).next().slideToggle();
    });

});
