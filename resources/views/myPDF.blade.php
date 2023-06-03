<!DOCTYPE html>
<html>
<head>
    <title>Struk Pembelian</title>
</head>
<style>
    .struk {
        font-size: 7px;
        margin: 0px auto;
        width: 275px;
        margin-left: -30px;
        margin-top: -35px;
        margin-right: -30px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 3px;
        border: 1px solid #000;
    }

    th {
        background-color: #f2f2f2;
        text-align: center;
    }

    tfoot th {
        text-align: right;
    }

    tfoot td {
        background-color: #f2f2f2;
        text-align: right;
        font-weight: bold;
    }

    h6 {
        text-align: center;
        margin-bottom: 10px;
    }
</style>

<body>

    <div class="struk">
    <h2 style="text-align:center;">Struk Pembelian</h2>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <td colspan="2">Kode Transaksi</td>
                    <td colspan="4">{{$data->kode}}</td>
                </tr>
                <tr>
                    <td colspan="2">Tanggal</td>
                    <td colspan="4">{{$data->created_at->format('d/m H:i')}}</td>
                </tr>
                <tr>
                    <td colspan="2">Kasir</td>
                    <td colspan="4">{{$data->user->name}}</td>
                </tr>
                <tr>
                    <th width="8%">No</th>
                    <th width="25%">Kode Barang</th>
                    <th width="35%">Nama Barang</th>
                    <th width="20%">Harga</th>
                    <th width="8%">Qty.</th>
                    <th width="25%">Total</th>
                </tr>
            </thead>
            <tbody>
                @php $no=1 @endphp
                @foreach($detailTransaksi as $detail)
                <tr>
                    <td class="text-center">{{$no++}}</td>
                    <td>{{$detail->barang->kode}}</td>
                    <td>{{$detail->barang->nama_barang}}</td>
                    <td>Rp. {{number_format($detail->harga)}}</td>
                    <td class="text-center">{{$detail->kuantitas}}</td>
                    <td>Rp. {{number_format($detail->total)}}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="5" class="text-center">Total Pembayaran</th>
                    <th>Rp. {{number_format($data->total)}}</th>
                </tr>
                <tr>
                    <th colspan="5" class="text-center">Tunai</th>
                    <th>Rp. {{number_format($data->diterima)}}</th>
                </tr>
                <th colspan="5" class="text-center">Kembalian</th>
                    <th>Rp. {{number_format($data->kembali)}}</th>
            </tfoot>
        </table>
    </div>
</body>
</html>