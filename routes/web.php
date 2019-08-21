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

Route::get('/', 'Master\draftMoaController@chart')->name('welcome');

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

        Route::group(['prefix' => 'mitra'], function () {
            Route::get('/', 'Master\mitraController@dataMitra')->name('dataMitra');
            Route::post('/EditMitra', 'Master\mitraController@editMitra');
            Route::post('/uploadSurat', 'Master\mitraController@uploadSurat')->name('uploadSurat');
        });
    });

    Route::group(['prefix' => 'admin', 'middleware' => 'hakakses:pimpinan|admin|unit'], function () {

        Route::get('/', function () {
            return view('/admin/menuawal');
        })->name('admin');

        Route::group(['prefix' => 'user'], function () {
            Route::get('/', 'Master\userController@index')->name('pageuser');
            Route::get('/showUser', 'Master\userController@showUser');
            Route::get('/showEditUser', 'Master\userController@showEditUser');
            Route::post('/insertUser', 'Master\userController@insertUser');
            Route::post('/editUser', 'Master\userController@editUser');
            Route::post('/editPassword', 'Master\userController@editPassword');
            Route::delete('/deleteUser', 'Master\userController@deleteUser');
        });

        Route::group(['prefix' => 'arsip'], function () {
            Route::get('/', 'Master\arsipController@index')->name('pagearsip');
            Route::get('/arsipKegiatan', 'Master\arsipController@arsipKegiatan')->name('pagearsipkegiatan');
            Route::get('/showArsip', 'Master\arsipController@showArsip');
            Route::get('/showArsipKegiatan', 'Master\arsipController@showArsipKegiatan');
            Route::post('/insertArsipMOU', 'Master\arsipController@insertArsipMOU');
            Route::post('/insertArsipMOA', 'Master\arsipController@insertArsipMOA');
            Route::post('/insertArsipKegiatan', 'Master\arsipController@insertArsipKegiatan');
            Route::delete('/deleteArsip', 'Master\arsipController@deleteArsip');
            Route::get('/laporanArsip', 'Master\arsipController@laporanArsip')->name('pagelaporanarsip');
            Route::get('/showLaporanArsip', 'Master\arsipController@showLaporanArsip');
            Route::get('/jenisLaporanArsip', 'Master\arsipController@jenisLaporanArsip');
        });

        Route::group(['prefix' => 'draftMou'], function () {
            Route::get('/', 'Master\draftMouController@index')->name('pagedraftMou');
            Route::get('/showMou', 'Master\draftMouController@showMou');
            Route::get('/showMouModalEdit', 'Master\draftMouController@showEditMou');
            Route::post('/AdminEditMou', 'Master\draftMouController@AdminEditMou');
            Route::get('/laporanMou', 'Master\draftMouController@laporanMou')->name('pagelaporanmou');
            Route::get('/showLaporanMou', 'Master\draftMouController@showLaporanMou');
        });

        Route::group(['prefix' => 'draftMoa'], function () {
            Route::get('/', 'Master\draftMoaController@index')->name('pagedraftMoa');
            Route::get('/showMoa', 'Master\draftMoaController@showMoa');
            Route::get('/showMoaModalEdit', 'Master\draftMoaController@showEditMoa');
            Route::post('/AdminEditMoa', 'Master\draftMoaController@AdminEditMoa');
            Route::get('/laporanMoa', 'Master\draftMoaController@laporanMoa')->name('pagelaporanmoa');
            Route::get('/showLaporanMoa', 'Master\draftMoaController@showLaporanMoa');
        });

        Route::group(['prefix' => 'mitra'], function () {
            Route::get('/', 'Master\mitraController@index')->name('pagemitra');
            Route::get('/showMitra', 'Master\mitraController@showMitra');
            Route::get('/laporanMitra', 'Master\mitraController@laporanMitra')->name('pagelaporanmitra');
            Route::get('/showLaporanMitra', 'Master\mitraController@showLaporanMitra');
            Route::get('/showEditMitra', 'Master\mitraController@showEditMitra');
            Route::get('/showCariMitra', 'Master\mitraController@showCariMitra');
            Route::post('/simpanMitra', 'Master\mitraController@insert');

            Route::post('/editMitra', 'Master\mitraController@editMitra');
            Route::delete('/deleteMitra', 'Master\mitraController@deleteMitra');
        });

        Route::group(['prefix' => 'cetak'], function () {
            Route::get('/cetakDataMitra', 'pdfmaker@cetakDataMitra')->name('cetakMitra');
            Route::get('/cetakDataMou', 'pdfmaker@cetakDataMou')->name('cetakMou');
            Route::get('/cetakDataMoa', 'pdfmaker@cetakDataMoa')->name('cetakMoa');
            Route::get('/cetakDataArsip', 'pdfmaker@cetakDataArsip')->name('cetakArsip');
        });
    });




    // Route::get('/arsip', function () {
    //     return view('/admin/master/dataarsip');
    // })->name('arsip');

    Route::get('/home', function () {
        return view('admin/menuawal');
    });
});
