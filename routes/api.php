<?php

use App\Jobs\indexPegawai;
use App\Repositories\PegawaiRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/pegawai', [PegawaiRepository::class, 'getAll']);
