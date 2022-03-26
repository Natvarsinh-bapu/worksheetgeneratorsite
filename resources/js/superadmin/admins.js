$(document).ready(function(){

    // code for get base url
    var baseUrl = window.location.origin;

    // code for admins datatable
    $(function() {
        var datatable = $('#superadmin_admins_table').DataTable({
            processing: true,
            serverSide: true,
            order: [[ 1, 'asc' ]],
            ajax: baseUrl+'/superadmin/admins-datatable',
            "columns": [
                {data: 'name', name: 'name'},
                {data: 'status', name: 'status'},
                {data: 'is_verified', name: 'is_verified'},
                {data: 'category_access', name: 'category_access'},
                {data: 'action', name: 'action'}
            ]
        });
    });

    // code for remove admin
    $(document).on('click', '._remove_admin', function(){
        $('#admin_delete_modal').show();
        $(document).find('#admin_id').val($(this).attr('data-id'));
    });

    $(document).on('click', '.close', function(){
        $('#admin_delete_modal').hide();
    });

    //change the status of admin
    $(document).on('change', '#status_admin_select', function(){
        var status = $(this).val();

        var admin_id = $(document).find('#admin_id_span').html();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });

        $.ajax( {
            url: baseUrl+'/superadmin/change-admin-status',
            type: 'POST',
            data: {
                status: status,
                admin_id: admin_id
            },
            cache: false,
            success: function (data) {
                if(data.success){
                    custom_alert(data.message, 'success'); //global function called   
                } else {
                    $(document).find('#status_admin_select').val(0);
                    custom_alert(data.message, 'error'); //global function called
                }
            },
            error : function() {
                console.log('ERROR');
            }
        });
    });
    
    /**---------------------------------------------------------------
     * CODE FOR CATEGORIES ACCESS 
     -----------------------------------------------------------------*/
    $(document).on('change', '._category_checkbox', function(){
        
        var checkox = $(this);

        var status = 0;
        if(checkox.prop('checked')){
            status = 1;
        }

        var category_id = $(this).val();
        var admin_id = $(document).find('#admin_id').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });

        $.ajax( {
            url: baseUrl+'/superadmin/access-category-status',
            type: 'POST',
            data: {
                status: status,
                admin_id: admin_id,
                category_id: category_id
            },
            cache: false,
            success: function (data) {
                if(data.success){

                    if(status == 1){
                        checkox.parent().removeClass('access-danger');
                        checkox.parent().addClass('access-success');
                    } else {
                        checkox.parent().removeClass('access-success');
                        checkox.parent().addClass('access-danger');
                    }

                    custom_alert(data.message, 'success'); //global function called   
                } else {
                    custom_alert(data.message, 'error'); //global function called
                }
            },
            error : function() {
                console.log('ERROR');
            }
        });        
    });

    //display message if user is not verified email then no access to access category button
    $(document).on('click', '._no_access_category', function(){
        custom_alert("User email not verified, So you can't give access of categories", 'error'); //global function called
    });

    //if not requested category 
    $(document).on('click', '._not_requested_category', function(){

        $(this).parent().remove();
        
        var status = 0;
        if($(this).prop('checked')){
            status = 1;
        }

        var category_id = $(this).val();
        var category_name = $(this).attr('data-name');
        var admin_id = $(document).find('#admin_id').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });

        $.ajax( {
            url: baseUrl+'/superadmin/access-category-status',
            type: 'POST',
            data: {
                status: status,
                admin_id: admin_id,
                category_id: category_id
            },
            cache: false,
            success: function (data) {
                if(data.success){

                    $(document).find('#accessable_category_div').append(
                        '<div class="col-md-2 access-success" style="margin-top:10px;">'+
                            '<input id="category_chbx_'+ category_id +'" type="checkbox" class="_category_checkbox category-access-checkbox" name="category" value="'+ category_id +'" checked>'+
                            '<label for="category_chbx_'+ category_id +'" style="font-size:16px;cursor:pointer;">'+ category_name +'</label>'+
                        '</div>'
                    );
            
                    custom_alert(data.message, 'success'); //global function called   
                } else {
                    custom_alert(data.message, 'error'); //global function called
                }
            },
            error : function() {
                console.log('ERROR');
            }
        });
    });

    //select all categories
    $(document).on('change', '#select_all_categories', function(){
        var checked = $(this).prop('checked');

        if(checked){
            $(document).find('._category_add').prop('checked', true);
        } else {
            $(document).find('._category_add').prop('checked', false);
        }
    });

    //check all selected
    $(document).on('change', '._category_add', function(){
        var unchecked_count = 0;

        $(document).find('._category_add').each(function(){
            if(!$(this).prop('checked')){
                unchecked_count++;
            }
        });

        if(unchecked_count < 1){            
            $(document).find('#select_all_categories').prop('checked', true);
        } else {
            $(document).find('#select_all_categories').prop('checked', false);
        }
    });
});