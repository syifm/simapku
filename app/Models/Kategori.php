<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'jenis_kategori',
        'status'
    ];

    public function wisataKuliner()
    {
        return $this->belongsToMany(
            WisataKuliner::class,
            'kategori_wisata_kuliner',
            'id_kategori',
            'id_wisata_kuliner'
        );
    }

    public function pengajuanwisataKuliner()
    {
        return $this->belongsToMany(
            PengajuanWisataKuliner::class,
            'pengajuan_kategori_wisata_kuliner',
            'id_kategori',
            'id_pengajuan'
        );
    }
}
