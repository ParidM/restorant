@extends('layouts.app')

@section('title')
    <title>Data Pelanggan</title>
@endsection

@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-users icon-gradient bg-mean-fruit"></i>
                </div>
                <div>Data Pelanggan
                    <div class="page-title-subheading">
                        Data master pelanggan
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
                        <a class="btn btn-success" href="javascript:void(0)" id="create"><i class="metismenu-icon pe-7s-note2"></i> Tambah</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-pelanggan">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Nama Pelanggan</th>
                                        <th>JK</th>
                                        <th>No Telepon</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div> 
            </div>
        </div>    
    </div>
</div> 
@include('pelanggan.create')
<script src="{{asset('js/crud/pelanggan.js')}}"></script>     
@endsection