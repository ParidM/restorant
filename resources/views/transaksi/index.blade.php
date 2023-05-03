@extends('layouts.app')

@section('title')
    <title>Data Transaksi</title>
@endsection

@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-upload icon-gradient bg-mean-fruit"></i>
                </div>
                <div>Data Transaksi
                    <div class="page-title-subheading">
                        Data master Transaksi
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
                        <a class="btn btn-success" href="{{route('transaksi.create')}}" id=""><i class="metismenu-icon pe-7s-note2"></i> Tambah</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-transaksi">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Pelanggan</th>
                                        <th>Barang</th>
                                        <th>Jumlah</th>
                                        <th>Tanggal</th>
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
@include('transaksi.create')
<script src="{{asset('js/crud/transaksi.js')}}"></script>     
@endsection