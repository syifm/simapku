<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    protected $table = 'fasilitas';
    protected $primaryKey = 'id_fasilitas';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'status'
    ];

    public function wisataKuliner()
    {
        return $this->belongsToMany(
            WisataKuliner::class,
            'fasilitas_wisata_kuliner',
            'id_fasilitas',
            'id_wisata_kuliner'
        );
    }

    public function pengajuanwisataKuliner()
    {
        return $this->belongsToMany(
            PengajuanWisataKuliner::class,
            'pengajuan_fasilitas_wisata_kuliner',
            'id_fasilitas',
            'id_pengajuan'
        );
    }
}
