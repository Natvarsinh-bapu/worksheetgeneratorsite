$(document).ready(function(){

    // code for get base url
    var baseUrl = window.location.origin;

    // code for sub-concepts datatable
    $(function() {
        var datatable = $('#institute_sub_concepts_table').DataTable({
            processing: true,
            serverSide: true,
            order: [[ 1, 'asc' ]],
            ajax: baseUrl+'/institute/sub-concepts-datatable',
            "columns": [
                {data: 'sub_concept', name: 'sub_concept'},
                {data: 'concept_id', name: 'concept_id'},
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
});