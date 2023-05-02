<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;

class Supplier extends Model
{
    use HasFactory, AutoNumberTrait;
    protected $table = "supplier";
    protected $fillable = [
        'nama_supplier','no_telp','alamat',
    ];

    public function getAutoNumberOptions()
    {
        return [
            'kode' => [
                'format' => 'SPL-'. date('Y') .'?', 
                'length' => 5 
            ]
        ];
    }
}
