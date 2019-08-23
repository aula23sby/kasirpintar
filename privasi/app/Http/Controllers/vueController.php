<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Server;
class vueController extends Controller
{
    //
    public function index(){
    	echo"hello selamat datang di Kudou.com";
    }
    public function server(){
    	//$beranda = Server::all();
    	//$serv = DB::table('pemakai')->get();
    	//return View('server',compact('beranda'));
	}
	public function about(){
		echo"Saya adalah web developer";
	}
	public function data_pegawai(Request $request){
		$people = Server::all();
		return View('pagegit',compact('people'));
	}
}
