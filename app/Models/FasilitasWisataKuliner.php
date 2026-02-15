<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FasilitasWisataKuliner extends Model
{
    protected $table = 'fasilitas_wisata_kuliner';
    protected $primaryKey = 'id_fasilitas_wisata_kuliner';
    public $timestamps = false;

    protected $fillable = [
        'id_wisata_kuliner',
        'id_fasilitas',
        'deskripsi',
    ];

    public function wisatakuliner()
    {
        return $this->belongsTo(WisataKuliner::class);
    }

    public function fasilitas()
    {
        return $this->belongsTo(Fasilitas::class);
    }
}
