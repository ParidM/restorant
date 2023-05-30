<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\BarangMasuk;
use App\Models\Barang;
use Illuminate\Http\Request;
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
        if ($request->ajax()) {
            $data = BarangMasuk::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn ='<a href="#" data-toggle="tooltip" title="Edit" data-id="'.$row->id.'" data-original-title="Barcode" class="btn btn-success btn-sm barcod"><i class="metismenu-icon pe-7s-plugin"></i></a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip" title="Edit" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-warning btn-sm edit"><i class="metismenu-icon pe-7s-pen"></i></a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip" title="Hapus" data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm delete"><i class="metismenu-icon pe-7s-trash"></i></a>';
                    return $btn;
                })
                ->addColumn('barang', function($data){
                    return $data->barang->nama_barang;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
        return view('barangMasuk.index', compact('supplier'));
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
        $validator = Validator::make($request->all(), [
            'barang_id' => 'required',
            'tanggal' => 'required',
            'jumlah' => 'required',
        ], $messages = [
            'barang_id.required' => 'Kolom Nama Supplier Wajib Diisi',
            'tanggal.required' => 'Kolom No. Telepon Beli Wajib Diisi',
            'jumlah.required' => 'Kolom Alamat Wajib Diisi',
        ]);
        if($validator->passes()) {
            $nama = BarangMasuk::updateOrCreate(
                ['id' => $request->id],
                [
                    'barang_id' => $request->barang_id,
                    'tanggal' => $request->tanggal,
                    'jumlah' => $request->jumlah,
                ]
            );
            return response()->json($nama);
        }
        return response()->json(['error'=>$validator->errors()]);
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
