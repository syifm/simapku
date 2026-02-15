<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    protected $primaryKey = 'id_menu';
    public $timestamps = false;

    protected $fillable = [
        'id_menu',
        'id_wisata_kuliner',
        'nama',
        'harga',
        'deskripsi',
        'foto',
    ];

    public function wisataKuliner()
    {
        return $this->belongsTo(WisataKuliner::class, 'id_wisata_kuliner', 'id_wisata_kuliner');
    }
}
