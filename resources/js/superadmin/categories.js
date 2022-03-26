$(document).ready(function () {

    // code for get base url
    var baseUrl = window.location.origin;

    // code for categories datatable
    $(function () {
        var datatable = $('#superadmin_categories_table').DataTable({
            processing: true,
            serverSide: true,
            order: [
                [1, 'asc']
            ],
            ajax: baseUrl + '/superadmin/categories-datatable',
            "columns": [{
                    data: 'category',
                    name: 'category'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ]
        });
    });

    // code for remove category
    $(document).on('click', '._remove_category', function () {
        $('#category_delete_modal').show();
        $(document).find('#category_id').val($(this).attr('data-id'));
    });

    $(document).on('click', '.close', function () {
        $('#category_delete_modal').hide();
    });
});