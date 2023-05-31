// Number input
function getNumber(_str) {
    var arr = _str.split('');
    var out = new Array();
    for (var cnt = 0; cnt < arr.length; cnt++) {
        if (isNaN(arr[cnt]) == false) {
            out.push(arr[cnt]);
        }
    }
    return Number(out.join(''));
}
function updateTextView(_obj) {
    var num = getNumber(_obj.val());
    if (num == 0) {
        _obj.val('');
    } else {
        _obj.val(num.toLocaleString('en-US'));
    }
}
$(document).ready(function () {
    $('#org_price').on('keyup', function () {
        updateTextView($(this));
    });
    $('#sell_price').on('keyup', function () {
        updateTextView($(this));
    });
    $('#child_org_price').on('keyup', function () {
        updateTextView($(this));
    });
    $('#child_sell_price').on('keyup', function () {
        updateTextView($(this));
    });
});

// Ajax
$(document).ready(function () {
    $('#productSubmitForm').click(function (e) {
        e.preventDefault(); // prevent default form submission
        var editorContentData = CKEDITOR.instances.product_content.getData();
        var editorDescData = CKEDITOR.instances.description.getData();
        var form_data = new FormData($('#productForm')[0]); // get form data
        // Append CKEditor data to the form data
        form_data.append('product_content', editorContentData);
        form_data.append('description', editorDescData);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/admin/product/process',
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

// child
$(document).ready(function () {
    $('#productChildSubmitForm').click(function (e) {
        e.preventDefault(); // prevent default form submission

        var form_data = new FormData($('#productChildForm')[0]); // get form data
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/admin/product/child/process',
            type: 'POST',
            data: form_data,
            processData: false,
            contentType: false,
            success: function (response) {
                toastr.success(response.message);
                $('#childList').html(response.html);
            },
            error: function (xhr, status, error) {
                // handle error response here
            }
        });
    });
});
