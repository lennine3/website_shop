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

function updateChildProduct(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/admin/product/child/' + id + '/edit',
        type: 'GET',
        processData: false,
        contentType: false,
        success: function (response) {
            $('#childForm').html(response.html)
            // toastr.success(response.message);
        },
        error: function (xhr, status, error) {
            // handle error response here
        }
    });
}

var countFeature = $("#featureCount").val();
for (let index = 0; index < countFeature; index++) {
    new TomSelect("#feature-select_" + index, {});
}

var countFeature = $("#featureChildCount").val();
for (let index = 0; index < countFeature; index++) {
    new TomSelect("#feature-child-select_" + index, {});
}

CKEDITOR.replace("product_content", {
    filebrowserBrowseUrl: "public/third/filemanager/dialog.php?type=2&editor=ckeditor&fldr=",
    filebrowserImageBrowseUrl: "public/third/filemanager/dialog.php?type=1&editor=ckeditor&fldr=",
    disallowedContent: "img{width,height}[width, height];",
    global_xss_fitering: !1,
    allowedContent: !0,
});
CKEDITOR.replace("description", {
    filebrowserBrowseUrl: "public/third/filemanager/dialog.php?type=2&editor=ckeditor&fldr=",
    filebrowserImageBrowseUrl: "public/third/filemanager/dialog.php?type=1&editor=ckeditor&fldr=",
    disallowedContent: "img{width,height}[width, height];",
    global_xss_fitering: !1,
    allowedContent: !0,
});
new TomSelect("#cate-select", {});
new TomSelect("#status-select", {});
new TomSelect("#child-status-select", {});

// Drop Zone

var productDropzone = new Dropzone("#productDropzone", {
    url: "/admin/product/drop-zone/process",
    autoProcessQueue: false,
    maxFilesize: 5,
    parallelUploads: 5,
    previewsContainer: "#productPreviewTemplate",
    previewTemplate: document.querySelector("#myPreviewTemplate").innerHTML,
    acceptedFiles: ".jpeg,.jpg,.png,.gif",
    autoDiscover: false,
    clickable: '#chooseButton',
    addRemoveLinks: false,

    init: function () {
        var dzInstance = this;
        dzInstance.on("addedfile", function (file) {
            $('#productImageSubmitForm').show();
            $('#removeAllButton').show();
        });
        document.querySelector("#productImageSubmitForm").addEventListener("click", function (e) {
            e.preventDefault();
            dzInstance.processQueue();
        });

    }
});
productDropzone.on("success", function (file, response) {
    $('#tr_body').html(response.html);
    toastr.success(response.message);
    removeImage();
});

$("#removeAllButton").on("click", function () {
    removeImage();
});

function removeImage() {
    var myDropzone = Dropzone.forElement("#productDropzone");
    myDropzone.removeAllFiles();
    $('#productImageSubmitForm').hide();
    $('#removeAllButton').hide();
}

// Img list
$(function () {
    $("#tbl_product_images tbody").sortable({
        axis: 'y',
        stop: function (event, ui) {
            var sortedData = [];
            $("#tbl_product_images tbody tr").each(function (index) {
                var id = $(this).attr('id');
                var priority = index + 1;
                sortedData.push([id, priority]);
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/admin/product/drop-zone/sort',
                type: 'POST',
                data: JSON.stringify(sortedData),
                processData: false,
                contentType: 'application/json',
                success: function (response) {
                    toastr.success(response.message);
                },
                error: function (xhr, status, error) {
                    // handle error response here
                }
            });
        }
    });
    $("#tbl_product_images").on("click", "#delete-button", function () {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                var tableRow = $(this).closest(".table_tr");
                var rowId = tableRow.data("row-id");
                var data = {
                    rowId: rowId
                };
                tableRow.remove();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/admin/product/drop-zone/delete',
                    type: 'POST',
                    data: JSON.stringify(data),
                    processData: false,
                    contentType: 'application/json',
                    success: function (response) {
                        Swal.fire(
                            'Deleted!',
                            response.message,
                            'success'
                        )
                    },
                    error: function (xhr, status, error) {
                        // handle error response here
                    }
                });

            }
        })
    });
});
