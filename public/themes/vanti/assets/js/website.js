$(function()
{
    $('.owl-carousel').owlCarousel({
        nav: true,
        items: 1,
        loop: true,
        autoplay: 7000,
        lazyLoad : true,
        autoplayHoverPause: true,
        navText: [
            '<span class="glyphicon glyphicon-menu-left"></span>',
            '<span class="glyphicon glyphicon-menu-right"></span>'
        ]
    });
})
