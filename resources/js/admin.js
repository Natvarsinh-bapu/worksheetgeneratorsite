// code for remove alert message after 5 seconds
$(document).ready(function () {
    var alert_exist = $(document).find('.alert').length;
    if (alert_exist > 0) {
        $('.alert').delay(4000).fadeOut();
    }
});

require('../js/admin/categories');
require('../js/admin/concepts');
require('../js/admin/types');
require('../js/admin/sub_concept');
require('../js/admin/questions');
require('../js/admin/profile');
require('../js/admin/dashboard');
require('../js/admin/institutes');