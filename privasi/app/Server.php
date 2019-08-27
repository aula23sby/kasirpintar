<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Server extends Model
{
	use SoftDeletes;
	protected $table = "servers";
	protected $primaryKey = 'id_pegawai';
	protected $guarded = []; //fillable all
	protected $dates = ['deleted_at'];
	public function post(){
		return $this->hasOne('App\Post', 'id_pelamar', 'id_pegawai');
	}
}
