<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin';
    public $timestamps = false;
    protected $primaryKey = 'id_admin';

    protected $fillable = [
        'id_admin',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function wisatakuliner()
    {
        return $this->hasMany(WisataKuliner::class, 'id_admin', 'id_admin');
    }

    public function penilaianDanUlasan()
    {
        return $this->hasMany(PenilaianDanUlasan::class, 'id_admin', 'id_admin');
    }
}
