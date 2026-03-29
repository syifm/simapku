<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenilaiandanUlasan extends Model
{
    protected $table = 'penilaian_dan_ulasan';
    protected $primaryKey = 'id_penilaian_dan_ulasan';
    const CREATED_AT = 'waktu_dibuat';
    const UPDATED_AT = 'waktu_diubah';

    protected $fillable = [
        'id_wisata_kuliner',
        'penilaian',
        'ulasan',
        'foto_ulasan',
        'harga_total',
        'email_pengulas',
        'id_wisatawan',
        'id_admin',
        'status',
        'waktu_dibuat',
        'waktu_diubah',
    ];

    public function wisataKuliner()
    {
        return $this->belongsTo(WisataKuliner::class, 'id_wisata_kuliner', 'id_wisata_kuliner');
    }

    public function pengulas()
    {
        return $this->belongsTo(Wisatawan::class, 'id_wisatawan', 'id_wisatawan');
    }

    public function verifikasipenilaianulasan()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }
}
