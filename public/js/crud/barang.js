$(function () {
 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });  
//Tabel barang
    var table = $('.table-barang').DataTable({
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
            {data: 'kode', name: 'kode'},
            {data: 'supplier', name: 'supplier'},
            {data: 'nama_barang', name: 'nama_barang'},
            {data: 'harga', name: 'harga'},
            {data: 'stok_barang', name: 'stok_barang'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

//CREATE barang
    $('#create').click(function () {
        $('#saveBtn').val("create-barang");
        $('#id').val('');
        $('#formCreate').trigger("reset");
        $('#modelHeading').html("Tambah barang");
        $('#modalCreate').modal('show');
        $('#modalCreate').appendTo('body');
        $('#formCreate').find('.help-block').remove();
        $('#formCreate').find('.col-sm-9').removeClass('.has-error');
    });

//EDIT barang
    $('body').on('click', '.edit', function () {
        var id = $(this).data('id');
        $.get("barang" +'/' + id +'/edit', function (data) {
            $('#modelHeading').html("Edit barang");
                $('#saveBtn').val("edit-barang");
                $('#modalCreate').modal('show');
                $('#modalCreate').appendTo('body');
                $('#formCreate').find('.help-block').remove();
                $('#formCreate').find('.col-sm-9').removeClass('.has-error');
                $('#id').val(data.id);
                $('#nama_barang').val(data.nama_barang);
                $('#supplier_id').val(data.supplier_id);
                $('#harga').val(data.harga);
                $('#stok_barang').val(data.stok_barang);
        })
    });


//SAVE & UPDATE barang
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $('#formCreate').find('.help-block').remove();
        $('#formCreate').find('.col-sm-9').removeClass('.has-error');
        $(this).html('Menyimpan..');
        $.ajax({
            data: $('#formCreate').serialize(),
            url: "barang",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                console.log(data.error)
                    if($.isEmptyObject(data.error)){
                        $('#formCreate').trigger("reset");
                        $('#modalCreate').modal('hide');
                        $('#saveBtn').html('<i class="metismenu-icon pe-7s-paper-plane"></i> Simpan');
                        table.draw();
                        toastr.success('Berhasil Menyimpan barang', 'Success !'),(data.success);
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

//DELETE barang
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
                    url: "hapus-barang"+'/'+id,
                    success: function (data) {
                        table.draw();
                        toastr.success('Berhasil Menghapus barang', 'Success !'),(data.success);
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