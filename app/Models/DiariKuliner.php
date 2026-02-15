<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiariKuliner extends Model
{
    protected $table = 'diari_kuliner';
    protected $primaryKey = 'id_diari_kuliner';
    const CREATED_AT = 'waktu_dibuat';
    const UPDATED_AT = 'waktu_diubah';

    protected $fillable = [
        'id_diari_kuliner',
        'id_wisatawan',
        'judul',
        'deskripsi',
        'foto',
        'waktu_dibuat',
        'waktu_diubah',
    ];

    public function pembuat()
    {
        return $this->belongsTo(Wisatawan::class, 'id_wisatawan', 'id_wisatawan');
    }
}
