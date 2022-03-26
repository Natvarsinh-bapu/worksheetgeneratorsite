$(document).ready(function(){
    
    //copy to clipboard
    $(document).on('click', '#copy_link', function(){        
        var copyText = $(document).find("#shared_link_div").html();

        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($.trim(copyText)).select();
        document.execCommand("copy");
        $temp.remove();

        $(document).find('#alert_div').append(
            '<div class="alert alert-success" role="alert">'+
                'Link copied!'+
            '</div>'
        );
        $('.alert').delay(4000).fadeOut();
    });
});