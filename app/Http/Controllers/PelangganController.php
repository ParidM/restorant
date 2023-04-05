<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DNS2D;
use DataTables;
use Validator;

class PelangganController extends Controller
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
        if ($request->ajax()) {
            $data = Pelanggan::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn ='<a href="#" data-toggle="tooltip" title="Edit" data-id="'.$row->id.'" data-original-title="Barcode" class="btn btn-success btn-sm barcod"><i class="metismenu-icon pe-7s-plugin"></i></a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip" title="Edit" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-warning btn-sm edit"><i class="metismenu-icon pe-7s-pen"></i></a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip" title="Hapus" data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm delete"><i class="metismenu-icon pe-7s-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
        return view('pelanggan.index');
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
            'nama_pelanggan' => 'required',
            'jk' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
        ], $messages = [
            'nama.required' => 'Kolom Nama Pelanggan Wajib Diisi',
            'ukuran.required' => 'Kolom Ukuran Wajib Diisi',
            'no_telp.required' => 'Kolom No. Telepon Beli Wajib Diisi',
            'alamat.required' => 'Kolom Alamat Wajib Diisi',
        ]);
        if($validator->passes()) {
            $nama = Pelanggan::updateOrCreate(
                ['id' => $request->id],
                [
                    'nama_pelanggan' => $request->nama_pelanggan,
                    'jk' => $request->jk,
                    'no_telp' => $request->no_telp,
                    'alamat' => $request->alamat,
                ]
            );
            return response()->json($nama);
        }
        return response()->json(['error'=>$validator->errors()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pelanggan = Seragam::find($id);
        return view('pelanggan.show', compact('pelanggan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pelanggan = Pelanggan::find($id);
        return response()->json($pelanggan);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pelanggan $pelanggan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function hapus($id)
    {
        $pelanggan = Pelanggan::find($id);
        $pelanggan->delete();
        return response()->json($pelanggan);
    }
}
