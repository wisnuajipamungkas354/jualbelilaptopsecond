<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaptopImages extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function DataLaptop()
    {
        return $this->belongsTo(DataLaptop::class);
    }
}
