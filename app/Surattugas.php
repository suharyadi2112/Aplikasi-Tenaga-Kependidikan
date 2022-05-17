<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Surattugas extends Model
{
    protected $table = "surat_tugas";
    public $timestamps = true;
    protected $primaryKey = 'id_surattugas';
    protected $fillable = (array('id_surattugas', 'nomor_surat', 'kategori_fk', 'nama_kegiatan', 'penyelengara','tanggal_kegiatan_mulai','tanggal_kegiatan_selesai','jam_kegiatan_mulai','jam_kegiatan_selesai','status_acc','lokasi','tanggal_acc','created_at','updated_at' ));


}
