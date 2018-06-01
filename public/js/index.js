(function ($) {

    // Carousel

    $(".owl-carousel").owlCarousel({
        items:1,
        loop:true,
        animateOut: 'slideOutLeft',
        animateIn: 'slideInRight',
        navigation : false,
        slideSpeed : 500,
        paginationSpeed : 800
    });

})(jQuery);