<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Absensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'penempatan_id',
        'mahasiswa_id',
        'tanggal',
        'status',
        'jam_masuk',
        'jam_pulang',
        'alasan_izin',
        'catatan_harian',
        'verifikasi_pembimbing',
        'diverifikasi_oleh',
    ];

    // kolom terenkripsi
    protected $casts = [
        'alasan_izin' => 'encrypted',
        'catatan_harian' => 'encrypted',
    ];

    public function penempatan()
    {
        return $this->belongsTo(Penempatan::class);
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function pembimbing()
    {
        return $this->belongsTo(User::class, 'diverifikasi_oleh');
    }
}
