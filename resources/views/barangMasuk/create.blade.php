<div class="modal fade" id="modalCreate" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-supplier">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama Supplier</th>
                                <th>Telepon</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach($supplier as $item)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$item->kode}}</td>
                                <td>{{$item->nama_supplier}}</td>
                                <td>{{$item->no_telp}}</td>
                                <td class="text-center"><a href="{{route('barang-masuk.show', $item->id)}}" data-toggle="tooltip" title="Pilih" data-original-title="Barcode" class="btn btn-primary btn-sm"><i class="metismenu-icon pe-7s-note"></i> Pilih</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="metismenu-icon pe-7s-close"></i>Batal</button>
            </div>
        </div>
    </div>
</div>