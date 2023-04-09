<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Supplier;
use Illuminate\Http\Request;
use DataTables;
use Validator;

class BarangController extends Controller
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
        $supplier = Supplier::pluck('nama_supplier', 'id');
        if ($request->ajax()) {
            $data = Barang::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn ='<a href="#" data-toggle="tooltip" title="Edit" data-id="'.$row->id.'" data-original-title="Barcode" class="btn btn-success btn-sm barcod"><i class="metismenu-icon pe-7s-plugin"></i></a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip" title="Edit" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-warning btn-sm edit"><i class="metismenu-icon pe-7s-pen"></i></a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip" title="Hapus" data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm delete"><i class="metismenu-icon pe-7s-trash"></i></a>';
                    return $btn;
                })
                ->addColumn('supplier', function($data){
                    return $data->supplier->nama_supplier;
                })
                ->addColumn('harga', function($data){
                    return "Rp. ".number_format($data->harga);
                })
                ->rawColumns(['action'])
                ->make(true);
            }
        return view('barang.index', compact('supplier'));
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
            'nama_barang' => 'required',
            'supplier_id' => 'required',
            'harga' => 'required',
            'stok_barang' => 'required',
        ], $messages = [
            'nama_barang.required' => 'Kolom Nama barang Wajib Diisi',
            'supplier_id.required' => 'Kolom No. Telepon Beli Wajib Diisi',
            'harga.required' => 'Kolom Alamat Wajib Diisi',
            'stok_barang.required' => 'Kolom Alamat Wajib Diisi',
        ]);
        if($validator->passes()) {
            $nama = Barang::updateOrCreate(
                ['id' => $request->id],
                [
                    'nama_barang' => $request->nama_barang,
                    'supplier_id' => $request->supplier_id,
                    'harga' => $request->harga,
                    'stok_barang' => $request->stok_barang,
                ]
            );
            return response()->json($nama);
        }
        return response()->json(['error'=>$validator->errors()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $barang = Barang::find($id);
        return view('barang.show', compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $barang = Barang::find($id);
        return response()->json($barang);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, barang $barang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function hapus($id)
    {
        $barang = Barang::find($id);
        $barang->delete();
        return response()->json($barang);
    }
}
