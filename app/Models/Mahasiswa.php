<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $fillable = ['npm', 'nama', 'jurusan', 'angkatan', 'kontak_pribadi', 'user_id'];

    protected $casts = [
        'kontak_pribadi' => 'encrypted',
    ];

    public function penempatan()
    {
        return $this->hasOne(Penempatan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
