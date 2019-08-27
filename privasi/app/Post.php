<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $table = 'posts';
    //protected $fillable = ['title','description','image'];
    protected $guarded = []; 
    public function server(){
    	return $this->belongsTo('App\Server');
    }
}
