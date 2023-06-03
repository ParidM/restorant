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
                        <form action="{{ route('laporan-harga-filter') }}" method="GET">
        <label for="start_date">Start Date:</label>
        <input type="date" name="start_date">

        <label for="end_date">End Date:</label>
        <input type="date" name="end_date">

        <button type="submit">Filter</button>
    </form>
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
                                        <th>Nama Barang</th>
                                        <th>Total Pembelian</th>
                                        <th>Total Penjualan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> 
            </div>
        </div>    
    </div>
</div>      
@endsection