$(function () {
 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });  
//Tabel transaksi
    var table = $('.table-transaksi').DataTable({
        "lengthMenu": [
            [ 25, 50, 100, 1000, -1 ],
            [ '25', '50', '100', '1000', 'All' ]
        ],
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        retrieve: true,
        ajax: "",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'pelanggan', name: 'pelanggan'},
            {data: 'barang', name: 'barang'},
            {data: 'tanggal', name: 'tanggal'},
            {data: 'jumlah', name: 'jumlah'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

//CREATE transaksi
    $('#create').click(function () {
        $('#saveBtn').val("create-transaksi");
        $('#id').val('');
        $('#formCreate').trigger("reset");
        $('#modelHeading').html("Tambah transaksi");
        $('#modalCreate').modal('show');
        $('#modalCreate').appendTo('body');
        $('#formCreate').find('.help-block').remove();
        $('#formCreate').find('.col-sm-9').removeClass('.has-error');
    });

//EDIT transaksi
    $('body').on('click', '.edit', function () {
        var id = $(this).data('id');
        $.get("transaksi" +'/' + id +'/edit', function (data) {
            $('#modelHeading').html("Edit transaksi");
                $('#saveBtn').val("edit-transaksi");
                $('#modalCreate').modal('show');
                $('#modalCreate').appendTo('body');
                $('#formCreate').find('.help-block').remove();
                $('#formCreate').find('.col-sm-9').removeClass('.has-error');
                $('#id').val(data.id);
                $('#barang_id').val(data.barang_id);
                $('#pelanggan_id').val(data.pelanggan_id);
                $('#tanggal').val(data.tanggal);
                $('#jumlah').val(data.jumlah);
        })
    });


//SAVE & UPDATE transaksi
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $('#formCreate').find('.help-block').remove();
        $('#formCreate').find('.col-sm-9').removeClass('.has-error');
        $(this).html('Menyimpan..');
        $.ajax({
            data: $('#formCreate').serialize(),
            url: "transaksi",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                console.log(data.error)
                    if($.isEmptyObject(data.error)){
                        $('#formCreate').trigger("reset");
                        $('#modalCreate').modal('hide');
                        $('#saveBtn').html('<i class="metismenu-icon pe-7s-paper-plane"></i> Simpan');
                        table.draw();
                        toastr.success('Berhasil Menyimpan transaksi', 'Success !'),(data.success);
                    }else{
                        printErrorMsg(data.error);
                    }
                },
            error: function (data) {
                console.log('Error:', data);
                $('#saveBtn').html('Simpan');
            }
        });
    });

//DELETE transaksi
    $('body').on('click', '.delete', function (){
        var id = $(this).data("id");
        var result = Swal.fire({
            title: 'Peringatan!', 
            text: 'Apakah anda yakin?', 
            icon: 'warning',
            showCancelButton: true,
        }).then((result) =>{
                if (result.isConfirmed){
                    $.ajax({
                    type: "GET",
                    url: "hapus-transaksi"+'/'+id,
                    success: function (data) {
                        table.draw();
                        toastr.success('Berhasil Menghapus transaksi', 'Success !'),(data.success);
                        $('#formCreate').find('.help-block').remove();
                        $('#formCreate').find('.col-sm-9').removeClass('.has-error');
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }
        })
    });
});

function printErrorMsg (msg) {
    $.each( msg, function( key, value ) {
    console.log(key);
      $('#' +key)
      .closest('.col-sm-9')
      .addClass('has-error')
      .append('<span class="help-block text-danger">'+ value +'</span>');
    });
    $('#saveBtn').html('<i class="metismenu-icon pe-7s-paper-plane"></i> Simpan')
}