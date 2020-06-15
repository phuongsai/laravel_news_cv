var SITEURL = window.location.origin;
$(document).ready(function () {
    $('body').on('click', '#submit_subscriber', function (event) {
        event.preventDefault();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            data: $('#newsletter_form').serialize(),
            url: SITEURL + '/subscriber' + '?_token=' + '{{ csrf_token() }}',
            type: 'POST',
            dataType: "json",
            success: function (data) {
                if (data.errors) {
                    $.msgNotification("error", data);
                } else {
                    $("#newsletter_form").val('');
                    $.msgNotification("success", data);
                }
            },
            error: function (data) {
                var validateErrors = data.responseJSON.errors;
                $.msgNotification("error", validateErrors.email);
            }
        });
    });
});

/* Capitalize first letter for Toast Nofitication*/
$(function () {
    $.jsUcFirst = function (string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    };
});

/* Toast Nofitication*/
$(function () {
    $.msgNotification = function (msgType, msgText) {
        switch (msgType) {
            case "error":
                return iziToast.error({
                    title: $.jsUcFirst(msgType),
                    message: msgText,
                    position: 'topRight'
                });
                break;
            case "success":
                return iziToast.success({
                    title: $.jsUcFirst(msgType),
                    message: msgText,
                    position: 'topRight'
                });
                break;
            case "warning":
                return iziToast.warning({
                    title: $.jsUcFirst(msgType),
                    message: msgText,
                    position: 'topRight'
                });
                break;

            default:
                return iziToast.info({
                    title: $.jsUcFirst(msgType),
                    message: msgText,
                    position: 'topRight'
                });
                break;
        }
    };
});