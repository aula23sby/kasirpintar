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

	public function data_pegawai(){
		$people = Server::all();
		//dd($people);
		
		return View('pagegit',compact('people'));
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
		$validated = $request->validated();
		$nama = $request->nama_pegawai;
        Server::create($request->all());
        return Redirect::to('/sqlserver/pegawai')->with('message',''.$nama);
	}
	public function edit_pegawai($id){
		$people = Server::findOrFail($id);
		return View('pegawai.tambah',compact('people'));
	}
	public function update_pegawai($id, SimpanPegawaiRequest $request){
		$people = Server::findOrFail($id);
		$validated = $request->validated();
		$people->update($request->all());
		$nama = $request->nama_pegawai;
		return Redirect::to('/sqlserver/pegawai')->with('update',''.$nama);
	}
	public function hapus_pegawai($id){
		$people = Server::findOrFail($id);
		$nama = $people->nama_pegawai;
		//dd($nama);
        $people->delete();
		return Redirect::to('/sqlserver/pegawai')->with('hapus',''.$nama);
	}
	public function trash_pegawai(){
		$people = Server::orderBy('deleted_at', 'desc')->onlyTrashed()->paginate(5);
		$rank = $people->firstItem();
		return View('pegawai.trash',compact('people','rank'));
	}
	public function restore_pegawai($id){
		$people = Server::onlyTrashed()->findOrFail($id);
		$people->restore();
		$nama = $people->nama_pegawai;
		return Redirect::to('/sqlserver/pegawai')->with('restore',''.$nama);
	}
	public function delete_pegawai($id){
		$people = Server::onlyTrashed()->findOrFail($id);
		$people->forceDelete();
		$nama = $people->nama_pegawai;
		return Redirect::to('/sqlserver/pegawai/trash')->with('delete',''.$nama);
	}
	public function restores_pegawai(){
		$people = Server::onlyTrashed();
		$people->restore();
		return Redirect::to('/sqlserver/pegawai')->with('restores','');
	}
	public function deletes_pegawai(){
		$people = Server::onlyTrashed();
		$people->forceDelete();
		return Redirect::to('/sqlserver/pegawai/trash')->with('deletes','');
	}
}
