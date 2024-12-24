<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;

    protected $table = 'kendaraans';

    protected $fillable = [
        'nama_kendaraan',
        'jenis_kendaraan',
        'status',
        'images',
        'no_plat',
    ];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'id_kendaraan');
    }
}
