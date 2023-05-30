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
                                            <option value="{{ $item->id }}" class="item" data-nama="{{ $item->nama_barang }}" data-harga="{{ $item->harga_jual }}">{{ $item->nama_barang }}</option>
                                        @endforeach
                                </select>
                                <table class="table table-hover" id="cart_table">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah</th>
                                            <th>Subtotal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-4">
                                <!-- Tambahkan input textbox untuk nilai terima -->
<input type="text" id="nilai_terima" class="form-control" onchange="hitungKembalian()">

<!-- Tambahkan input textbox untuk total keseluruhan -->
<input type="text" id="total_keseluruhan" class="form-control" readonly>

<!-- Tambahkan input textbox untuk nilai kembalian -->
<input type="text" id="nilai_kembalian" class="form-control" readonly>
                                <form action="#" method="post">
                                    @csrf 
                                    <div class="row mt-2">
                                        <div class="col">Total:</div>
                                        <div class="col text-right">
                                            <input type="number" value="" name="total" id="total_keseluruhan" readonly class="form-control total">
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col">Diterima:</div>
                                        <div class="col text-right">
                                            <input type="number" value="" name="accept" id="terima" class="form-control received">
                                        </div>
                                    </div>
                                    <div class="row my-2">
                                        <div class="col">Kembali:</div>
                                        <div class="col text-right"> 
                                            <input type="number" value="" name="return" id="total" readonly class="form-control return">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <button
                                                type="button"
                                                class="btn btn-danger btn-block"
                                            >
                                                Cancel
                                            </button>
                                        </div>
                                        
                                        <div class="col">
                                            <button
                                                type="submit"
                                                class="btn btn-primary btn-block"
                                            >
                                                Pay
                                            </button>
                                        </div>
                                    </div>
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
                        '<td>' + response.barang.nama + '</td>' +
                        '<td>' + response.barang.harga + '</td>' +
                        '<td><input type="number" class="form-control quantity_input"></td>' +
                        '<td>Rp' + parseInt(response.barang.harga).toLocaleString('id-ID') + '</td>' +
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
            var harga = parseInt(row.find('td:nth-child(2)').text());
            var kuantitas = parseInt($(this).val());
            var total = harga * kuantitas;

            if (!isNaN(total)) {
                totalKeseluruhan += total;
            }
        });
        $('#total_keseluruhan').val(totalKeseluruhan.toLocaleString('id-ID'));
        hitungKembalian();
    }

    $(document).on('change', '.quantity_input', function() {
        var row = $(this).closest('tr');
        var harga = parseInt(row.find('td:nth-child(2)').text());
        var kuantitas = parseInt($(this).val());
        var total = harga * kuantitas;

        row.find('td:nth-child(4)').text('Rp ' + total.toLocaleString('id-ID'));

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
        var totalKeseluruhan = parseInt($('#total_keseluruhan').val().replace('Rp', '').replace(',', ''));
        var nilaiTerima = parseInt($('#nilai_terima').val().replace('Rp', '').replace(',', ''));

        if (isNaN(nilaiTerima)) {
        nilaiTerima = 0;
        }

        var kembalian = nilaiTerima - totalKeseluruhan;

        // Menyisipkan format rupiah pada nilai kembalian
        $('#nilai_kembalian').val('Rp ' + kembalian.toLocaleString('id-ID'));
    }
</script>

@endsection