<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
	//protected $primaryKey = "idx";
	protected $table = "program_studi";
	protected $primaryKey = 'prodiKode';
	public $timestamps = false;
	//protected $fillable = ['prodiKode','prodiKodeJurusan','prodiNama'];

	//protected $fillable = array('idx','nama');
	public function Jurusan(){
    	return $this->hasMany('App\Jurusan', 'foreign_key', 'jurKode');
    }

}
