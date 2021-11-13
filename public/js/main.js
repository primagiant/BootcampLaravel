$(document).ready(function () {
    datatable();
    formSend();
    hapus();

    produk_tambah();
});

function datatable() {
    $('#datatable-new').each(function () {
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
                },
            },
            "columns": column,
            "drawCallback": function () {
                // user_role_menu_action();
            }
        });
    });
}

function formSend() {
    $('.form-send').submit(function (e) {
        e.preventDefault();

        let self = $(this);
        let redirect = $(this).data('redirect');

        $.ajax({
            url: self.attr('action'),
            type: self.attr('method'),
            data: self.serialize(),
            error: function (json) {
                $('.form-control-feedback').remove();
                $('.form-group').removeClass('has-danger');

                $.each(json.responseJSON.errors, function (key, value) {
                    $('[name="' + key + '"]').parents('.form-group').addClass('has-danger');
                    $('[name="' + key + '"]').after('<span class="form-control-feedback"><small>*' + value + '</small></span>');
                });
            },
            success: function (json) {
                window.location.href = redirect;
            }
        });
        return false;
    });
}

function hapus() {
    $('.datatable').on('click', '.btn-hapus', function (e) {
        e.preventDefault();
        let route = $(this).data('route');
        let _token = $('body').data('csrf-token');

        Swal.fire({
            title: "Apakah yakin menghapus data ini?",
            text: "Data ini akan terhapus secara permanen jika di proses",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, saya yakin'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: route,
                    type: 'delete',
                    data: {
                        _token: _token
                    },
                    success: function () {
                        window.location.reload();
                    },
                })
            }
        })
    });
}

function produk_tambah() {
    $('.btn-produk-tambah').click(function () {
        var produk_row = $('.table-produk-row tbody').html();

        $('.table-produk tbody').append(produk_row);

        produk_hapus();
        produk_bahan_change();
    });
}

function produk_hapus() {
    $('.btn-produk-hapus').click(function () {
        $(this).parents('tr').remove();

        produk_bahan_hapus()
    });
}



function produk_bahan_change() {
    $('[name="qty_produksi"]').on('keyup change', function () {
        var id_produk = $(this).parents('td').siblings('td.produk').children('[name="id_produk"]').val();
        var qty_produksi = $(this).val();

        produk_bahan_proses(id_produk, qty_produksi);
    });
    $('[name="id_produk"]').on('keyup change', function () {
        var id_produk = $(this).val();
        var qty_produksi = $(this).parents('td').siblings('td.qty').children('[name="qty_produksi"]').val();

        produk_bahan_proses(id_produk, qty_produksi);
    });
}

function produk_bahan_proses(id_produk, qty_produksi) {

    var _token = $('body').data('csrf-token');
    var route_produksi_bahan_list = $('body').data('produksi-bahan-list');
    var data_send = {
        _token: _token,
        id_produk: id_produk,
        qty_produksi: qty_produksi
    };

    $.ajax({
        url: route_produksi_bahan_list,
        type: 'post',
        data: data_send,
        success: function (view) {
            $('.data-bahan-view').html(view);
        }
    });
}

function produk_bahan_hapus() {
    $('.data-bahan').html('');
}


