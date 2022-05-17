<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jurusan extends Model
{
    protected $table = "jurusan";
    public $timestamps = false;
    protected $primarykey = 'jurKode';
    protected $fillable = (array('jurKode', 'jurNama'));

    public function prodi(){

    	return $this->hasMany('App\Prodi','foreign_key','prodiKodeJurusan'); 

    }
}
