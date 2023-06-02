<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Barang;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DataTables;
use Validator;

class TransaksiController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Transaksi::all();
        $detailBarang = TransaksiDetail::all();
        return view('transaksi.index', compact('data','detailBarang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pelanggan = Pelanggan::All();
        $barang = Barang::All();
        return view('transaksi.show', compact('pelanggan','barang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transaksi = Transaksi::create([
            'user_id'  => Auth::user()->id,
            'pelanggan_id' => $request->pelanggan_id,
            'total'    => $request->total,
            'diterima' => $request->diterima,
            'kembali'  => $request->kembali,
        ]);
        for ($count = 0; $count < count($request->barang_id); $count++) {
            $detail_barang = array(
                'transaksi_id'  => $transaksi->id,
                'barang_id'  => $request->barang_id[$count],
                'harga'  => $request->harga[$count],
                'kuantitas'  => $request->kuantitas[$count],
                'total' => $request->kuantitas[$count] * $request->harga[$count],
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            );
            $store_data[] = $detail_barang;
        }
        TransaksiDetail::insert($store_data);
        for ($count = 0; $count < count($request->barang_id); $count++) {
            $barang = Barang::findOrFail($request->barang_id[$count]);
            $barang->stok_barang -= $request->kuantitas[$count];
            $barang->save();
        }
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaksi  $Transaksi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaksi = Transaksi::find($id);
        return view('transaksi.show', compact('transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaksi  $Transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaksi = Transaksi::find($id);
        return response()->json($transaksi);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaksi  $Transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaksi $Transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaksi  $Transaksi
     * @return \Illuminate\Http\Response
     */
    public function hapus($id)
    {
        $transaksi = Transaksi::find($id);
        $transaksi->delete();
        return response()->json($transaksi);
    }
}