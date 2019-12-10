<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterFasilitas extends Model
{
    protected $table = 'master_fasilitas';
    protected $primaryKey = 'id_fasilitas';
    
    public function penginapan(){
        return $this->belongsToMany('App\Penginapan');
    }
}
