$(document).ready(function(){

    // code for get base url
    var baseUrl = window.location.origin;

    // code for concepts datatable
    $(function() {
        var datatable = $('#admin_concepts_table').DataTable({
            processing: true,
            serverSide: true,
            order: [[ 1, 'asc' ]],
            ajax: baseUrl+'/admin/concepts-datatable',
            "columns": [
                {data: 'concept', name: 'concept'},
                {data: 'category_id', name: 'category_id'},
                {data: 'action', name: 'action'}
            ]
        });
    });

    // code for remove concept
    $(document).on('click', '._remove_concept', function(){
        $('#concept_delete_modal').show();
        $(document).find('#concept_id').val($(this).attr('data-id'));
    });

    $(document).on('click', '.close', function(){
        $('#concept_delete_modal').hide();
    });
});