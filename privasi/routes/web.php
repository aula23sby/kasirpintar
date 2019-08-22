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
Route::get('/sqlserver', 'VueController@server');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'PostController@homepage')->name('homepage');

Route::resource('/posts', 'PostController');