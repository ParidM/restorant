<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\BarangMasukDetail;
use App\Models\BarangMasuk;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DataTables;
use Validator;

class BarangMasukController extends Controller
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
        $supplier = Supplier::All();
        $data = BarangMasuk::all();
        $detailBarang = BarangMasukDetail::all();
        return view('barangMasuk.index', compact('supplier','data','detailBarang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $barangMasuk = BarangMasuk::create([
            'user_id'  => Auth::user()->id,
            'total'    => $request->total,
            'diterima' => $request->diterima,
            'kembali'  => $request->kembali,
        ]);
        for ($count = 0; $count < count($request->barang_id); $count++) {
            $detail_barang = array(
                'barang_masuk_id'  => $barangMasuk->id,
                'barang_id'  => $request->barang_id[$count],
                'harga'  => $request->harga[$count],
                'kuantitas'  => $request->kuantitas[$count],
                'total' => $request->kuantitas[$count] * $request->harga[$count],
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            );
            $store_data[] = $detail_barang;
        }
        BarangMasukDetail::insert($store_data);

        for ($count = 0; $count < count($request->barang_id); $count++) {
            $barang = Barang::findOrFail($request->barang_id[$count]);
            $barang->stok_barang += $request->kuantitas[$count];
            $barang->save();
        }
        return redirect()->route('barang-masuk.index')->with('success', 'Barang masuk berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BarangMasuk  $BarangMasuk
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);
        
        $barang = Barang::where('supplier_id',$id)->get();
        return view('BarangMasuk.show', compact('barang','supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BarangMasuk  $BarangMasuk
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $BarangMasuk = BarangMasuk::find($id);
        return response()->json($BarangMasuk);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BarangMasuk  $BarangMasuk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BarangMasuk $BarangMasuk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BarangMasuk  $BarangMasuk
     * @return \Illuminate\Http\Response
     */
    public function hapus($id)
    {
        $BarangMasuk = BarangMasuk::find($id);
        $BarangMasuk->delete();
        return response()->json($BarangMasuk);
    }
}
