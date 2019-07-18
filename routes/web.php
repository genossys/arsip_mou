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

Route::get('/registermember', 'Master\mitraController@showFormRegistrasi');
Route::post('/postRegister', 'Master\mitraController@register')->name('registermember');
Auth::routes();


//Login
Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::post('/postlogin', 'Auth\LoginController@postlogin');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => 'auth'], function () {


    Route::group(['prefix' => 'pimpinan', 'middleware' => 'hakakses:pimpinan'], function () {
        Route::get('/', function () {
            return view('/pimpinan/menuawal');
        });
    });

    Route::group(['prefix' => 'mitra', 'middleware' => 'hakakses:mitra'], function () {

        Route::get('/', function () {
            return view('/mitra/menuawal');
        });

        Route::group(['prefix' => 'draftMou'], function () {
            Route::get('/', 'Master\draftMouController@mouByMitra')->name('MouMitra');
            Route::get('/showMou', 'Master\draftMouController@showMouByMitra');
            Route::post('/MitraInsertMou', 'Master\draftMouController@MitraInsertMou');
            Route::get('/showMitraEditMou', 'Master\draftMouController@showMitraEditMou');
            Route::get('/showCariMou', 'Master\draftMouController@showCariMou');
            Route::post('/MitraEditMou', 'Master\draftMouController@MitraEditMou');
        });

        Route::group(['prefix' => 'draftMoa'], function () {
            Route::get('/', 'Master\draftMoaController@moaByMitra')->name('MoaMitra');
            Route::get('/showMoa', 'Master\draftMoaController@showMoaByMitra');
            Route::post('/MitraInsertMoa', 'Master\draftMoaController@MitraInsertMoa');
            Route::get('/showMitraEditMoa', 'Master\draftMoaController@showMitraEditMoa');
            Route::post('/MitraEditMoa', 'Master\draftMoaController@MitraEditMoa');
        });
    });

    Route::group(['prefix' => 'admin', 'middleware' => 'hakakses:pimpinan|admin'], function () {

        Route::get('/', function () {
            return view('/admin/menuawal');
        })->name('admin');

        Route::group(['prefix' => 'user'], function () {
            Route::get('/', 'Master\userController@index')->name('pageuser');
            Route::get('/showUser', 'Master\userController@showUser');
            Route::post('/insertUser', 'Master\userController@insertUser');
            Route::post('/editUser', 'Master\userController@editUser');
            Route::post('/editPassword', 'Master\userController@editPassword');
            Route::delete('/deleteUser', 'Master\userController@delete');
        });

        Route::group(['prefix' => 'arsip'], function () {
            Route::get('/', 'Master\arsipController@index')->name('pagearsip');
            Route::get('/showArsip', 'Master\arsipController@showArsip');
            Route::post('/insertArsipMOU', 'Master\arsipController@insertArsipMOU');
            Route::post('/insertArsipMOA', 'Master\arsipController@insertArsipMOA');
        });

        Route::group(['prefix' => 'draftMou'], function () {
            Route::get('/', 'Master\draftMouController@index')->name('pagedraftMou');
            Route::get('/showMou', 'Master\draftMouController@showMou');
            Route::get('/showMouModalEdit', 'Master\draftMouController@showEditMou');
            Route::post('/AdminEditMou', 'Master\draftMouController@AdminEditMou');
        });

        Route::group(['prefix' => 'draftMoa'], function () {
            Route::get('/', 'Master\draftMoaController@index')->name('pagedraftMoa');
            Route::get('/showMoa', 'Master\draftMoaController@showMoa');
            Route::get('/showMoaModalEdit', 'Master\draftMoaController@showEditMoa');
            Route::post('/AdminEditMoa', 'Master\draftMoaController@AdminEditMoa');
        });

        Route::group(['prefix' => 'mitra'], function () {
            Route::get('/', 'Master\mitraController@index')->name('pagemitra');
            Route::get('/showMitra', 'Master\mitraController@showMitra');
            Route::post('/simpanMitra', 'Master\mitraController@insert');
            Route::post('/editMitra', 'Master\mitraController@edit');
            Route::delete('/deleteMitra', 'Master\mitraController@delete');
        });
    });




    // Route::get('/arsip', function () {
    //     return view('/admin/master/dataarsip');
    // })->name('arsip');

    Route::get('/home', function () {
        return view('admin/menuawal');
    });
});
