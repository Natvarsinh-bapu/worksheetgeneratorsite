// code for remove alert message after 5 seconds
$(document).ready(function () {
    var alert_exist = $(document).find('.alert').length;
    if (alert_exist > 0) {
        $('.alert').delay(4000).fadeOut();
    }

    //custom messages
    window.custom_alert = function (message, type) {
        if (type == 'success') {
            $(document).find('#custom_alerts').append(
                '<div class="alert alert-success alert-dismissible" role="alert">' +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                '<i class="fa fa-check-circle"></i>' +
                '<span style="margin-left:10px;">' + message + '</span>' +
                '</div>'
            );
        } else {
            $(document).find('#custom_alerts').append(
                '<div class="alert alert-danger alert-dismissible" role="alert">' +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                '<i class="fa fa-times-circle"></i>' +
                '<span style="margin-left:10px;">' + message + '</span>' +
                '</div>'
            );
        }

        $(document).scrollTop(0);

        setTimeout(function () {
            $('.alert').delay(4000).fadeOut();
        }, 1000);
    }
});

require('../js/superadmin/categories');
require('../js/superadmin/concepts');
require('../js/superadmin/types');
require('../js/superadmin/sub_concept');
require('../js/superadmin/generate_worksheet');
require('../js/superadmin/admins');