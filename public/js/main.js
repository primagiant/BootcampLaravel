$(document).ready(function () {
    datatable();
})

function datatable() {
    $('.datatable-new').each(function () {
        let _token = $('body').data('csrf-token');
        let url = $(this).data('url');
        let column = $(this).data('column');

        $(this).DataTable({
            "searching": false,
            "processing": true,
            "serverSide": true,
            "ordering": true,
            "order": [[0, "desc"]],
            "columnDefs": [{
                "orderable": false,
                "targets": "no-sort",
            }],
            "ajax": {
                "url": url,
                "dataType": "json",
                "type": "POST",
                "data": {
                    _token: _token,
                    name: name,
                },
            },
            "column": column,
            // "drawCallback": function () {
            //     user_role_menu_action();
            // }
        });
    });
}
