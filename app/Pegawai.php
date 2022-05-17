<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = "pegawai";
    public $timestamps = true;
    protected $primaryKey = 'id_pegawai';
    protected $fillable = (array('id_pegawai', 'nip', 'nidn', 'nama_karyawan', 'jabatan','created_at','updated_at' ));

    public function jabatan_pegawai(){
    	return $this->hasMany('App\jabatan', 'foreign_key', 'id_pegawai_fk');
    }

}
