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

Route::get('/', function () {
    return view('homepage');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logoutuser', 'Auth\LoginController@logoutUser')->name('user.logout');


Route::prefix('admin')->group(function () {
	Route::get('/', 'BarangController@index')->name('admin.home');
	Route::get('/login', 'AuthAdmin\LoginController@showLoginForm')->name('admin.login');
	Route::post('/login', 'AuthAdmin\LoginController@login')->name('admin.login.submit');
	Route::get('/register', 'AuthAdmin\LoginController@showRegisterForm')->name('admin.register');
	Route::post('/register', 'AuthAdmin\LoginController@register')->name('admin.register.submit');
	Route::get('/logout', 'AuthAdmin\LoginController@logout')->name('admin.logout');
	Route::post('/add', 'BarangController@add')->name('admin.add');
	Route::post('/update', 'BarangController@update')->name('admin.update');
	Route::get('/delete/{kode}', 'BarangController@delete')->name('admin.delete');
});
Route::prefix('owner')->group(function () {
	Route::get('/', 'BarangController@index')->name('owner.home');
	Route::get('/login', 'AuthOwner\LoginController@showLoginForm')->name('owner.login');
	Route::post('/login', 'AuthOwner\LoginController@login')->name('owner.login.submit');
	Route::get('/register', 'AuthOwner\LoginController@showRegisterForm')->name('owner.register');
	Route::post('/register', 'AuthOwner\LoginController@register')->name('owner.register.submit');
	Route::get('/logout', 'AuthOwner\LoginController@logout')->name('owner.logout');
	Route::post('/add', 'BarangController@add')->name('owner.add');
	Route::post('/update', 'BarangController@update')->name('owner.update');
	Route::get('/delete/{kode}', 'BarangController@delete')->name('owner.delete');
});
Route::prefix('staff')->group(function () {
	Route::get('/', 'BarangController@index')->name('staff.home');
	Route::get('/login', 'AuthStaff\LoginController@showLoginForm')->name('staff.login');
	Route::post('/login', 'AuthStaff\LoginController@login')->name('staff.login.submit');
	Route::get('/register', 'AuthStaff\LoginController@showRegisterForm')->name('staff.register');
	Route::post('/register', 'AuthStaff\LoginController@register')->name('staff.register.submit');
	Route::get('/logout', 'AuthStaff\LoginController@logout')->name('staff.logout');
	Route::post('/add', 'BarangController@add')->name('staff.add');
	Route::post('/update', 'BarangController@update')->name('staff.update');
	Route::get('/delete/{kode}', 'BarangController@delete')->name('staff.delete');
});