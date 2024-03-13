<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komoditas extends Model
{
    use HasFactory;

    protected $fillable = [
        'komoditas',
    ];

    public function material()
    {
        return $this->hasMany(Material::class);
    }
}
