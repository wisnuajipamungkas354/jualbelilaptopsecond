<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPengajuan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_pengajuan';
    public $incrementing = false;
    protected $fillable = ['id_pengajuan', 'nm_penjual', 'no_hp', 'alamat', 'platform', 'merk', 'tipe', 'processor', 'memory', 'storage', 'uk_layar', 'is_touchscreen', 'info_tambahan', 'kelengkapan', 'minus', 'harga', 'grade', 'jml_barang', 'status_pengajuan'];
}
