<?php

namespace App\Repositories;

use App\Models\Pegawai;

class PegawaiRepository
{
    protected $model;

    public function __construct(Pegawai $model)
    {
        $this->model = $model;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function all()
    {
        return $this->model->all();
    }

    public function paginate($perPage)
    {
        return $this->model->paginate($perPage);
    }
}
