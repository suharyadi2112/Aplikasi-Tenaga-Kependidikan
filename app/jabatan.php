<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $table = "jabatan_pegawai";
    public $timestamps = false;
    protected $primarykey = 'id_jabatan';
    protected $fillable = (array('id_pegawai', 'id_pegawai_fk', 'nm_jabatan'));

   
}
