<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nim',
        'nama',
        'jurusan',
        'angkatan',
        'kontak_pribadi',
    ];

    // kolom terenkripsi
    protected $casts = [
        'kontak_pribadi' => 'encrypted',
    ];

    // relasi
    public function penempatans()
    {
        return $this->hasMany(Penempatan::class);
    }

    public function absensis()
    {
        return $this->hasMany(Absensi::class);
    }
}
