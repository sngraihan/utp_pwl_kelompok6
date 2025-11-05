<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'alamat',
        'pic',
        'kontak',
    ];

    public function penempatans()
    {
        return $this->hasMany(Penempatan::class);
    }
}
