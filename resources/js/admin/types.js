$(document).ready(function(){

    // code for get base url
    var baseUrl = window.location.origin;

    // code for types datatable
    $(function() {
        var datatable = $('#admin_types_table').DataTable({
            processing: true,
            serverSide: true,
            order: [[ 1, 'asc' ]],
            ajax: baseUrl+'/admin/types-datatable',
            "columns": [
                {data: 'type', name: 'type'},
                {data: 'sub_concept_id', name: 'sub_concept_id'},
                {data: 'concept_id', name: 'concept_id'},
                {data: 'category_id', name: 'category_id'},
                {data: 'action', name: 'action'}
            ]
        });
    });

    // code for remove type
    $(document).on('click', '._remove_type', function(){
        $('#type_delete_modal').show();
        $(document).find('#type_id').val($(this).attr('data-id'));
    });

    $(document).on('click', '.close', function(){
        $('#type_delete_modal').hide();
    });

    //code for dynamic option in concept based on category
    function get_concepts_for_type(category_id, is_for, type_id){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });

        $.ajax( {
            url: baseUrl+'/admin/get-concepts-for-types',
            type: 'POST',
            data: {
                category_id: category_id,
                is_for: is_for,
                type_id: type_id
            },
            cache: false,
            success: function (data) {
                if(data.success){
                    var concepts = data.concepts;

                    var options = '';

                    if(is_for == 'edit'){
                        $.each(concepts, function(index, val){
                            if(data.selected_concept == val.id){
                                options += '<option value="'+ val.id +'" selected>'+ val.concept +'</option>';
                            } else {
                                options += '<option value="'+ val.id +'">'+ val.concept +'</option>';
                            }
                        });

                        var admin_concept_edit_for_type = $(document).find('#admin_concept_edit_for_type');

                        admin_concept_edit_for_type.html(options)
                        var concept_id = admin_concept_edit_for_type.val();
                        var type_id = $(document).find('#edit_type_span').attr('data-id');

                        get_sub_concepts_for_type(concept_id, 'edit', type_id); //call function
                    } else {
                        $.each(concepts, function(index, val){
                            options += '<option value="'+ val.id +'">'+ val.concept +'</option>';
                        });

                        var admin_concept_for_type = $(document).find('#admin_concept_for_type');

                        admin_concept_for_type.html(options)
                        var concept_id = admin_concept_for_type.val();

                        get_sub_concepts_for_type(concept_id, 'add', 0); //call function
                    }
                }
            },
            error : function() {
                console.log('ERROR');
            }
        });
    };

    var admin_category_for_type = $(document).find('#admin_category_for_type');
    if(admin_category_for_type.length > 0){
        get_concepts_for_type(admin_category_for_type.val(), 'add', 0) //call function
    }

    $(document).on('change', '#admin_category_for_type', function(){
        get_concepts_for_type($(this).val(), 'add', 0) //call function
    });

    var admin_category_edit_for_type = $(document).find('#admin_category_edit_for_type');
    if(admin_category_edit_for_type.length > 0){
        var type_id = $(document).find('#edit_type_span').attr('data-id');
        get_concepts_for_type(admin_category_edit_for_type.val(), 'edit', type_id) //call function
    }

    $(document).on('change', '#admin_category_edit_for_type', function(){
        var type_id = $(document).find('#edit_type_span').attr('data-id');
        get_concepts_for_type($(this).val(), 'edit', type_id) //call function
    }); 

    //code for dynamic option in sub concept based on concept
    function get_sub_concepts_for_type(concept_id, is_for, type_id){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });

        $.ajax( {
            url: baseUrl+'/admin/get-sub-concepts-for-types',
            type: 'POST',
            data: {
                concept_id: concept_id,
                is_for: is_for,
                type_id: type_id
            },
            cache: false,
            success: function (data) {
                if(data.success){
                    var sub_concepts = data.sub_concepts;

                    var options = '';

                    if(is_for == 'edit'){
                        $.each(sub_concepts, function(index, val){
                            if(data.selected_sub_concept == val.id){
                                options += '<option value="'+ val.id +'" selected>'+ val.sub_concept +'</option>';
                            } else {
                                options += '<option value="'+ val.id +'">'+ val.sub_concept +'</option>';
                            }
                        });

                        $(document).find('#admin_sub_concept_edit_for_type').html(options);
                    } else {
                        $.each(sub_concepts, function(index, val){
                            options += '<option value="'+ val.id +'">'+ val.sub_concept +'</option>';
                        });

                        $(document).find('#admin_sub_concept_for_type').html(options);
                    }
                }
            },
            error : function() {
                console.log('ERROR');
            }
        });
    };

    $(document).on('change', '#admin_concept_for_type', function(){
        get_sub_concepts_for_type($(this).val(), 'add', 0) //call function
    });

    $(document).on('change', '#admin_concept_edit_for_type', function(){
        var type_id = $(document).find('#edit_type_span').attr('data-id');
        get_sub_concepts_for_type($(this).val(), 'edit', type_id) //call function
    });

    
    /**
     * code for save types 
     */
    $(document).on('click', '#save_types', function () {
        $(document).find('#admin_types_form').submit();
    });

    $(document).on('click', '._remove_type_image', function () {

        var data_id = $(this).attr('data-id');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: baseUrl + '/admin/delete-type-image',
            type: 'POST',
            data: {
                id: data_id
            },
            cache: false,
            success: function (response) {
                if (response.success) {
                    $(document).find('._parent_type_' + data_id).remove();
                }
            },
            error: function () {
                console.log('ERROR');
            }
        });
    });

    //REMOVE ADDED IMAGE IN ADD
    $(document).on('click', '._remove_type_image', function () {
        var div_id = $(this).attr('data-id');

        $(document).find('.' + div_id).remove();
    });
});