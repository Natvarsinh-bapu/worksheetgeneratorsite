$(document).ready(function(){

    // code for get base url
    var baseUrl = window.location.origin;

    // code for types datatable
    $(function() {
        var datatable = $('#institute_types_table').DataTable({
            processing: true,
            serverSide: true,
            order: [[ 1, 'asc' ]],
            ajax: baseUrl+'/institute/types-datatable',
            "columns": [
                {data: 'type', name: 'type'},
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
});