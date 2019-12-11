<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FotoPenginapan extends Model
{
    protected $table = 'foto_penginapan';
    protected $primaryKey = 'id_foto';
    protected $fillable = [
        'id_penginapan', 'path'
    ];

    public function penginapan(){
        return $this->belongsTo('App\Penginapan', 'id_penginapan');
    }
}
