$(document).ready(function(){

    // code for get base url
    var baseUrl = window.location.origin;

    // code for student datatable
    $(function() {
        var datatable = $('#institute_students_table').DataTable({
            processing: true,
            serverSide: true,
            order: [[ 1, 'asc' ]],
            ajax: baseUrl+'/institute/students-datatable',
            "columns": [
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'enrollment_no', name: 'enrollment_no'},
                {data: 'class', name: 'class'},
                {data: 'action', name: 'action'}
            ]
        });
    });

    // code for remove student
    $(document).on('click', '._remove_student', function(){
        $('#student_delete_modal').show();
        $(document).find('#student_id').val($(this).attr('data-id'));
    });

    $(document).on('click', '.close', function(){
        $('#student_delete_modal').hide();
    });
});