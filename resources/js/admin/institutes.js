$(document).ready(function(){
    // code for get base url
    var baseUrl = window.location.origin;

    // code for categories datatable
    $(function() {
        var datatable = $('#admin_institutes_table').DataTable({
            processing: true,
            serverSide: true,
            order: [[ 1, 'asc' ]],
            ajax: baseUrl+'/admin/institutes-datatable',
            "columns": [
                {data: 'name', name: 'name'},
                {data: 'action', name: 'action'}
            ]
        });
    });

    // code for remove category
    $(document).on('click', '._remove_institute', function(){
        $('#institute_delete_modal').show();
        $(document).find('#institute_id').val($(this).attr('data-id'));
    });

    $(document).on('click', '.close', function(){
        $('#institute_delete_modal').hide();
    });
});