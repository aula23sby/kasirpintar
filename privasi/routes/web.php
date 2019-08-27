<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/vue', function () {
    return view('vue');
});
Route::get('/gits', function () {
    return view('pagegit');
});
Route::get('/kalkulator', function () {
    return view('kalkulator');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'PostController@homepage')->name('homepage');

Route::resource('/posts', 'PostController');

Route::get('/sqlserver', 'VueController@index');
//Route::group(["prefix"=>"sqlserver", "middleware"=>["check_credential"]], function () {
/*
Route::group("prefix"=>"sqlserver", function () {
    Route::get(["/about", "VueController@about", "middleware"=>["check_credential"]]);
    Route::get("/server", "VueController@server");
    Route::get("/pegawai", "VueController@data_pegawai");
});*/
Route::prefix('sqlserver')->group(function () {
	Route::get("/about", "VueController@about")->middleware('check_credential');
    Route::get("/server", "VueController@server");
    Route::prefix('pegawai')->group(function () {
	    Route::get('/', 'VueController@data_pegawai');
	    Route::get('/cari', 'VueController@cari_pegawai');
	    Route::get('/tambah', function () {
		    return view('pegawai.tambah');
		});
		Route::post('/simpan', 'VueController@simpan_pegawai');
		Route::get('/edit/{id}', 'VueController@edit_pegawai');
		Route::put('/update/{id}', 'VueController@update_pegawai');
		Route::get('/hapus/{id}', 'VueController@hapus_pegawai');
		Route::get('/trash', 'VueController@trash_pegawai');
		Route::get('/restore/{id}', 'VueController@restore_pegawai');
		Route::get('/delete/{id}', 'VueController@delete_pegawai');
		Route::get('/restoreall', 'VueController@restores_pegawai');
		Route::get('/deleteall', 'VueController@deletes_pegawai');
	});
});