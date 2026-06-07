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
        'longitude',
        'latitude',
        'harga_min',
        'harga_max',
        'penilaian',
        'sertifikat_halal',
        'id_wisatawan',
        'id_admin',
        'status',
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

    public function wisatawan()
    {
        return $this->belongsTo(Wisatawan::class, 'id_wisatawan');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin');
    }

    public function verifikasiadmin()
    {
        return $this->belongsTo(Admin::class, 'id_admin');
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
}
