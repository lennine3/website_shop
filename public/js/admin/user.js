// Avatar preview
const avatarUpload = document.getElementById("avatar-upload");
const avatarPreview = document.getElementById("avatar-preview");

avatarUpload.addEventListener("change", () => {
    const file = avatarUpload.files[0];

    if (file) {
        const reader = new FileReader();

        reader.addEventListener("load", () => {
            avatarPreview.setAttribute("src", reader.result);
        });

        reader.readAsDataURL(file);
    } else {
        avatarPreview.setAttribute("src", "");
    }
});

// feather Icon
feather.replace();

// Tom select
new TomSelect("#status-user", {});
new TomSelect("#sex-user", {});

// Password Ajax
$(document).ready(function () {
    // Bind a submit event handler to the form
    $('#userPasswordProcess').submit(function (event) {
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
            success: function (response) {
                if (response.success) {
                    toastr.success(response.message);
                    $("#userPasswordProcess")[0].reset();
                } else {
                    // Show error message using Snackbar
                    error.success(response.errors.password[0]);
                }
            },
            error: function (response) {
                // Show error message using Snackbar
                Snackbar.show({
                    text: 'An error occurred while processing your request.',
                    pos: 'top-right',
                    showAction: false,
                    duration: 3000
                });
            }
        });
    });
});

// permission user
$('.form-permission-change').on('change', function () {
    var userId = $('#userIdPermission').val();

    var permissionId = $(this).attr('data-id');
    var isChecked = $(this).is(':checked');
    console.log(isChecked);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/admin/users/setting/' + userId + '/permissions/' + permissionId,
        type: 'POST',
        data: {
            isChecked: isChecked // pass as key-value pair
        },
        success: function (response) {
            if (response.success) {
                toastr.success(response.message);
            } else {
                error.success(response.message);
            }
        },
        error: function (xhr, status, error) {
            error.success(xhr.responseText);
            console.log(xhr.responseText);
        }
    });
});
