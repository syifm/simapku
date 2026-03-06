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
        'email',
        'foto',
        'deskripsi',
        'longitude',
        'latitude',
        'email_pengaju',
        'id_wisatawan',
        'id_admin',
        'status',
        'waktu_dibuat',
        'waktu_diubah',
    ];

    // public function fasilitaswisatakuliner()
    // {
    //     return $this->hasMany(FasilitasWisataKuliner::class, 'id_wisata_kuliner', 'id_wisata_kuliner');
    // }
    // public function fasilitas()
    // {
    //     return $this->belongsToMany(Fasilitas::class, 'fasilitas_wisata_kuliner');
    // }
    public function fasilitas()
    {
        return $this->belongsToMany(
            Fasilitas::class,
            'fasilitas_wisata_kuliner',
            'id_wisata_kuliner',
            'id_fasilitas'
        );
    }

    public function menu()
    {
        return $this->hasMany(Menu::class, 'id_wisata_kuliner', 'id_wisata_kuliner');
    }

    public function penilaianDanUlasan()
    {
        return $this->hasMany(PenilaianDanUlasan::class, 'id_wisata_kuliner', 'id_wisata_kuliner');
    }

    public function pengaju()
    {
        return $this->belongsTo(Wisatawan::class, 'id_wisatawan');
    }

    public function verifikasiadmin()
    {
        return $this->belongsTo(Admin::class, 'id_admin');
    }
}
