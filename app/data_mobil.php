<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class data_mobil extends Model
{
    protected $table="mobil";
    protected $fillable = ['id_jenis','nama_mobil','plat_nomor','merk','keterangan'];
    public $timestamps = false;
}
