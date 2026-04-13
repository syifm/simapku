<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Preferensi extends Model
{
    protected $table = 'preferensi';
    protected $primaryKey = 'id_kategori';
    public $timestamps = false;

    protected $fillable = [
        'id_wisatawan',
        'id_kategori',
        'jumlah',
    ];

    public function preferensi()
    {
        return $this->belongsTo(Wisatawan::class, 'id_wisatawan', 'id_wisatawan');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }
}
