$(function () {
 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });  
//Tabel barang-masuk
    var table = $('.table-barang-masuk').DataTable({
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
            {data: 'barang', name: 'barang'},
            {data: 'tanggal', name: 'tanggal'},
            {data: 'jumlah', name: 'jumlah'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

//CREATE barang-masuk
    $('#create').click(function () {
        $('#saveBtn').val("create-barang-masuk");
        $('#id').val('');
        $('#formCreate').trigger("reset");
        $('#modelHeading').html("Tambah barang-masuk");
        $('#modalCreate').modal('show');
        $('#modalCreate').appendTo('body');
        $('#formCreate').find('.help-block').remove();
        $('#formCreate').find('.col-sm-9').removeClass('.has-error');
    });

//EDIT barang-masuk
    $('body').on('click', '.edit', function () {
        var id = $(this).data('id');
        $.get("barang-masuk" +'/' + id +'/edit', function (data) {
            $('#modelHeading').html("Edit barang-masuk");
                $('#saveBtn').val("edit-barang-masuk");
                $('#modalCreate').modal('show');
                $('#modalCreate').appendTo('body');
                $('#formCreate').find('.help-block').remove();
                $('#formCreate').find('.col-sm-9').removeClass('.has-error');
                $('#id').val(data.id);
                $('#barang_id').val(data.barang_id);
                $('#tanggal').val(data.tanggal);
                $('#jumlah').val(data.jumlah);
        })
    });


//SAVE & UPDATE barang-masuk
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $('#formCreate').find('.help-block').remove();
        $('#formCreate').find('.col-sm-9').removeClass('.has-error');
        $(this).html('Menyimpan..');
        $.ajax({
            data: $('#formCreate').serialize(),
            url: "barang-masuk",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                console.log(data.error)
                    if($.isEmptyObject(data.error)){
                        $('#formCreate').trigger("reset");
                        $('#modalCreate').modal('hide');
                        $('#saveBtn').html('<i class="metismenu-icon pe-7s-paper-plane"></i> Simpan');
                        table.draw();
                        toastr.success('Berhasil Menyimpan barang-masuk', 'Success !'),(data.success);
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

//DELETE barang-masuk
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
                    url: "hapus-barang-masuk"+'/'+id,
                    success: function (data) {
                        table.draw();
                        toastr.success('Berhasil Menghapus barang-masuk', 'Success !'),(data.success);
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