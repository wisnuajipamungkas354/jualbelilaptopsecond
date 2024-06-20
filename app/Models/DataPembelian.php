<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPembelian extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_pembelian',
        'nm_pembeli',
        'no_hp', 'alamat',
        'mtd_pembayaran',
        'id_laptop',
        'jml_barang',
        'total_pembayaran',
        'status_pembelian'
    ];

    protected $primaryKey = 'id_pembelian';
    public $incrementing = false;
    public $keyType = "string";

    public function DataLaptop()
    {
        return $this->belongsTo(DataLaptop::class);
    }
}
