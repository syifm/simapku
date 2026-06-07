<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanFasilitasWisataKuliner extends Model
{
    protected $table = 'pengajuan_fasilitas_wisata_kuliner';
    protected $primaryKey = 'id_fasilitas';
    public $timestamps = false;

    // protected $fillable = [
    //     'id_pengajuan',
    //     'id_fasilitas',
    // ];

    public function wisatakuliner()
    {
        return $this->belongsTo(WisataKuliner::class);
    }

    public function fasilitas()
    {
        return $this->belongsTo(Fasilitas::class, 'id_fasilitas');
    }
}
