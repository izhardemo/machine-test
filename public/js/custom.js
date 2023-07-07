// create slug
function createSlug(e) {
    var str = e.value;
    str = str.replace(/\W+(?!$)/g, '-').toLowerCase();//replace stapces with dash
    document.querySelector('input[data-slug="slug"]').value = str;
}

// Delete data with sweetalert
function deleteConfirm(event) {
    event.preventDefault();
    // Don't change deleteNav value
    var deleteNav = event.currentTarget.firstElementChild;
    Swal.fire({
        title: 'Are you sure you want to delete?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        showClass: {
            popup: 'swal2-show',
            backdrop: 'swal2-backdrop-show',
            icon: 'swal2-icon-show'
          },
        hideClass: {
            popup: 'swal2-hide',
            backdrop: 'swal2-backdrop-hide',
            icon: 'swal2-icon-hide'
          }
    }).then((result) => {
        if (result.isConfirmed) {
            deleteNav.submit();
            // console.log(deleteNav);
        }
    });
}

//check all checkboxes
var checkboxes = document.querySelectorAll('input[type="checkbox"]');
var x = document.querySelector('#checkall');

function checkAll(val) {
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != val) {
            checkboxes[i].checked = val.checked;
            $('.btn-table-delete').show();
        } else {
            $('.btn-table-delete').hide();
        }
    }
    if (x.checked == true) {
        $('.btn-table-delete').show();
    } else {
        $('.btn-table-delete').hide();
    }
}

function check(val) {
    var checkbox = document.querySelectorAll('.checkbox:checked');

    if (checkbox.length > 0) {
        $('#checkall').prop('indeterminate', true);
        $('.btn-table-delete').show();
    } else {
        $('#checkall').prop('indeterminate', false);
        $('.btn-table-delete').hide();
    }

    if (val.checked == true) {
        if (checkbox.length + 1 == checkboxes.length) {
            $('#checkall').prop('indeterminate', false);
            x.checked = true;
        }
    } else {
        x.checked = false;
    }
}

// tinymce
var directionality = "ltr";

function init_tinymce(selector, min_height) {
    var menu_bar = 'file edit view insert format tools table help';
    if (selector == 'textarea.tinyMCEQuiz' || selector == 'textarea#basic-example') {
        menu_bar = false;
    }
    tinymce.init({
        selector: selector,
        height: min_height,
        valid_elements: '*[*]',
        relative_urls: false,
        remove_script_host: false,
        directionality: directionality,
        language: 'en',
        menubar: menu_bar,
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code codesample fullscreen",
            "insertdatetime media table paste imagetools help wordcount"
        ],
        toolbar: 'undo redo | formatselect | fullscreen code preview | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | numlist bullist | forecolor backcolor removeformat | image media link | outdent indent | help',
        content_css: ['../../assets/plugins/tinymce/editor_content.css'],
    });
    tinymce.DOM.loadCSS('../../assets/plugins/tinymce/editor_ui.css');
}

if ($('textarea.tinyMCEsmall').length > 0) {
    init_tinymce('textarea.tinyMCEsmall', 300);
}

/* Notification*/
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    showClass: {
        popup: 'swal2-show',
        backdrop: 'swal2-backdrop-show',
        icon: 'swal2-icon-show'
    },
    hideClass: {
        popup: 'swal2-hide',
        backdrop: 'swal2-backdrop-hide',
        icon: 'swal2-icon-hide'
    },
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    },
    width: '26rem',
});

/* Rounded corners Notifications */
function info_noti(message) {
    Toast.fire({
        icon: 'info',
        text: message,
    });
}

function warning_noti(message) {
    Toast.fire({
        icon: 'warning',
        text: message,
    });
}

function error_noti(message) {
    Toast.fire({
        icon: 'error',
        text: message,
    });
}

function success_noti(message) {
    Toast.fire({
        icon: 'success',
        text: message,
    });
}