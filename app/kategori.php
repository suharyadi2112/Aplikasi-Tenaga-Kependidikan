<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    protected $table = "kategorisebagai";
    public $timestamps = true;
    protected $primaryKey = 'id_kategori';
    protected $fillable = (array('id_kategori', 'nama_kategori','created_at','updated_at'));
}
