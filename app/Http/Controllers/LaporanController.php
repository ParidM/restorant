<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangMasukDetail;
use App\Models\TransaksiDetail;

class LaporanController extends Controller
{
    public function harga(){
        return view('laporan.index-harga');
    }

    public function stok(){
        return view('laporan.index-stok');
    }

    public function laporanHargaFilter(Request $request){
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $data = BarangMasukDetail::select('barang_masuk_detail.barang_id')
            ->selectRaw('SUM(barang_masuk_detail.total) as masuk_total')
            ->selectRaw('(SELECT SUM(total) FROM transaksi_detail WHERE barang_id = barang_masuk_detail.barang_id AND created_at BETWEEN ? AND ?) as transaksi_total', [$startDate.' 00:00:00', $endDate.' 23:59:59'])
            ->whereBetween('barang_masuk_detail.created_at', [$startDate.' 00:00:00', $endDate.' 23:59:59'])
            ->groupBy('barang_masuk_detail.barang_id')
            ->get();

        return view('laporan.filter-harga', compact('data'));
    }

    public function laporanStokFilter(Request $request){
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $data = BarangMasukDetail::select('barang_masuk_detail.barang_id')
            ->selectRaw('SUM(barang_masuk_detail.kuantitas) as masuk_kuantitas')
            ->selectRaw('(SELECT SUM(kuantitas) FROM transaksi_detail WHERE barang_id = barang_masuk_detail.barang_id AND created_at BETWEEN ? AND ?) as transaksi_kuantitas', [$startDate.' 00:00:00', $endDate.' 23:59:59'])
            ->whereBetween('barang_masuk_detail.created_at', [$startDate.' 00:00:00', $endDate.' 23:59:59'])
            ->groupBy('barang_masuk_detail.barang_id')
            ->get();

        return view('laporan.filter-stok', compact('data'));
    }

}
