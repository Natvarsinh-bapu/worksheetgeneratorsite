$(document).ready(function(){

    // code for get base url
    var baseUrl = window.location.origin;

    // code for teacher datatable
    $(function() {
        var datatable = $('#institute_teachers_table').DataTable({
            processing: true,
            serverSide: true,
            order: [[ 1, 'asc' ]],
            ajax: baseUrl+'/institute/teachers-datatable',
            "columns": [
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'phone', name: 'phone'},
                {data: 'action', name: 'action'}
            ]
        });
    });

    // code for remove teacher
    $(document).on('click', '._remove_teacher', function(){
        $('#teacher_delete_modal').show();
        $(document).find('#teacher_id').val($(this).attr('data-id'));
    });

    $(document).on('click', '.close', function(){
        $('#teacher_delete_modal').hide();
    });
});