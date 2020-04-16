<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    protected $table="transaksi";
    protected $fillable = ['id_penyewa','id_mobil','id_petugas','tgl_trans','tgl_selesai'];
    public $timestamps = false;
}
