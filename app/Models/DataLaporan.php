<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataLaporan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = [
        'id',
        'tahun',
        'bulan',
        'terjual',
        'dibeli',
        'pemasukan',
        'pengeluaran',
        'jml_trx'
    ];
}
