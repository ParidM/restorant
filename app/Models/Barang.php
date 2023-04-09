<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = "barang";
    protected $fillable = [
        'supplier_id','nama_barang','harga','stok_barang',
    ];

    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
}
