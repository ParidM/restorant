<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;

class Barang extends Model
{
    use HasFactory, AutoNumberTrait;
    protected $table = "barang";
    protected $fillable = [
        'supplier_id','nama_barang','harga','stok_barang',
    ];

    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }

    public function getAutoNumberOptions()
    {
        return [
            'kode' => [
                'format' => 'PRO-'. date('Y') .'?', 
                'length' => 5 
            ]
        ];
    }
}
