<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriWisataKuliner extends Model
{
    protected $table = 'kategori_wisata_kuliner';
    protected $primaryKey = 'id_kategori';
    public $timestamps = false;

    protected $fillable = [
        'id_wisata_kuliner',
        'id_kategori'
    ];

    public function wisatakuliner()
    {
        return $this->belongsTo(WisataKuliner::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }
}
