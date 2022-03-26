$(document).ready(function(){

    // code for get base url
    var baseUrl = window.location.origin;

    // code for questions datatable
    $(function() {
        var datatable = $('#admin_questions_table').DataTable({
            processing: true,
            serverSide: true,
            order: [[ 1, 'asc' ]],
            ajax: baseUrl+'/admin/questions-datatable',
            "columns": [
                {data: 'question', name: 'question'},
                {data: 'medium_id', name: 'medium_id'},
                {data: 'question_file', name: 'question_file'},
                {data: 'action', name: 'action'}
            ]
        });
    });

    // code for remove question
    $(document).on('click', '._remove_question', function(){
        $('#question_delete_modal').show();
        $(document).find('#question_id').val($(this).attr('data-id'));
    });

    $(document).on('click', '.close', function(){
        $('#question_delete_modal').hide();
    });

    //code for dynamic option in sub-concepts
    function get_sub_concepts(concept_id, is_for, question_id){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });

        $.ajax( {
            url: baseUrl+'/admin/get-sub-concepts',
            type: 'POST',
            data: {
                concept_id: concept_id,
                is_for: is_for,
                question_id: question_id
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

                        $(document).find('#admin_sub_concept_edit').html(options);
                    } else {
                        $.each(sub_concepts, function(index, val){
                            options += '<option value="'+ val.id +'">'+ val.sub_concept +'</option>';
                        });

                        $(document).find('#admin_sub_concept').html(options);
                    }
                }
            },
            error : function() {
                console.log('ERROR');
            }
        });
    };

    var admin_concept = $(document).find('#admin_concept');
    if(admin_concept.length > 0){
        get_sub_concepts(admin_concept.val(), 'add', 0) //call function
    }

    $(document).on('change', '#admin_concept', function(){
        get_sub_concepts($(this).val(), 'add', 0) //call function
    });

    var admin_concept_edit = $(document).find('#admin_concept_edit');
    if(admin_concept_edit.length > 0){
        var question_id = $(document).find('#edit_question_span').attr('data-id');
        get_sub_concepts(admin_concept_edit.val(), 'edit', question_id) //call function
    }

    $(document).on('change', '#admin_concept_edit', function(){
        var question_id = $(document).find('#edit_question_span').attr('data-id');
        get_sub_concepts(admin_concept_edit.val(), 'edit', question_id) //call function
    });

});