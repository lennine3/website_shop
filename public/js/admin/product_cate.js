const avatarUpload = document.getElementById("avatar-category-upload");
const avatarPreview = document.getElementById("image-category-preview");

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


$(document).ready(function () {
    // listen for click event on button
    $('#submitForm').click(function (e) {
        e.preventDefault(); // prevent default form submission
        var form_data = new FormData($('#productCateForm')[0]); // get form data
        console.log(form_data);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/admin/product/category/process',
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
