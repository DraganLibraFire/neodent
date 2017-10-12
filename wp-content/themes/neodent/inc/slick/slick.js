jQuery( document ).ready(function($) {
    $('[href="#gallery"]').on('shown.bs.tab', function (e) {
        $('.gallery').resize();
    });


    if( $("#tabs #three .list-of-woocommerce-products").length > 3){

        $('#tabs #three .products').slick({
            rows: 2,
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            dots: false,
            adaptiveHeight: true,
            focusOnSelect: true,
            centerMode: false,
            arrows: true,
            prevArrow: '<i class="fa fa-angle-left" aria-hidden="true"></i>',
            nextArrow: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
            responsive: [
                {
                    breakpoint: 800,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        rows: 1
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        rows: 1
                    }
                }
            ]
        });

    }
    $('#tabs #two .products, #tabs #one .list-of-woocommerce-products').slick({
        rows: 2,
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false,
        adaptiveHeight: true,
        focusOnSelect: true,
        centerMode: false,
        arrows: true,
        prevArrow: '<i class="fa fa-angle-left" aria-hidden="true"></i>',
        nextArrow: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
        responsive: [
            {
                breakpoint: 800,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    rows: 1
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    rows: 1
                }
            }
        ]
    });


    $('.products-related ul').slick({
        rows: 1,
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false,
        adaptiveHeight: true,
        focusOnSelect: true,
        centerMode: false,
        arrows: true,
        prevArrow: '<i class="fa fa-angle-left" aria-hidden="true"></i>',
        nextArrow: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
        responsive: [
            {
                breakpoint: 670,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    rows: 1
                }
            },
            {
                breakpoint: 450,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    rows: 1
                }
            }
        ]
    });

    $(".testimonial-slider").slick({
        rows: 1,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        adaptiveHeight: false,
        focusOnSelect: false,
        centerMode: false,
        prevArrow: '<i class="fa fa-angle-left" aria-hidden="true"></i>',
        nextArrow: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
        arrows: true,
        responsive: [
            {
                breakpoint: 550,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: true,
                    arrows: false,
                }
            },
            {
                breakpoint: 330,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: true,
                    arrows: false,
                }
            }
        ]
    })
});