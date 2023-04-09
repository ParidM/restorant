<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = "transaksi";
    protected $fillable = [
        'barang_id','pelanggan_id','tanggal','jumlah',
    ];

    public function barang(){
        return $this->belongsTo(Barang::class);
    }

    public function pelanggan(){
        return $this->belongsTo(Pelanggan::class);
    }
}
