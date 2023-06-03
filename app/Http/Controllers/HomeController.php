<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\TransaksiDetail;
use App\Models\Barang;
use App\Models\Supplier;
use App\Models\Transaksi;
use PDF;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','revalidate']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $pelanggan = Pelanggan::All()->count();
        $barang = Barang::All()->count();
        $supplier = Supplier::All()->count();
        return view('home',compact('pelanggan','barang','supplier'));
    }
    
    public function generateStruk($id){
        $data = Transaksi::find($id);
        $detailTransaksi = TransaksiDetail::where('transaksi_id', $data->id)->get();
        $pdf = PDF::loadView('myPDF', compact('data','detailTransaksi'));
        $pdf->setPaper([0, 0, 226.772, 400], 'portrait');
        return $pdf->stream('Struk'.$data->kode.'.pdf');
    }
}
