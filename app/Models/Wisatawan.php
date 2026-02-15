<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wisatawan extends Model
{
    protected $table = 'wisatawan';
    public $timestamps = false;
    protected $primaryKey = 'id_wisatawan';

    protected $fillable = [
        'id_wisatawan',
        'user_id',
        'preferensi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function wisatakuliner()
    {
        return $this->hasMany(WisataKuliner::class, 'id_wisatawan', 'id_wisatawan');
    }

    public function penilaianDanUlasan()
    {
        return $this->hasMany(PenilaianDanUlasan::class, 'id_wisatawan', 'id_wisatawan');
    }

    public function diarikuliner()
    {
        return $this->hasMany(DiariKuliner::class, 'id_wisatawan', 'id_wisatawan');
    }
}
