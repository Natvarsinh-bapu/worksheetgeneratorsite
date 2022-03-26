$(document).ready(function(){
        
    // code for get base url
    var baseUrl = window.location.origin;

    // code for sub-concepts datatable
    $(function() {
        var datatable = $('#admin_sub_concepts_table').DataTable({
            processing: true,
            serverSide: true,
            order: [[ 1, 'asc' ]],
            ajax: baseUrl+'/admin/sub-concepts-datatable',
            "columns": [
                {data: 'sub_concept', name: 'sub_concept'},
                {data: 'concept_id', name: 'concept_id'},
                {data: 'category_id', name: 'category_id'},
                {data: 'action', name: 'action'}
            ]
        });
    });

    // code for remove sub-concept
    $(document).on('click', '._remove_sub_concept', function(){
        $('#sub_concept_delete_modal').show();
        $(document).find('#sub_concept_id').val($(this).attr('data-id'));
    });

    $(document).on('click', '.close', function(){
        $('#sub_concept_delete_modal').hide();
    });

    //code for dynamic option in concept
    function get_concepts(category_id, is_for, sub_concept_id){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });

        $.ajax( {
            url: baseUrl+'/admin/get-concepts',
            type: 'POST',
            data: {
                category_id: category_id,
                is_for: is_for,
                sub_concept_id: sub_concept_id
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

                        $(document).find('#admin_concept_for_sub_concept_edit').html(options);
                    } else {
                        $.each(concepts, function(index, val){
                            options += '<option value="'+ val.id +'">'+ val.concept +'</option>';
                        });

                        $(document).find('#admin_concept_for_sub_concept').html(options);
                    }
                }
            },
            error : function() {
                console.log('ERROR');
            }
        });
    };

    var admin_category_for_sub_concept = $(document).find('#admin_category_for_sub_concept');
    if(admin_category_for_sub_concept.length > 0){
        get_concepts(admin_category_for_sub_concept.val(), 'add', 0) //call function
    }

    $(document).on('change', '#admin_category_for_sub_concept', function(){
        get_concepts($(this).val(), 'add', 0) //call function
    });

    var admin_category_for_sub_concept_edit = $(document).find('#admin_category_for_sub_concept_edit');
    if(admin_category_for_sub_concept_edit.length > 0){
        var sub_concept_id = $(document).find('#edit_sub_concept_span').attr('data-id');
        get_concepts(admin_category_for_sub_concept_edit.val(), 'edit', sub_concept_id) //call function
    }

    $(document).on('change', '#admin_category_for_sub_concept_edit', function(){
        var sub_concept_id = $(document).find('#edit_sub_concept_span').attr('data-id');
        get_concepts(admin_category_for_sub_concept_edit.val(), 'edit', sub_concept_id) //call function
    });
});