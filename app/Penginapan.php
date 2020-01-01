<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penginapan extends Model
{
    protected $table = 'penginapan';
    protected $primaryKey = 'id_penginapan';
    protected $fillable = [
        'id_users', 'gender', 'nama', 'alamat', 'latitude', 'longitude', 'telepon', 'created_at', 'updated_at'
    ];
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function user(){
        return $this->belongsTo('App\User', 'id_users');
    }

    public function kamar(){
        return $this->hasMany('App\Kamar');
    }

    public function fasilitas(){
        return $this->belongsToMany('App\MasterFasilitas');
    }

    public function fotoPenginapan(){
        return $this->hasMany('App\FotoPenginapan');
    }
}
