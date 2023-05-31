$(document).ready(function () {
    // listen for click event on button
    $('#submitForm').click(function (e) {
        e.preventDefault(); // prevent default form submission
        var form_data = new FormData($('#blogCateForm')[0]); // get form data
        console.log(form_data);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/admin/blog/category/process',
            type: 'POST',
            data: form_data,
            processData: false,
            contentType: false,
            success: function (response) {
                toastr.success(response.message);
            },
            error: function (xhr, status, error) {
                // handle error response here
            }
        });
    });
});
