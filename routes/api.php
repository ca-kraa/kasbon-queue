<?php

use App\Http\Controllers\PegawaiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/pegawai/{page}', [PegawaiController::class, 'indexPegawai']);
Route::post('/create-pegawai', [PegawaiController::class, 'createPegawai']);
