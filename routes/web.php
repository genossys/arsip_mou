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

    Route::group(['prefix' => 'admin', 'middleware' => 'hakakses:pimpinan|admin'], function () {

            Route::get('/', function () {
                return view('/admin/menuawal');
            })->name('admin');

            Route::group(['prefix' => 'user'], function () {
                Route::get('/', 'Master\userController@index')->name('pageuser');
                Route::get('/dataUser', 'Master\userController@getDataUser');
                Route::post('/simpanUser', 'Master\userController@addUser');
                Route::post('/editUser', 'Master\userController@editUser');
                Route::post('/editPassword', 'Master\userController@editPassword');
                Route::delete('/deleteUser', 'Master\userController@delete');
            });

            Route::group(['prefix' => 'arsip'], function () {
                Route::get('/', 'Master\arsipController@index')->name('pagearsip');
                Route::get('/dataArsip', 'Master\arsipController@getDataArsip');
                Route::post('/simpanArsip', 'Master\arsipController@insert');
                Route::post('/editArsip', 'Master\arsipController@edit');
                Route::delete('/deleteArsip', 'Master\arsipController@delete');
            });


    });




// Route::get('/arsip', function () {
//     return view('/admin/master/dataarsip');
// })->name('arsip');

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


