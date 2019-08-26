<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    //
    //protected $table = "pemakai";
	//protected $fillable = ['id'.'nama', 'email','password'];

	protected $table = "servers";
	protected $primaryKey = 'id_pegawai';
	//protected $fillable = ['id_pegawai','nama_pegawai','jabatan_pegawai','umur_pegawai','alamat_pegawai'];
	protected $guarded = []; //fillable all
}
