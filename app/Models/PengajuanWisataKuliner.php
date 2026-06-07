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
        'deskripsi',
        'foto',
        'longitude',
        'latitude',
        'sertifikat_halal',
        'id_wisatawan',
        'id_admin',
        'status',
        'status_operasional',
        'jenis_pengajuan',
        'waktu_dibuat',
        'waktu_diubah',
    ];

    public function fasilitas()
    {
        return $this->belongsToMany(
            Fasilitas::class,
            'pengajuan_fasilitas_wisata_kuliner',
            'id_pengajuan',
            'id_fasilitas'
        );
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
            'pengajuan_kategori_wisata_kuliner',
            'id_pengajuan',
            'id_kategori'
        );
    }
}
