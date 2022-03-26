$(document).ready(function () { 
    var assigned_arr = [];
    var baseUrl = window.location.origin;

    //select worksheet
    $(document).on('change', '._assign_worksheet', function () {
        let is_checked = $(this).prop('checked');

        if (is_checked) {
            if (assigned_arr.length > 2) {
                $(this).prop('checked', false);
                $('#assign_message').html('You can assign only 3 worksheets at a time');
                $('#assign_limit_modal').modal('show');
                return;
            }
            assigned_arr.push($(this).val());
        } else {
            var index = assigned_arr.indexOf($(this).val());
            assigned_arr.splice(parseInt(index), 1);
        }
    });

    //assign
    $(document).on('click', '#assign_btn', function () {
        if (assigned_arr.length < 1) {
            $('#assign_message').html('Please select worksheet to assign');
            $('#assign_limit_modal').modal('show');
            return;
        }
        $(document).find('#class_select').val("");
        $(document).find('#student_list_div').html(
            "<h4>Select class for student list</h4>"
        );
        $('#student_list_modal').modal('show');
    });

    //select class
    $(document).on('change', '#class_select', function () {
        let class_id = $(this).val();

        if (class_id == "") {
            $(document).find('#student_list_div').html(
                "<h4>Select class for student list</h4>"
            );
            return;
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: baseUrl + '/get-students/' + class_id,
            type: 'GET',
            cache: false,
            success: function (response) {
                let student_list_div = $(document).find('#student_list_div');
                student_list_div.empty();
                if (response.success) {
                    student_list_div.append(response.html);
                }
            },
            error: function () {
                console.log('ERROR');
            }
        });
    });

    //select all
    $(document).on('change', '#select_all', function () { 
        let is_checked = $(this).prop('checked');

        if (is_checked) {
            $(document).find('.assign_student').prop('checked', true);
        } else {
            $(document).find('.assign_student').prop('checked', false);
        }
    });

    //assign worksheet done
    $(document).on('click', '#assign_worksheet_done', function () { 
        var selected_students = $('._checked_students:checkbox:checked').map(function() {
            return this.value;
        }).get();
        
        if (selected_students.length < 1) { 
            $(document).find('#select_student_err').show();
            return;
        }
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: baseUrl + '/assign-to-students',
            type: 'POST',
            data: {
                worskheets: assigned_arr,
                selected_students: selected_students
            },
            cache: false,
            success: function (response) {
                if (response.success) {
                    $(document).find('#assigned_alert_div').append(
                        '<div class="alert alert-success">' + response.message + '</div>'
                    );
                } else {
                    $(document).find('#assigned_alert_div').append(
                        '<div class="alert alert-danger">' + response.error + '</div>'
                    );
                }

                selected_students = [];
                $(document).find('#class_select').val("");
                $(document).find('#student_list_div').html(
                    "<h4>Select class for student list</h4>"
                );

                window.setTimeout(function () { 
                    $(document).find('#assigned_alert_div').empty();
                }, 3000);
            },
            error: function () {
                console.log('ERROR');
            }
        });
    });
});