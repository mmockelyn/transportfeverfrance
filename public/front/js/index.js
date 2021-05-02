$(document).ready(function(){
    $(".owl-carousel").owlCarousel({
        items: 1,
        responsiveClass: true,
        margin:0,
        loop: true,
        autoHeight: true,
        nav: true,
        autoplay:true,
        autoplayTimeout:5500,
        autoplayHoverPause:true,
        navText: [
            "<i class='fa fa-caret-left'></i>",
            "<i class='fa fa-caret-right'></i>"
        ],
    });
});
