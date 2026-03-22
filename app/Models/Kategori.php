<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    public $timestamps = false;

    protected $fillable = [
        'id_kategori',
        'nama',
    ];

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
