<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// petugas dan admin
Route::post('register', 'petugasController@register');
Route::post('login', 'petugasController@login');
Route::put('ubah_petugas/{id}','petugasController@update')->middleware('jwt.verify');
Route::delete('hapus_petugas/{id}','petugasController@destroy')->middleware('jwt.verify');

// jenis mobil
Route::post('simpan_jenis_mobil','jenis_mobilController@insert')->middleware('jwt.verify');
Route::put('ubah_jenis_mobil/{id}','jenis_mobilController@update')->middleware('jwt.verify');
Route::get('jenis_mobil/{id}','jenis_mobilController@show')->middleware('jwt.verify');
Route::delete('hapus_jenis_mobil/{id}','jenis_mobilController@destroy')->middleware('jwt.verify');

// data mobil
Route::post('simpan_mobil','data_mobilController@insert')->middleware('jwt.verify');
Route::put('ubah_mobil/{id}','data_mobilController@update')->middleware('jwt.verify');
Route::get('mobil/{id}','data_mobilController@show')->middleware('jwt.verify');
Route::delete('hapus_mobil/{id}','data_mobilController@destroy')->middleware('jwt.verify');

// penyewa
Route::post('simpan_penyewa','penyewaController@insert')->middleware('jwt.verify');
Route::put('ubah_penyewa/{id}','penyewaController@update')->middleware('jwt.verify');
Route::get('penyewa/{id}','penyewaController@show')->middleware('jwt.verify');
Route::delete('hapus_penyewa/{id}','penyewaController@destroy')->middleware('jwt.verify');

// transaksi
Route::post('simpan_transaksi','transaksiController@insert')->middleware('jwt.verify');
Route::put('ubah_transaksi/{id}','transaksiController@update')->middleware('jwt.verify');
Route::post('transaksi','transaksiController@show')->middleware('jwt.verify');
Route::delete('hapus_transaksi/{id}','transaksiController@destroy')->middleware('jwt.verify');

// detail trans
Route::post('simpan_detail_trans','detail_transController@insert')->middleware('jwt.verify');
Route::put('ubah_detail_trans/{id}','detail_transController@update')->middleware('jwt.verify');
Route::get('detail_trans','detail_transController@show')->middleware('jwt.verify');
Route::delete('hapus_detail_trans/{id}','detail_transController@destroy')->middleware('jwt.verify');
