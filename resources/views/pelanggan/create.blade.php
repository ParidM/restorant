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
                        <div class="position-relative row form-group"><label class="col-sm-3 col-form-label" for="nama">Nama Pelanggan</label>
                            <div class="col-sm-9"><input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" placeholder="Masukan Nama" value="" maxlength="50" required="">
                                </div>
                        </div>
                        <div class="position-relative row form-group"><label class="col-sm-3 col-form-label" for="jk">JK</label>
                            <div class="col-sm-9"><input type="text" class="form-control" id="jk" name="jk" placeholder="Masukan Jenis Kelamin" value="" maxlength="50" required="">
                                </div>
                        </div>
                        <div class="position-relative row form-group"><label class="col-sm-3 col-form-label" for="no_telp">No Telepon</label>
                            <div class="col-sm-9"><input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="Masukan No Telepon" value="" maxlength="50" required="">
                                </div>
                        </div>
                        <div class="position-relative row form-group"><label class="col-sm-3 col-form-label" for="alamat">Alamat</label>
                            <div class="col-sm-9"><input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukan alamat" value="" maxlength="255" required="">
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