$(document).ready(function(){

    // code for get base url
    var baseUrl = window.location.origin;

    // code for class datatable
    $(function() {
        var datatable = $('#institute_class_table').DataTable({
            processing: true,
            serverSide: true,
            order: [[ 1, 'asc' ]],
            ajax: baseUrl+'/institute/class-datatable',
            "columns": [
                {data: 'name', name: 'name'},
                {data: 'action', name: 'action'}
            ]
        });
    });

    // code for remove class
    $(document).on('click', '._remove_class', function(){
        $('#class_delete_modal').show();
        $(document).find('#class_id').val($(this).attr('data-id'));
    });

    $(document).on('click', '.close', function(){
        $('#class_delete_modal').hide();
    });
});