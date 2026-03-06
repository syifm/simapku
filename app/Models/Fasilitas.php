<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    protected $table = 'fasilitas';
    protected $primaryKey = 'id_fasilitas';
    public $timestamps = false;

    protected $fillable = [
        'id_fasilitas',
        'nama',
    ];

    // public function fasilitas()
    // {
    //     return $this->hasmany(FasilitasWisataKuliner::class);
    // }
    // public function wisataKuliner()
    // {
    //     return $this->belongsToMany(WisataKuliner::class, 'fasilitas_wisata_kuliner');
    // }
    public function wisataKuliner()
    {
        return $this->belongsToMany(
            WisataKuliner::class,
            'fasilitas_wisata_kuliner',
            'id_fasilitas',
            'id_wisata_kuliner'
        );
    }
}
