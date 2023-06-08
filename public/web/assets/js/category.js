var countProduct = $("#countProduct").val();
for (let index = 0; index < countProduct; index++) {
    let owl = $('.owlProduct_' + index);
    owl.owlCarousel({
        loop: true,
        margin: 0,
        nav: false,
        mouseDrag:false,
        smartSpeed: 500, // Set the animation speed to 500 milliseconds
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });
    owl.on('mouseenter', function () {
        $(this).trigger('to.owl.carousel', 1);
    }).on('mouseleave', function () {
        $(this).trigger('to.owl.carousel', 0);
    });
}
