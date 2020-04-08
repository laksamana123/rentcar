<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jenis_mobil extends Model
{
    protected $table="jenis_mobil";
    protected $fillable = ['jenis_mobil'];
    public $timestamps = false;
}
