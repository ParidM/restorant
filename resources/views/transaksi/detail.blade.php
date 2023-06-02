<div class="modal fade" id="modal-show{{$barang_masuk->id}}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading">Detail Barang</h4>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <td colspan="2">Kode Transaksi</td>
                            <td colspan="4">{{$barang_masuk->kode}}</td>
                        </tr>
                        <tr>
                            <td colspan="2">Tanggal</td>
                            <td colspan="4">{{$barang_masuk->created_at->format('d/m H:i')}}</td>
                        </tr>
                        <tr>
                            <td colspan="2">Kasir</td>
                            <td colspan="4">{{$barang_masuk->user->name}}</td>
                        </tr>
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Kuantitas</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no=1 @endphp
                        @foreach($detailBarang->where('transaksi_id',$barang_masuk->id) as $data)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$data->barang->kode}}</td>
                            <td>{{$data->barang->nama_barang}}</td>
                            <td>Rp. {{number_format($data->harga)}}</td>
                            <td>{{$data->kuantitas}}</td>
                            <td>Rp. {{number_format($data->total)}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="5" class="text-center">Total Pembayaran</th>
                            <th>Rp. {{number_format($barang_masuk->total)}}</th>
                        </tr>
                    </tfoot>
                </table>
                    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="metismenu-icon pe-7s-close"></i>Batal</button>
            </div>
        </div>
    </div>
</div>
<script>
        $('#modal-show{{$barang_masuk->id}}').appendTo('body');
</script>
