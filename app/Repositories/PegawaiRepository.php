<?php

namespace App\Repositories;

use App\Models\Pegawai;

class PegawaiRepository
{
    // public function getAll()
    // {
    //     return Pegawai::all();
    // }

    public function getAll()
    {
        $pegawai = Pegawai::all();
        return $pegawai->toJson();
    }
}
