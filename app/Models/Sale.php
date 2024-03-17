<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pembeli',
        'no_nota',
        'commodity_id',
        'satuan',
        'jumlah',
        'harga',
        'total_harga',
        'no_spb',
        'status',
        'supir',
        'no_plat',
        'jam_masuk',
        'jam_keluar',
        'no_hp',
    ];

    public function commodities()
    {
        return $this->belongsTo(Commodity::class, 'commodity_id');
    }
}
