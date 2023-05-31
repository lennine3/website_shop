const container = document.querySelector('.pricingContainer');
const showMoreBtn = document.getElementById('show-more');

showMoreBtn.addEventListener('click', function () {
    $('#pricingHid_3').toggleClass('hidden');
    $('#pricingHid_4').toggleClass('hidden');
    $('#pricingHid_5').toggleClass('hidden');
    $('#show-more').toggleClass('open');
    if ($('#show-more').hasClass('open')) {
        $('#show-more').text('Thu gọn bảng giá')
    } else {
        $('#show-more').text('Xem thêm bảng giá')
    }
    // container.classList.toggle('hidden');
    // if (container.classList.contains('open')) {
    //     container.style.maxHeight = container.scrollHeight + "px";
    // } else {
    //     container.style.maxHeight = "700px";
    // }
});
$(document).ready(function () {
    $('.blog-slider').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        slidesMargin: 30,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 5000,
        responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                infinite: true,
                dots: true
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
        ]
    });
});

$(document).ready(function () {
    // Bind a submit event handler to the form
    $('#formContact').submit(function (event) {
        // Prevent the default form submission behavior
        event.preventDefault();

        // Serialize the form data into a query string
        var formData = $(this).serialize();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Send an AJAX request to the server
        $.ajax({
            url: '/process-contact',
            method: 'POST',
            data: formData,
            success: function (response) {
                // console.log(response);
                // Handle a successful response from the server
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').text('');
                if (response.errors) {

                    $.each(response.errors, function (key, error) {
                        $('#' + key + '-required').addClass('hidden');
                        $('#' + key + '-Input').addClass(
                            'is-invalid is-invalid-input');
                        $('#' + key + '-error').text(error[0]);
                    });
                } else {
                    if (response.message == 'success') {
                        $('#success_modal').modal('show');
                        setTimeout(function () {
                            $('#success_modal').modal('hide');
                        }, 3000);

                        $("#formContact")[0].reset();
                    } else if (response.message == 'errors') {
                        $('#errors_modal').modal('show');
                        setTimeout(function () {
                            $('#errors_modal').modal('hide');
                        }, 3000);
                    }

                }
            },
            error: function (xhr, status, error) {
                // Handle an error response from the server
                $('#errors_modal').modal('show');
            }
        });
    });
});
