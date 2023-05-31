<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;

class BarangMasuk extends Model
{
    use HasFactory,AutoNumberTrait;
    protected $table = "barang_masuk";
    protected $fillable = [
        'user_id','diterima','kembali','total'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getAutoNumberOptions()
    {
        return [
            'kode' => [
                'format' => 'BRM-'. date('Y') .'?', 
                'length' => 5 
            ]
        ];
    }
}
