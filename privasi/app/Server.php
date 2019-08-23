<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    //
    //protected $table = "pemakai";
	//protected $fillable = ['id'.'nama', 'email','password'];

	protected $table = "servers";
	protected $guarded = []; //fillable all
}
