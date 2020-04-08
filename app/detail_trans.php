<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detail_trans extends Model
{
    protected $table="detail_trans";
    protected $fillable = ['id_trans','id_mobil','qty','subtotal','denda'];
    public $timestamps = false;
}
