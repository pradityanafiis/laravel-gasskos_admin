<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    protected $table = 'fasilitas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_penginapan', 'id_fasilitas'
    ];

    public function penginapan(){
        return $this->belongsTo('App\Penginapan', 'id_penginapan');
    }
    
    public function fasilitas(){
        return $this->belongsTo('App\Fasilitas', 'id_fasilitas');
    }
}
