<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'penempatan_id',
        'tanggal',
        'shift',
        'wajib',
    ];

    public function penempatan()
    {
        return $this->belongsTo(Penempatan::class);
    }
}
