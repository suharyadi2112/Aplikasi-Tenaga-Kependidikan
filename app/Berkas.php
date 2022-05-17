<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Berkas extends Model
{
   	protected $table = "berkas";
    public $timestamps = true;
    protected $primarykey = 'id_file';
    protected $fillable = (array('id_file', 'id_srt_tgs_fk', 'file_name','file_size','created_at','updated_at'));


    public function Surattugas(){
    	return $this->hasMany('App\SuratTugas', 'foreign_key', 'id_surattugas');
    }
}
