@extends('layouts.app')

@section('title')
    <title>Data Barang Masuk</title>
@endsection

@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-download icon-gradient bg-mean-fruit"></i>
                </div>
                <div>Data Barang Masuk
                    <div class="page-title-subheading">
                        Data master Barang Masuk
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="mb-3 card">
                <div class="card-header-tab card-header-tab-animation card-header">
                    <div class="card-header-tab card-header-tab-animation card-header">
                        <div class="card-header-title">
                            <a class="btn btn-success" href="{{route('transaksi.create')}}" id=""><i class="metismenu-icon pe-7s-note2"></i> Tambah</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="table-responsive">
                            <table id="myTable2" class="table table-striped table-hover">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Kode Transaksi</th>
                                        <th>Nama Kasir</th>
                                        <th>Total</th>
                                        <th>Diterima</th>
                                        <th>Kembali</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @forelse($data as $barang_masuk)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$barang_masuk->created_at->format('d/m H:i')}}</td>
                                        <td>{{$barang_masuk->kode}}</td>
                                        <td>{{$barang_masuk->user->name}}</td>
                                        <td>Rp. {{number_format($barang_masuk->total)}}</td>
                                        <td>Rp. {{number_format($barang_masuk->diterima)}}</td>
                                        <td>Rp. {{number_format($barang_masuk->kembali)}}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary" id="detail" data-toggle="modal" data-target="#modal-show{{$barang_masuk->id}}">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        @include('transaksi.detail')
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td class="text-center" colspan="8">Data Belum Tersedia</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> 
            </div>
        </div>    
    </div>
</div> 
<script src="{{asset('js/crud/barang-masuk.js')}}"></script>     
@endsection