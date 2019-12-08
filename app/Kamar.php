<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    protected $table = 'kamar';
    protected $primaryKey = 'id_kamar';
    protected $fillable = [
        'id_penginapan', 'tipe', 'harga', 'fasilitas', 'kapasitas', 'created_at', 'updated_at'
    ];

    public function penginapan(){
        return $this->belongsTo('App/Penginapan');
    }
}
