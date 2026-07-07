<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WisataKuliner extends Model
{
    protected $table = 'wisata_kuliner';
    protected $primaryKey = 'id_wisata_kuliner';
    const CREATED_AT = 'waktu_dibuat';
    const UPDATED_AT = 'waktu_diubah';

    protected $fillable = [
        'nama',
        'kecamatan',
        'kelurahan',
        'alamat',
        'no_telp',
        'deskripsi',
        'foto',
        'latitude',
        'longitude',
        'harga_min',
        'harga_max',
        'penilaian',
        'sertifikat_halal',
        'id_user',
        'status_operasional',
        'waktu_dibuat',
        'waktu_diubah',
    ];

    public function fasilitas()
    {
        return $this->belongsToMany(
            Fasilitas::class,
            'fasilitas_wisata_kuliner',
            'id_wisata_kuliner',
            'id_fasilitas'
        );
    }

    public function ulasan()
    {
        return $this->hasMany(Ulasan::class, 'id_wisata_kuliner', 'id_wisata_kuliner');
    }

    public function verifikasiadmin()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function kategori()
    {
        return $this->belongsToMany(
            Kategori::class,
            'kategori_wisata_kuliner',
            'id_wisata_kuliner',
            'id_kategori'
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
