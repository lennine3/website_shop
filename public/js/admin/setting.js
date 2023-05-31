$(document).ready(function () {
    // listen for click event on button
    $('#submitForm').click(function (e) {
        e.preventDefault(); // prevent default form submission
        var form_data = new FormData($('#formSetting')[0]); // get form data
        console.log(form_data);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/admin/setting/process',
            type: 'POST',
            data: form_data,
            processData: false,
            contentType: false,
            success: function (response) {
                toastr.success(response.message);
                // handle success response here
            },
            error: function (xhr, status, error) {
                // handle error response here
            }
        });
    });
});

$(document).ready(function () {
    $('#shopLogo').change(function () {
        var input = this;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(input).closest('.position-relative').find('.logoImgContain img').attr('src', e
                    .target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    });
    $('#shopFavicon').change(function () {
        var input = this;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(input).closest('.position-relative').find('.favIconContain img').attr('src', e
                    .target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    });
});
