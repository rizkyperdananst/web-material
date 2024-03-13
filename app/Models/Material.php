<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'komoditas_id',
        'satuan',
        'stok',
        'harga',
    ];

    public function komoditas()
    {
        return $this->belongsTo(Komoditas::class, 'komoditas_id');
    }
}
