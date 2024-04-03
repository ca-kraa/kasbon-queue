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
}
