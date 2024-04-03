<?php

namespace App\Repositories;

use App\Models\Pegawai;

class PegawaiRepository
{
    // public function getAll()
    // {
    //     return Pegawai::all();
    // }

    public function indexPegawai()
    {
        $pegawai = Pegawai::all();
        return $pegawai->toJson();
    }
}
