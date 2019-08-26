<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Redirect; //untuk redirect
use App\Server;
use App\Http\Requests\SimpanPegawaiRequest;
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
		$people = Server::orderBy('id_pegawai', 'desc')->paginate(15);
		$rank = $people->firstItem();
		return View('pagegit',compact('people','rank'));
	}
	public function cari_pegawai(Request $request){
		$people = Server::where('nama_pegawai', 'like','%'.$request->cari.'%')
		->orWhere('alamat_pegawai', 'like','%'.$request->cari.'%')
		->orderBy('id_pegawai', 'desc')
		->paginate(15);
		 $rank = $people->firstItem();
		return View('pagegit',compact('people','rank'));
	}
	public function simpan_pegawai(SimpanPegawaiRequest $request){
		//jika tdk menggunakan request
		/*
		$messages = [
		    'required' => ':attribute wajib diisi cuy!!!',
		    'umur_pegawai.numeric' => ':attribute harus angka',
		    'umur_pegawai.max' => ':attribute harus diisi maksimal :max karakter ya cuy!!!',
		];
		$request->validate([
    		'nama_pegawai' => 'required|max:150',
    		'umur_pegawai' => 'required|numeric|max:150',
		], $messages);
		*/
		//jika menggunakan request
		//dd(Server::create($request->all()));
		$validated = $request->validated();
		$nama = $request->nama_pegawai;
        if($validated){
        	Server::create($request->all());
        	//$flight = new Server;
        	//$flight->nama_pegawai = $request->nama;
        	//$flight->save($request->all());
        	return Redirect::to('/sqlserver/pegawai')->with('message',''.$nama);
    	}else{
    		return back();
    	}
	}
	public function edit_pegawai($id){
		$people = Server::findOrFail($id);
		return View('pegawai.tambah',compact('people'));
	}
}
