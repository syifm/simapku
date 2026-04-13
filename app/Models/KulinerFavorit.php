<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KulinerFavorit extends Model
{
    protected $table = 'kuliner_favorit';
    protected $primaryKey = 'id_wisata_kuliner';
    public $timestamps = false;

    protected $fillable = [
        'id_wisatawan',
        'id_wisata_kuliner',
        'komentar',
        'waktu_dibuat',
    ];

    public function favorit()
    {
        return $this->belongsTo(Wisatawan::class, 'id_wisatawan', 'id_wisatawan');
    }

    public function kuliner()
    {
        return $this->belongsTo(WisataKuliner::class, 'id_wisata_kuliner');
    }
}
