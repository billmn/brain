$(function()
{
    $('.navbar-fixed-top a[href*="#"]').on('click', function(e) {
        e.preventDefault();

        console.log($(this).attr('href'));

        var navbar = $('.navbar-fixed-top');
        var target = $($(this).attr('href'));

        $('html, body').animate({
            scrollTop: target.offset().top - navbar.outerHeight()
        }, 1000);
    });

    $('.page-content table').addClass('table table-bordered table-striped').wrap('<div class="table-responsive" />');

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
