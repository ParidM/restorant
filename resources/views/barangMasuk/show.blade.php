@extends('layouts.app')

@section('title')
    <title>Seragam Barcode</title>
@endsection

@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-wallet icon-gradient bg-mean-fruit"></i>
                </div>
                <div>Supplier dari {{$supplier->nama_supplier}}
                    <div class="page-title-subheading">
                        Barang barang yang tersedia dari supplier {{$supplier->nama_supplier}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="mb-3 card">
                <div class="card-header-tab card-header-tab-animation card-header">
                    <div class="card-header-title">
                        <a class="btn btn-danger" href="#"><i class="metismenu-icon pe-7s-back"></i> Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="row">
                            <div class="col-md-8">
                                <select name="barang_id" id="barang_id" class="form-control">
                                    <option disable="true" selected="true" disabled>--- Pilih Barang ---</option>
                                        @foreach ($barang as $item)
                                            <option value="{{ $item->id }}" class="item" data-nama="{{ $item->nama_barang }}" data-harga="{{ $item->harga_beli }}">{{ $item->nama_barang }}</option>
                                        @endforeach
                                </select>
                                <form action="{{route('barang-masuk.store')}}" method="POST">
                                @csrf
                                <table class="table table-hover table-striped" id="cart_table">
                                    <thead>
                                        <tr class="text-center">
                                            <th width="20%">Nama Barang</th>
                                            <th width="15%">Harga</th>
                                            <th width="10%">Jumlah</th>
                                            <th width="20%">Subtotal</th>
                                            <th width="10%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-4">
                                <table class="table">
                                    <tr>
                                        <td>Total :</td>
                                        <td><input type="text" name="total" id="total_keseluruhan" class="form-control" readonly></td>
                                    </tr>
                                    <tr>
                                        <td>Diterima :</td>
                                        <td><input type="text" name="diterima" id="nilai_terima" class="form-control" onchange="hitungKembalian()"></td>
                                    </tr>
                                    <tr>
                                        <td>Kembalian</td>
                                        <td><input type="text" name="kembali" id="nilai_kembalian" class="form-control" readonly></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>    
    </div>
</div>
<script>
    $(document).ready(function () {
        updateTotalKeseluruhan();
    });

    document.getElementById('barang_id').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var barangId = selectedOption.value;
        var namaBarang = selectedOption.getAttribute('data-nama');
        var hargaBarang = selectedOption.getAttribute('data-harga');
        var url = "{{ route('cart.store') }}";

        // Kirim data melalui AJAX
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: url,
            data: {
                barang_id: barangId,
                nama: namaBarang,
                harga: hargaBarang
            },
            success: function(response) {
                if (response.success) {
                    var row = '<tr>' +
                        '<td><input type="hidden" class="form-control" value="'+ response.barang.barang_id +'" name="barang_id[]">' + response.barang.nama + '</td>' +
                        '<td><input type="hidden" class="form-control" value="'+ response.barang.harga_beli +'" name="harga[]">' + response.barang.harga_beli + '</td>' +
                        '<td><input type="number" class="form-control quantity_input" name="kuantitas[]"></td>' +
                        '<td>' + response.barang.harga_beli + '</td>' +
                        '<td><button class="btn btn-danger btn-sm delete_row">Hapus</button></td>' +
                        '</tr>';
                    $('#cart_table tbody').append(row);
                    console.log('Data berhasil ditambahkan ke keranjang.');
                    selectedOption.disabled = true;
                    updateTotalKeseluruhan(); 
                } else {
                    console.log('Gagal menambahkan data ke keranjang.');
                }
            },
            error: function(response) {
                console.log('Terjadi kesalahan: ' + response.responseText);
            }
        });
    });

    function updateTotalKeseluruhan() {
        var totalKeseluruhan = 0;
        $('.quantity_input').each(function () {
            var row = $(this).closest('tr');
            var harga = parseFloat(row.find('td:nth-child(2)').text()); // Menggunakan parseFloat() untuk mempertahankan digit nol di depan
            var kuantitas = parseInt($(this).val());
            var total = harga * kuantitas;

            if (!isNaN(total)) {
                totalKeseluruhan += total;
            }
        });
        $('#total_keseluruhan').val(totalKeseluruhan);
        hitungKembalian();
    }

    $(document).on('change', '.quantity_input', function() {
        var row = $(this).closest('tr');
        var harga = parseInt(row.find('td:nth-child(2)').text());
        var kuantitas = parseInt($(this).val());
        var total = harga * kuantitas;
        
        if (isNaN(kuantitas) || kuantitas <= 0) {
            $(this).val(1); // Jika kuantitas tidak valid, atur nilainya ke 1
            kuantitas = 1;
        }
        row.find('td:nth-child(4)').text(total);

        updateTotalKeseluruhan();
    });

    $(document).on('click', '.delete_row', function() {
        var row = $(this).closest('tr');
        var namaBarang = row.find('td:first').text();

        // Tambahkan kembali opsi ke combobox
        $('#barang_id option').each(function() {
            if ($(this).text() === namaBarang) {
                $(this).prop('disabled', false);
            }
        });

        var harga = parseInt(row.find('td:nth-child(2)').text());
        var kuantitas = parseInt(row.find('.quantity_input').val());
        var total = harga * kuantitas;

        row.remove();

        updateTotalKeseluruhan();
    });

    function hitungKembalian() {
        var totalKeseluruhan = parseInt($('#total_keseluruhan').val());
        var nilaiTerima = parseInt($('#nilai_terima').val());

        if (isNaN(nilaiTerima)) {
            nilaiTerima = 0;
        }

        var kembalian = nilaiTerima - totalKeseluruhan;

        $('#nilai_kembalian').val(kembalian);
    }
</script>
@endsection