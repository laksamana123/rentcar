<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class penyewa extends Model
{
    protected $table="penyewa";
    protected $fillable = ['nama_penyewa','alamat','telp', 'no_ktp', 'foto_ktp'];
    public $timestamps = false;
}