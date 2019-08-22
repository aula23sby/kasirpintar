<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Server;
class vueController extends Controller
{
    //
    public function server(){
    	$beranda = Server::all();
    	//$serv = DB::table('pemakai')->get();
    	return View('server',compact('beranda'));
	}
}
