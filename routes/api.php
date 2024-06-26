<?php

use App\Http\Controllers\KasbonController;
use App\Http\Controllers\PegawaiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/pegawai/{page}', [PegawaiController::class, 'indexPegawai']);
Route::post('/create-pegawai', [PegawaiController::class, 'createPegawai']);

// Kasbon
Route::get('/kasbon', [KasbonController::class, 'indexKasbon']);
Route::post('/create-kasbon', [KasbonController::class, 'createKasbon']);
Route::patch('/kasbon/setujui/{id}', [KasbonController::class, 'setujuiKasbon']);
Route::post('/kasbon/setujui-masal', [KasbonController::class, 'setujuiMasal']);
