<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'alamat', 'pic', 'kontak', 'owner_user_id'];

    public function penempatans()
    {
        return $this->hasMany(Penempatan::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_user_id');
    }
}
