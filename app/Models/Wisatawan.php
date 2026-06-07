<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wisatawan extends Model
{
    protected $table = 'wisatawan';
    public $timestamps = false;
    protected $primaryKey = 'id_wisatawan';

    protected $fillable = [
        // 'id_wisatawan',
        'user_id',
        'asal_kota',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function wisatakuliner()
    {
        return $this->hasMany(WisataKuliner::class, 'id_wisatawan', 'id_wisatawan');
    }

    public function ulasan()
    {
        return $this->hasMany(Ulasan::class, 'id_wisatawan', 'id_wisatawan');
    }
}
