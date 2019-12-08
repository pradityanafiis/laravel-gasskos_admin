<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penginapan extends Model
{
    protected $table = 'penginapan';
    protected $primaryKey = 'id_penginapan';
    protected $fillable = [
        'id_users', 'nama', 'alamat', 'latitude', 'longitude', 'telepon', 'created_at', 'updated_at'
    ];

    public function user(){
        return $this->belongsTo('App/User');
    }

    public function kamar(){
        return $this->hasMany('App/Kamar');
    }
}
