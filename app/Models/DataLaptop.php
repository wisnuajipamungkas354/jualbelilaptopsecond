<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataLaptop extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_laptop';
    public $incrementing = false;
    protected $fillable = ['id_laptop', 'platform', 'merk', 'tipe', 'processor', 'memory', 'storage', 'uk_layar', 'is_touchscreen', 'info_tambahan', 'kelengkapan', 'minus', 'harga', 'grade', 'stok'];

    public function LaptopImages()
    {
        return $this->hasMany(LaptopImages::class);
    }

    public function DataPembelian()
    {
        return $this->hasMany(DataPembelian::class);
    }
}
