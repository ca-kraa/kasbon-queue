<?php

namespace App\Repositories;

use App\Models\Kasbon;
use Illuminate\Database\Eloquent\Builder;


class KasbonRepository
{
    protected $model;

    public function __construct(Kasbon $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function query(): Builder
    {
        return $this->model->query();
    }

    public function create(array $data)
    {
        $pegawaiId = $data['pegawai_id'];

        $kasbonBulanIni = Kasbon::where('pegawai_id', $pegawaiId)
            ->whereMonth('created_at', now()->month)
            ->count();

        if ($kasbonBulanIni >= 3) {
            throw new \Exception('Pegawai telah mencapai batas maksimal pengajuan kasbon dalam sebulan');
        }

        return $this->model->create($data);
    }

    public function setujuiKasbon($id)
    {
        $kasbon = $this->model->findOrFail($id);

        if ($kasbon->tanggal_disetujui !== null) {
            throw new \Exception('Kasbon dengan ID tersebut sudah disetujui');
        }

        $kasbon->tanggal_disetujui = now();
        $kasbon->save();

        return $kasbon;
    }

    public function setujuiMasal()
    {
        $bulanIni = now()->format('Y-m');

        $kasbons = $this->model
            ->whereNull('tanggal_disetujui')
            ->whereRaw("DATE_FORMAT(tanggal_diajukan, '%Y-%m') = ?", [$bulanIni])
            ->get();

        $totalPengajuan = 0;

        foreach ($kasbons as $kasbon) {
            $kasbon->tanggal_disetujui = now();
            $kasbon->save();

            $totalPengajuan += $kasbon->total_kasbon;
        }

        return $totalPengajuan;
    }
}
