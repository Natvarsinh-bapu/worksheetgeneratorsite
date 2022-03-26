// code for remove alert message after 5 seconds
$(document).ready(function(){
    var alert_exist = $(document).find('.alert').length;
    if(alert_exist > 0){
        $('.alert').delay(4000).fadeOut();
    }
});

require('../js/institute/categories');
require('../js/institute/concepts');
require('../js/institute/types');
require('../js/institute/sub_concept');
require('../js/institute/questions');
require('../js/institute/profile');
require('../js/institute/class');
require('../js/institute/teachers');
require('../js/institute/students');