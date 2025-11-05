<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penempatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'mahasiswa_id',
        'perusahaan_id',
        'pembimbing_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
    ];

    // relasi
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class);
    }

    public function pembimbing()
    {
        return $this->belongsTo(User::class, 'pembimbing_id');
    }

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }

    public function absensis()
    {
        return $this->hasMany(Absensi::class);
    }
}
