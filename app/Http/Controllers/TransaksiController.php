<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Barang;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
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
        $pelanggan = Pelanggan::pluck('nama_pelanggan', 'id');
        $barang = Barang::pluck('nama_barang', 'id');
        if ($request->ajax()) {
            $data = Transaksi::all();
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
                ->addColumn('pelanggan', function($data){
                    return $data->pelanggan->nama_pelanggan;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
        return view('transaksi.index', compact('barang','pelanggan'));
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
            'pelanggan_id' => 'required',
            'tanggal' => 'required',
            'jumlah' => 'required',
        ], $messages = [
            'barang_id.required' => 'Kolom Nama barang Wajib Diisi',
            'pelanggan_id.required' => 'Kolom Nama barang Wajib Diisi',
            'tanggal.required' => 'Kolom Nama barang Wajib Diisi',
            'jumlah.required' => 'Kolom Nama barang Wajib Diisi',
        ]);
        if($validator->passes()) {
            $nama = Transaksi::updateOrCreate(
                ['id' => $request->id],
                [
                    'barang_id' => $request->barang_id,
                    'pelanggan_id' => $request->pelanggan_id,
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