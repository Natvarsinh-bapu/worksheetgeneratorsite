$(document).ready(function(){

    $(document).on('change', '#profile_pic_upload', function(e){
        var extension_array = ['png', 'jpg', 'jpeg', 'gif'];
        var filename = e.target.files[0].name;
        var extension = filename.substr(filename.lastIndexOf('.') + 1);

        if($.inArray(extension, extension_array) != -1){
            $(document).find('#profile_pic_form').submit();
        } else {
            $(document).find('#file_upload_error').html('Please select file with valid extension');
        }
    });

    //update admin details
    $(document).on('click', '#edit_profile', function(){
        $(this).hide();
        $(document).find('._back_btn').hide();
        $(document).find('#update_profile').show();
        $(document).find('#cancel_profile').show();

        $('._profile_field').each(function() {
            $( this ).show();    
        });
        $('._profile_label').each(function() {
            $( this ).hide();    
        });
    });

    $(document).on('click', '#cancel_profile', function(){
        $(this).hide();
        $(document).find('._back_btn').show();
        $(document).find('#update_profile').hide();
        $(document).find('#edit_profile').show();

        $('._profile_field').each(function() {
            $( this ).hide();    
        });
        $('._profile_label').each(function() {
            $( this ).show();    
        });
    });

    //submit form
    $(document).on('submit', '#profile_form', function(){
        var name = $(document).find('#profile_name').val();
        var phone = $(document).find('#profile_phone').val();

        $(document).find('._error_message_name').remove();
        $(document).find('._error_message_phone').remove();
        
        if(name == ''){
            $(document).find('#profile_name').after('<br><span class="_error_message_name" style="color:red;">Please enter name</span>');
            return false;
        }

        if(phone == ''){
            $(document).find('#profile_phone').after('<br><span class="_error_message_phone" style="color:red;">Please enter phone</span>');
            return false;
        }

        return true;
    });
});