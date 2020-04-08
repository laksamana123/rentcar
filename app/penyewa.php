<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class penyewa extends Model
{
    protected $table="penyewa";
    protected $fillable = ['nama_penyewa','alamat','telp', 'foto_ktp'];
    public $timestamps = false;
}
