<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;

class Pelanggan extends Model
{
    use HasFactory, AutoNumberTrait;
    protected $table = "pelanggan";
    protected $fillable = [
        'nama_pelanggan','jk','no_telp','alamat',
    ];

    public function getAutoNumberOptions()
    {
        return [
            'kode' => [
                'format' => 'CRM-'. date('Y') .'?', 
                'length' => 5 
            ]
        ];
    }
}