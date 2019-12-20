<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use App\Barang;
use Auth;
use Illuminate\Support\Facades\Validator;
class BarangController extends Controller
{
    public function __construct()
    {
        $guestt = str_replace('/','',Request()->route()->getPrefix());
        if($guestt == "owner"){
            Log::info("Midleware owner");
            $this->middleware('auth:owner');
        }else if($guestt == "admin"){
            Log::info("Midleware admin");
            $this->middleware('auth:admin');
        }else if($guestt == "staff"){
            Log::info("Midleware staff");
            $this->middleware('auth:staff');
        }
    }
    public function index()
    {
        $guestt = str_replace('/','',Request()->route()->getPrefix()); // /admin replace admin
        Log::info("GUEST: ".$guestt);
        $barangs = Barang::orderBy('nama', 'asc')->paginate(20);;
        $kdBrg = "BRG_1";
        if($guestt == "owner"){
            $kdBrg = $this->getKodeNew();
        }
        return view('barang',compact('guestt','barangs','kdBrg'));
    }
    private function getKodeNew(){
        $kdBrg = "BRG_1";
        $barangs = Barang::all();
        $kodes=array();
        if(is_countable($barangs)){
            if(count($barangs) > 0){
                 foreach($barangs as $barang){
                    $kd_string = explode("_",$barang->kode);
                    $kd_int = (int) $kd_string[1];
                    array_push($kodes, $kd_int);
                }
                $kd_max = max($kodes);
                $kd_max++;
                $kdBrg = "BRG_".$kd_max;
            }
        }
       
        return $kdBrg;
        /*
        $barangnew = Barang::first();
        if($barangnew != null){
            $kd_string = explode("_",$barangnew->kode);
            $kd_int = (int) $kd_string[1];
            $kd_int++;
            $kdBrg = "BRG_".$kd_int;
        }*/

       
    }
    public function add(Request $request){
        $rules = [
            'nama' => 'required',
            'stock' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
        ];
        $validated = Validator::make($request->all(), $rules);
        if($validated->fails()){
            return redirect()->back()->with('failed', 'Isi semua inputan');
        }

        $save = Barang::create($request->all());
        if($save){
            return redirect()->back()->with('success', 'Berhasil menambah barang');
        }
        return redirect()->back()->with('failed', 'Gagal menambah barang');

        
    }
    public function update(Request $request){
        $guestt = str_replace('/','',Request()->route()->getPrefix());
        $barang = Barang::find($request->kode);
        $barang->nama = $request->nama;
        $barang->stock = $request->stock;
        if($guestt == "owner"){
            $barang->harga_beli = $request->harga_beli;
        }
        if($guestt == "owner" || $guestt == "admin"){
            $barang->harga_jual = $request->harga_jual;
        }
        $barang->save();
        if($barang){
            return redirect()->back()->with('success', 'Berhasil edit barang');
        }
        return redirect()->back()->with('failed', 'Gagal edit barang');
    }
    public function delete($kode){
       $barang = Barang::find($kode);
       $barang->delete();
       if($barang){
            return redirect()->back()->with('success', 'Berhasil delete barang');
        }
        return redirect()->back()->with('failed', 'Gagal delete barang');
    }
}
