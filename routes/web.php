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
    return view('umum/welcome');
});

Route::get('/daftararsip', function () {
    return view('umum/arsip');
})->name('daftarArsip');

Route::get('/registermember', 'Master\memberController@showFormRegistrasi');
Route::post('/postRegister', 'Master\memberController@register')->name('registermember');
Auth::routes();


//Login
Route::get('/login','Auth\LoginController@login')->name('login');
Route::post('/postlogin','Auth\LoginController@postlogin');
Route::get('/logout','Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => 'auth'],function(){


Route::get('/admin', function () {
    return view('/admin/menuawal');
})->name('admin');

Route::get('/arsip', function () {
    return view('/admin/master/dataarsip');
})->name('arsip');

Route::get('/user', function () {
    return view('/admin/master/datauser');
})->name('user');

Route::get('/instansi', function () {
    return view('/admin/master/datainstansi');
})->name('instansi');

Route::get('/home', function () {
    return view('admin/menuawal');
});


});


