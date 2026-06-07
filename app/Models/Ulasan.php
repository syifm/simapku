<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    protected $table = 'ulasan';
    protected $primaryKey = 'id_ulasan';
    const CREATED_AT = 'waktu_dibuat';
    const UPDATED_AT = 'waktu_diubah';

    protected $fillable = [
        'id_wisata_kuliner',
        'penilaian',
        'ulasan',
        'foto_ulasan',
        'harga_min',
        'harga_max',
        'id_wisatawan',
        'id_admin',
        'status',
        'status_penampilan',
        'waktu_dibuat',
        'waktu_diubah',
    ];

    public function wisataKuliner()
    {
        return $this->belongsTo(WisataKuliner::class, 'id_wisata_kuliner', 'id_wisata_kuliner');
    }

    public function wisatawan()
    {
        return $this->belongsTo(Wisatawan::class, 'id_wisatawan', 'id_wisatawan');
    }

    public function verifikasiulasan()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }
}
