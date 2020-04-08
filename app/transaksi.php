<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    protected $table="transaksi";
    protected $fillable = ['id_pelanggan','id_mobil','id_petugas','tgl_pinjam','tgl_kembali','total'];
    public $timestamps = false;
}
