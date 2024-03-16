<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'commodity_id',
        'satuan',
        'stok',
        'harga',
    ];

    public function komoditas()
    {
        return $this->belongsTo(Commodity::class, 'commodity_id');
    }
}
