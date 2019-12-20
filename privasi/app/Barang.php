<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    //
    public $incrementing = false;
    public $timestamps = false;
    protected $table = "barangs";
    protected $primaryKey = 'kode';
    protected $guarded = [];
}
