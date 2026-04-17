<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanWisataKuliner extends Model
{
    protected $table = 'pengajuan_wisata_kuliner';
    protected $primaryKey = 'id_pengajuan';
    const CREATED_AT = 'waktu_dibuat';
    const UPDATED_AT = 'waktu_diubah';

    protected $fillable = [
        'id_wisata_kuliner',
        'nama',
        'kecamatan',
        'kelurahan',
        'alamat',
        'no_telp',
        'email',
        'deskripsi',
        'foto',
        'longitude',
        'latitude',
        'harga_min',
        'harga_max',
        'penilaian',
        'email_pengaju',
        'id_wisatawan',
        'id_admin',
        'status',
        'waktu_dibuat',
        'waktu_diubah',
    ];

    public function fasilitas()
    {
        return $this->belongsToMany(
            PengajuanFasilitasWisataKuliner::class,
            'pengajuan_fasilitas_wisata_kuliner',
            'id_pengajuan',
            'id_fasilitas'
        );
    }

    public function menu()
    {
        return $this->hasMany(Menu::class, 'id_wisata_kuliner', 'id_wisata_kuliner');
    }

    // public function penilaianDanUlasan()
    // {
    //     return $this->hasMany(PenilaianDanUlasan::class, 'id_wisata_kuliner', 'id_wisata_kuliner');
    // }

    public function pengaju()
    {
        return $this->belongsTo(Wisatawan::class, 'id_wisatawan');
    }

    public function verifikasiadmin()
    {
        return $this->belongsTo(Admin::class, 'id_admin');
    }

    public function kategori()
    {
        return $this->belongsToMany(
            PengajuanKategoriWisataKuliner::class,
            'pengajuan_kategori_wisata_kuliner',
            'id_pengajuan',
            'id_kategori'
        );
    }
}
