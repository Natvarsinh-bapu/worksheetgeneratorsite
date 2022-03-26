$(document).ready(function () {

    // code for get base url
    var baseUrl = window.location.origin;

    // code for worksheet datatable
    $(function () {
        var datatable = $('#superadmin_worksheets_table').DataTable({
            processing: true,
            serverSide: true,
            order: [
                [1, 'asc']
            ],
            ajax: baseUrl + '/superadmin/worksheets-datatable',
            "columns": [{
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ]
        });
    });

    // code for remove worksheet
    $(document).on('click', '._remove_worksheet', function () {
        $('#worksheet_delete_modal').show();
        $(document).find('#worksheet_id').val($(this).attr('data-id'));
    });

    $(document).on('click', '.close', function () {
        $('#worksheet_delete_modal').hide();
    });

    //code for select all question
    $(document).on('change', '#check_all', function () {
        var checked = $(this).prop('checked');

        if (checked) {
            $(document).find('._question_checkbox').prop('checked', true);
        } else {
            $(document).find('._question_checkbox').prop('checked', false);
        }
    });

    $(document).on('change keyup', '#title_worksheet', function () {
        $(document).find('#worksheet_title').val($(this).val());
    });

    /**----------------------------------------------------------------------
     * CODE FOR CATEGORY BASED DYNAMIC OPTIONS
     ------------------------------------------------------------------------*/
    function get_category(category_id) {
        if (category_id == '') {
            $(document).find('#concept_filter').val('');
            $(document).find('#sub_concept_filter').val('');
            $(document).find('#type_filter').val('');
        } else {
            console.log('category_id::', category_id);
        }
    }

    var category_filter = $(document).find('#category_filter');
    if (category_filter.length > 0) {
        get_category(category_filter.val()); //function called
    }

    category_filter.on('change', function () {
        console.log('category_id_change::', $(this).val());
    });
});