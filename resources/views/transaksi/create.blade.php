<div class="modal fade" id="modalCreate" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="formCreate" name="formCreate" class="form-horizontal">
                    <div class="form-group">
                    <input type="hidden" name="id" id="id">
                        <div class="position-relative row form-group"><label class="col-sm-3 col-form-label" for="pelanggan_id">Pelanggan</label>
                            <div class="col-sm-9">
                                <select name="pelanggan_id" id="pelanggan_id" class="form-control">
                                    <option disable="true" selected="true" disabled>--- Pilih Pelanggan ---</option>
                                        @foreach ($pelanggan as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="position-relative row form-group"><label class="col-sm-3 col-form-label" for="barang_id">Barang</label>
                            <div class="col-sm-9">
                                <select name="barang_id" id="barang_id" class="form-control">
                                    <option disable="true" selected="true" disabled>--- Pilih Barang ---</option>
                                        @foreach ($barang as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="position-relative row form-group"><label class="col-sm-3 col-form-label" for="tanggal">Tanggal</label>
                            <div class="col-sm-9"><input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Masukan No Telepon" value="" maxlength="50" required="">
                                </div>
                        </div>
                        <div class="position-relative row form-group"><label class="col-sm-3 col-form-label" for="jumlah">Jumlah</label>
                            <div class="col-sm-9"><input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Masukan jumlah" value="" maxlength="50" required="">
                                </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-primary" id="saveBtn" value="create"><i class="metismenu-icon pe-7s-paper-plane"></i> Simpan</button>
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="metismenu-icon pe-7s-close"></i>Batal</button>
                </form>
            </div>
        </div>
    </div>
</div>