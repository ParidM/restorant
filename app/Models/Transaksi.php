<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;

class Transaksi extends Model
{
    use HasFactory,AutoNumberTrait;
    protected $table = "transaksi";
    protected $fillable = [
        'user_id','pelanggan_id','diterima','kembali','total'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function pelanggan(){
        return $this->belongsTo(Pelanggan::class);
    }

    public function getAutoNumberOptions()
    {
        return [
            'kode' => [
                'format' => 'TRS-'. date('Y') .'?', 
                'length' => 5 
            ]
        ];
    }
}
