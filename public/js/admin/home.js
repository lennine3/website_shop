// Web design
$('#saveAboutInfo').on('click', function (e) {
    let id = $(this).attr("data-id");
    id = id.split("_")[1];
    e.preventDefault();
    var form = $('form#aboutInfoForm_' + id);
    var formData = form.serialize(); // serialize form data
    $.ajax({
        type: 'POST', // get HTTP method from form attribute
        url: '/admin/home-section-info', // get form action URL
        data: formData,
        success: function (response) {
            toastr.success(response.message);
            // handle server response
        },
        error: function (xhr, status, error) {
            toastr.error(error);
            // handle errors
        }
    });
});
$('#saveWebDesignInfo').on('click', function (e) {
    let id = $(this).attr("data-id");
    id = id.split("_")[1];
    e.preventDefault();
    var form = $('form#serviceWebDesignInfoForm_' + id);
    var formData = form.serialize(); // serialize form data
    $.ajax({
        type: 'POST', // get HTTP method from form attribute
        url: '/admin/home-section-info', // get form action URL
        data: formData,
        success: function (response) {
            toastr.success(response.message);
            // handle server response
        },
        error: function (xhr, status, error) {
            toastr.error(error);
            // handle errors
        }
    });
});

function serviceProcess(id) {
    var form = $('form#webDesignForm_' + id);
    var formData = form.serialize(); // serialize form data
    $.ajax({
        type: 'POST', // get HTTP method from form attribute
        url: '/admin/home-web-design', // get form action URL
        data: formData,
        success: function (response) {
            toastr.success(response.message);
            // handle server response
        },
        error: function (xhr, status, error) {
            toastr.error(error);
            // handle errors
        }
    });
}
// pricing
$(document).ready(function () {

    var descriptionCounter = parseInt($('#func_count').val()) + 1;

    $("#add-description").click(function () {
        var newField = `
                <div class="col-lg-12 mt-3">
                <div class="form-group">
                    <label for="description_${descriptionCounter}" class="form-label">quyền lợi</label>
                    <input type="text" class="form-control" name="pricing_func[]" id="description_${descriptionCounter}">
                </div>
            </div>
        `;

        $("#description-fields").append(newField);
        descriptionCounter++;
    });
});

$('#pricigTableSubmit').on('submit', function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url: '/admin/process-pricing-table',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            toastr.success(response.message);
            $('#pricigTableSubmit')[0].reset();
            // handle success response
            // Restart the page
            setTimeout(function () {
                window.location.href = response.redirect;
            }, 2000);
        },
        error: function (xhr, status, error) {
            // handle error response
            toastr.error(error);
        }
    });
});

// faq
function benefitProcess(id) {
    var form = $('form#faqQuestionForm' + id);
    var formData = form.serialize(); // serialize form data
    $.ajax({
        type: 'POST', // get HTTP method from form attribute
        url: '/admin/process-faq', // get form action URL
        data: formData,
        success: function (response) {
            // handle server response
            toastr.success(response.message);
            $('#faqQuestionBox').html(response.html)
        },
        error: function (xhr, status, error) {
            toastr.error(error);
            // handle errors
        }
    });
}

$('#faqForm_submit').on('submit', function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url: '/admin/process-faq',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            $('#faqQuestionBox').html(response.html);
            toastr.success(response.message);
            $('#faqForm_submit')[0].reset();
            // handle success response
        },
        error: function (xhr, status, error) {
            // handle error response
            toastr.error(error);
        }
    });
});
