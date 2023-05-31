$(document).ready(function() {
    // Bind a submit event handler to the form
    $('#roleStore').submit(function(event) {
        // Prevent the default form submission behavior
        event.preventDefault();

        // Serialize the form data into a query string
        var formData = $(this).serialize();
        var url = $(this).data('url');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Send an AJAX request to the server
        $.ajax({
            url: url,
            method: 'POST',
            data: formData,
            success: function(response) {
                toastr.success(response.message);
                $("#roleStore")[0].reset();
            },
            error: function(response) {
                // Show error message using Snackbar
                error.success(response.message);
            }
        });
    });
});
