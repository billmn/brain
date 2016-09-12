$(function()
{
    // Top menu
    // -------------------------------------------------------
    $('.navbar-fixed-top a[href*="#"]').on('click', function(e) {
        e.preventDefault();

        var navbar = $('.navbar-fixed-top');
        var target = $($(this).attr('href'));

        $('html, body').animate({
            scrollTop: target.offset().top - navbar.outerHeight()
        }, 1000);
    });

    // Table wrapper
    // -------------------------------------------------------
    $('.page-content table').addClass('table table-bordered table-striped').wrap('<div class="table-responsive" />');

    // Home slider
    // -------------------------------------------------------
    $('.home-slider').owlCarousel({
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

    // Gallery
    // -------------------------------------------------------
    $('.gallery').owlCarousel({
        nav: true,
        items: 3,
        slideBy: 'page',
        navText: [
            '<span class="glyphicon glyphicon-menu-left"></span>',
            '<span class="glyphicon glyphicon-menu-right"></span>'
        ]
    });
})
